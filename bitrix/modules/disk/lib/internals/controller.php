<?php

namespace Bitrix\Disk\Internals;

use Bitrix\Disk\Driver;
use Bitrix\Disk\Internals\Error\Error;
use Bitrix\Disk\Internals\Error\ErrorCollection;
use Bitrix\Disk\Internals\Error\IErrorable;
use Bitrix\Disk\Security\ParameterSigner;
use Bitrix\Disk\TypeFile;
use Bitrix\Main\Application;
use Bitrix\Main\Context;
use Bitrix\Main\EventResult;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Web\PostDecodeFilter;
use Bitrix\Main\Web\Json;

Loc::loadMessages(__FILE__);

abstract class Controller implements IErrorable
{
	const EVENT_ON_BEFORE_ACTION = 'onBeforeAction';

	const ERROR_REQUIRED_PARAMETER = 'DISK_CONTROLLER_22001';
	const ERROR_UNKNOWN_ACTION     = 'DISK_CONTROLLER_22002';

	const STATUS_SUCCESS      = 'success';
	const STATUS_DENIED       = 'denied';
	const STATUS_ERROR        = 'error';
	const STATUS_NEED_AUTH    = 'need_auth';
	const STATUS_INVALID_SIGN = 'invalid_sign';
	const STATUS_RESTRICTION  = 'restriction';

	/** @var string */
	protected $action;
	/** @var  array */
	protected $actionDescription;
	/** @var  string */
	protected $realActionName;
	/** @var  ErrorCollection */
	protected $errorCollection;
	/** @var  \Bitrix\Main\HttpRequest */
	protected $request;

	private $collectDebugInfo = 1;

	/**
	 * Constructor Controller.
	 */
	public function __construct()
	{
		$this->errorCollection = new ErrorCollection;
		$this->request = Context::getCurrent()->getRequest();

		$this->init();
	}

	/**
	 * Initializes controller.
	 * This method is invoked at the end of constructor.
	 * @return void
	 */
	protected function init()
	{}

	/**
	 * Terminates controller and application.
	 * This method replaces "die()" or "exit()" and ensures life cycle of application.
	 * @return void
	 */
	protected function end()
	{
		$this->logDebugInfo();

		/** @noinspection PhpUndefinedClassInspection */
		\CMain::finalActions();
		die;
	}

	/**
	 * Executes controller by specific action.
	 * This method contains all steps of life cycle controller.
	 * @return void
	 */
	public function exec()
	{
		try
		{
			//todo move in processBeforeAction()
			if($this->request->isPost())
			{
				\CUtil::jSPostUnescape();
				$this->request->addFilter(new PostDecodeFilter);
			}

			$this->collectDebugInfo();

			$this->resolveAction();			
			$this->checkAction();

			$this->checkRequiredModules();

			if(!$this->prepareParams())
			{
				$this->sendJsonErrorResponse();
			}

			$action = $this->getAction();
			if(
				$this->processBeforeAction($action) === true &&
				$this->triggerOnBeforeAction($action) === true
			)
			{
				$this->runAction();
			}

			$this->logDebugInfo();
		}
		catch(\Exception $e)
		{
			$this->runProcessingException($e);
		}
	}

	/**
	 * Triggers the event {{static::EVENT_ON_BEFORE_ACTION . $action}}.
	 * This method is invoked right before an action is executed.
	 * In case the action should not run, event handler have to return EvenResult with type EventResult::ERROR.
	 *
	 * @param string $action Action name.
	 * @return bool
	 */
	protected function triggerOnBeforeAction($action)
	{
		$event = new Event(Driver::INTERNAL_MODULE_ID, static::EVENT_ON_BEFORE_ACTION . $action, array(
			'action' => $action,
			'controller' => $this,
		));
		$event->send($this);

		if($event->getResults())
		{
			foreach($event->getResults() as $eventResult)
			{
				if($eventResult->getType() != EventResult::SUCCESS)
				{
					return false;
				}
			}
		}

		return true;
	}

	/**
	 * Collects debug info by Diag.
	 * @return void
	 */
	protected function collectDebugInfo()
	{
		if($this->collectDebugInfo)
		{
			Diag::getInstance()->collectDebugInfo(get_called_class());
		}
	}

	/**
	 * Logs debug info by Diag.
	 * @throws \Bitrix\Main\SystemException
	 * @return void
	 */
	protected function logDebugInfo()
	{
		if($this->collectDebugInfo)
		{
			Diag::getInstance()->logDebugInfo(get_called_class(), get_called_class() . ':' . $this->getAction());
		}
	}

	/**
	 * Gets current user.
	 * @return array|bool|\CUser
	 */
	protected function getUser()
	{
		global $USER;

		return $USER;
	}

	/**
	 * Sends JSON response and terminates controller.
	 * @param mixed $response
	 * @param null|array $params
	 * @return void
	 */
	protected function sendJsonResponse($response, $params = null)
	{
		if(!defined('PUBLIC_AJAX_MODE'))
		{
			define('PUBLIC_AJAX_MODE', true);
		}

		$this->restartBuffer();

		if(!empty($params['http_status']) && $params['http_status'] == 403)
		{
			header('HTTP/1.0 403 Forbidden', true, 403);
		}
		if(!empty($params['http_status']) && $params['http_status'] == 500)
		{
			header('HTTP/1.0 500 Internal Server Error', true, 500);
		}
		if(!empty($params['http_status']) && $params['http_status'] == 510)
		{
			header('HTTP/1.0 510 Not Extended', true, 510);
		}

		header('Content-Type:application/json; charset=UTF-8');
		echo Json::encode($response);

		$this->end();
	}

	/**
	 * Sends JSON response with status "error" and with errors and terminates controller.
	 * @param array $response Data to response.
	 * @return void
	 */
	protected function sendJsonErrorResponse(array $response = array())
	{
		$errors = array();
		foreach($this->getErrors() as $error)
		{
			/** @var Error $error */
			$errors[] = array(
				'message' => $error->getMessage(),
				'code' => $error->getCode(),
			);
		}
		unset($error);
		$response['status'] = self::STATUS_ERROR;
		$response['errors'] = $errors;
		$this->sendJsonResponse($response);
	}

	/**
	 * Sends JSON response with status "denied" and terminates controller.
	 * @param string $message Message.
	 * @return void
	 */
	protected function sendJsonAccessDeniedResponse($message = '')
	{
		$this->sendJsonResponse(array(
			'status' => self::STATUS_DENIED,
			'message' => $message,
		));
	}

	/**
	 * Sends JSON response with status "invalid_sign" and terminates controller.
	 * @param string $message Message.
	 * @return void
	 */
	protected function sendJsonInvalidSignResponse($message = '')
	{
		$this->sendJsonResponse(array(
			'status' => self::STATUS_INVALID_SIGN,
			'message' => $message,
		));
	}

	/**
	 * Sends JSON response with status "success" and mixed data, and terminates controller.
	 * @param array $response Data to response.
	 * @return void
	 */
	protected function sendJsonSuccessResponse(array $response = array())
	{
		$response['status'] = self::STATUS_SUCCESS;
		$this->sendJsonResponse($response);
	}

	final protected function restartBuffer()
	{
		global $APPLICATION;
		$APPLICATION->restartBuffer();
	}

	/**
	 * Sends response and terminates controller.
	 * Automatically restart buffer.
	 * @param mixed $response Mixed data to response.
	 * @return void
	 */
	protected function sendResponse($response)
	{
		$this->logDebugInfo();

		$this->restartBuffer();

		echo $response;

		$this->end();
	}

	/**
	 * Getting array of errors.
	 * @return Error[]
	 */
	public function getErrors()
	{
		return $this->errorCollection->toArray();
	}

	/**
	 * Getting array of errors with the necessary code.
	 * @param string $code Code of error.
	 * @return Error[]
	 */
	public function getErrorsByCode($code)
	{
		return $this->errorCollection->getErrorsByCode($code);
	}

	/**
	 * Getting once error with the necessary code.
	 * @param string $code Code of error.
	 * @return Error[]
	 */
	public function getErrorByCode($code)
	{
		return $this->errorCollection->getErrorByCode($code);
	}

	protected function addError(Error $error): static
	{
		$this->errorCollection[] = $error;

		return $this;
	}

	/**
	 * Resolves action and description of action, which need to run.
	 * @see listActions().
	 * @return $this
	 */
	protected function resolveAction()
	{
		$listOfActions = $this->normalizeListOfAction($this->listActions());
		$action = mb_strtolower($this->action);

		if(!isset($listOfActions[$action]))
		{
			$this->errorCollection[] = new Error(
				Loc::getMessage(
					'DISK_CONTROLLER_ERROR_UNKNOWN_ACTION',
					array('#ACTION#' => $this->sanitizeActionName($action))
				),
				self::ERROR_UNKNOWN_ACTION
			);
			return $this;
		}

		$this->realActionName = $action;
		$description = $listOfActions[$this->realActionName];
		$this->setAction($description['name'], $description);

		return $this;
	}

	private function sanitizeActionName($actionName)
	{
		if(!preg_match('/^[a-zA-Z0-9]+$/i', $actionName))
		{
			return 'unknown';
		}

		return $actionName;
	}

	//todo refactor BaseComponent + Controller normalizeListOfAction, resolveAction.
	//you can use composition in BaseComponent
	/**
	 * Normalizes list of action to general view.
	 * @param array $listOfActions List of action (@see listActions()).
	 * @return array
	 */
	protected function normalizeListOfAction(array $listOfActions)
	{
		$normalized = array();
		foreach($listOfActions as $action => $description)
		{
			if(!is_string($action))
			{
				$normalized[$description] = $this->normalizeActionDescription($description, $description);
			}
			else
			{
				$normalized[$action] = $this->normalizeActionDescription($action, $description);
			}
		}
		unset($action, $description);

		return array_change_key_case($normalized, CASE_LOWER);
	}

	/**
	 * Normalizes action description.
	 *
	 * Default description:
	 * array(
	 *			'method' => array('GET'), //allowed methods to run action.
	 *			'name' => $action, //action which will run
	 *			'check_csrf_token' => false, // check csrf token
	 *			'redirect_on_auth' => true, // if user doesn't authorize then will redirect on login page.
	 *			'close_session' => false, //execute session_close() before action.
	 *	)
	 *
	 * @param string $action Action name.
	 * @param array|string $description Action description.
	 * @return array
	 */
	protected function normalizeActionDescription($action, $description)
	{
		if(!is_array($description))
		{
			$description = array(
				'method' => array('GET'),
				'name' => $description,
				'check_csrf_token' => false,
				'redirect_on_auth' => true,
				'close_session' => false,
			);
		}
		if(empty($description['name']))
		{
			$description['name'] = $action;
		}
		if(!isset($description['redirect_on_auth']))
		{
			$description['redirect_on_auth'] = false;
		}
		if(!isset($description['close_session']))
		{
			$description['close_session'] = false;
		}

		return $description;
	}

	/**
	 * Checks action by settings in description.
	 * This method may terminate controller and application.
	 * @return void
	 */
	protected function checkAction()
	{
		if($this->errorCollection->hasErrors())
		{
			$this->sendJsonErrorResponse();
		}
		$description = $this->getActionDescription();

		if(!$this->getUser() || !$this->getUser()->getId())
		{
			if($description['redirect_on_auth'])
			{
				$this->redirectToAuth();
			}
			else
			{
				$this->runProcessingIfUserNotAuthorized();
			}
		}

		//if does not exist check_csrf_token we have to check csrf for only POST method.
		if(
			(isset($description['check_csrf_token']) && $description['check_csrf_token'] === true) ||
			($this->request->isPost() && !isset($description['check_csrf_token'])))
		{
			//in BDisk we have token_sid
			if(!check_bitrix_sessid() && !check_bitrix_sessid('token_sid'))
			{
				$this->runProcessingIfInvalidCsrfToken();
			}
		}

		if(!in_array($this->request->getRequestMethod(), $description['method']))
		{
			$this->sendJsonAccessDeniedResponse('Wrong method for current action');
		}
	}

	/**
	 * Lists all actions by controller. This listing may contains description in short-style.
	 *
	 * If you set
	 * array(
	 *  'showTest'
	 * )
	 *
	 * Then action 'showTest' has default description @see normalizeActionDescription()
	 * and execute method processActionShowTest.
	 *
	 * If you set
	 * array(
	 *  'showFoo' => 'showBar'
	 * )
	 *
	 * Then action 'showFoo' has default description @see normalizeActionDescription()
	 * and execute method processActionShowBar.
	 *
	 * If you set
	 * array(
	 *  'showFoo' => array(
	 *		'method' => array('GET', 'POST'), //allowed GET and POST methods to run action.
	 *		'name' => 'showFoo', //execute method processActionShowFoo
	 *		'check_csrf_token' => true, // check csrf token and run @see runProcessingIfInvalidCsrfToken()
	 *		'redirect_on_auth' => true, // if user doesn't authorize then will redirect on login page.
	 *		'close_session' => false, //execute session_close() before action.
	 *  )
	 * )
	 *
	 * @return array
	 */
	protected function listActions()
	{
		return array();
	}

	/**
	 * Gets current action.
	 * @return string
	 */
	public function getAction()
	{
		return $this->action;
	}

	/**
	 * Gets description of action.
	 * @return array
	 */
	public function getActionDescription()
	{
		return $this->actionDescription;
	}

	/**
	 * Sets action and description.
	 * @param string $action Action name.
	 * @param array  $description Action description.
	 * @return $this
	 */
	public function setAction($action, array $description)
	{
		$this->action = $action;
		$this->actionDescription = $description;

		return $this;
	}

	/**
	 * Sets action name.
	 * @param string $action Action name.
	 * @return $this
	 */
	public function setActionName($action)
	{
		$this->action = $action;
		return $this;
	}

	/**
	 * Checks required modules before process action.
	 * @return void
	 */
	protected function checkRequiredModules()
	{}

	/**
	 * Prepare params before process action.
	 * @return bool
	 */
	protected function prepareParams()
	{
		return true;
	}

	/**
	 * Common operations before process action.
	 * @param string $actionName Action name which will be run.
	 * @return bool If method will return false, then action will not execute.
	 */
	protected function processBeforeAction($actionName)
	{
		return true;
	}

	/**
	 * Runs action.
	 * Will be run method with name processAction{$actionName}
	 * @return mixed
	 */
	protected function runAction()
	{
		$description = $this->getActionDescription();
		if($description['close_session'] === true)
		{
			//todo be careful by using this features.
			session_write_close();
		}

		$binder = new Engine\Binder(
			$this,
			'processAction' . $this->getAction(),
			array($this->request->getPostList(), $this->request->getQueryList())
		);

		return $binder->invoke();
	}

	/**
	 * Runs processing exception.
	 * @param \Exception $e Exception.
	 * @return void
	 */
	protected function runProcessingException(\Exception $e)
	{
//		throw $e;
		$this->errorCollection->add(array(new Error($e->getMessage())));
		$this->sendJsonErrorResponse();
	}

	/**
	 * Runs processing if user is not authorized.
	 * @return void
	 */
	protected function runProcessingIfUserNotAuthorized()
	{
		$this->sendJsonAccessDeniedResponse();
	}

	/**
	 * Redirects to auth endpoint and sets backurl.
	 *
	 * @param string|null $backUrl Back url.
	 * @return void
	 */
	protected function redirectToAuth($backUrl = null)
	{
		$backUrl = $backUrl?: $this->request->getRequestUri();

		LocalRedirect(
			SITE_DIR.'auth/?backurl='.urlencode($backUrl)
		);
	}

	/**
	 * Runs processing if csrf token is invalid.
	 * @return void
	 */
	protected function runProcessingIfInvalidCsrfToken()
	{
		$this->sendJsonAccessDeniedResponse('Wrong csrf token');
	}

	/**
	 * Get application instance.
	 * @return Application|\Bitrix\Main\HttpApplication|\CMain
	 */
	protected function getApplication()
	{
		global $APPLICATION;
		return $APPLICATION;
	}

	/**
	 * Checks required parameters.
	 * Fills error collection if required parameter is missed.
	 * @param array $inputParams Input data.
	 * @param array $required Required parameters.
	 * @return bool
	 */
	protected function checkRequiredInputParams(array $inputParams, array $required)
	{
		foreach ($required as $item)
		{
			if(!isset($inputParams[$item]) || (!$inputParams[$item] && !(is_string($inputParams[$item]) && mb_strlen($inputParams[$item]))))
			{
				$this->errorCollection->add(array(new Error(Loc::getMessage('DISK_CONTROLLER_ERROR_REQUIRED_PARAMETER', array('#PARAM#' => $item)), self::ERROR_REQUIRED_PARAMETER)));
				return false;
			}
		}

		return true;
	}

	/**
	 * Checks required parameters in $_POST.
	 * Fills error collection if required parameter is missed.
	 * @param array $required Required parameters.
	 * @return bool
	 */
	protected function checkRequiredPostParams(array $required)
	{
		$params = array();
		foreach($required as $item)
		{
			$params[$item] = $this->request->getPost($item);
		}
		unset($item);

		return $this->checkRequiredInputParams($params, $required);
	}

	/**
	 * Checks required parameters in $_GET.
	 * Fills error collection if required parameter is missed.
	 * @param array $required Required parameters.
	 * @return bool
	 */
	protected function checkRequiredGetParams(array $required)
	{
		$params = array();
		foreach($required as $item)
		{
			$params[$item] = $this->request->getQuery($item);
		}
		unset($item);

		return $this->checkRequiredInputParams($params, $required);
	}

	/**
	 * Checks required parameters in $_FILES.
	 * Fills error collection if required parameter is missed.
	 * @param array $required Required parameters.
	 * @return bool
	 */
	protected function checkRequiredFilesParams(array $required)
	{
		$params = array();
		foreach($required as $item)
		{
			$params[$item] = $this->request->getFile($item);
		}
		unset($item);

		return $this->checkRequiredInputParams($params, $required);
	}

	/**
	 * Returns whether this is an AJAX (XMLHttpRequest) request.
	 * @return boolean
	 */
	protected function isAjaxRequest()
	{
		return $this->request->isAjaxRequest();
	}

	protected function resizeImage($fileData, $objectId): array
	{
		if (TypeFile::shouldTreatImageAsFile($fileData))
		{
			return $fileData;
		}

		$width = $this->request->getQuery('width');
		$height = $this->request->getQuery('height');

		if ($width > 0 || $height > 0)
		{
			$signature = $this->request->getQuery('signature');
			if (!$signature)
			{
				$this->sendJsonInvalidSignResponse('Empty signature');
			}
			if (!ParameterSigner::validateImageSignature($signature, $objectId, $width, $height))
			{
				$this->sendJsonInvalidSignResponse('Invalid signature');
			}

			$resizeType = $this->request->getQuery('exact') === 'Y' ? BX_RESIZE_IMAGE_EXACT : BX_RESIZE_IMAGE_PROPORTIONAL;
			$tmpFile = \CFile::resizeImageGet(
				$fileData,
				['width' => $width, 'height' => $height],
				$resizeType,
				true,
				false,
				true
			);
			$fileData['FILE_SIZE'] = $tmpFile['size'];
			$fileData['SRC'] = $tmpFile['src'];
		}

		return $fileData;
	}
}