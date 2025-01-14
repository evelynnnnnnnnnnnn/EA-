<?php

namespace Bitrix\BIConnector\Superset\Filter\Provider;

use Bitrix\Main\Filter\EntityDataProvider;
use Bitrix\Main\Filter\Settings;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI;

class DashboardDataProvider extends EntityDataProvider
{
	public function __construct(protected Settings $settings)
	{
	}

	public function getSettings(): Settings
	{
		return $this->settings;
	}

	public function prepareFields(): array
	{
		return [
			'CREATED_BY_ID' => $this->createField('CREATED_BY_ID', [
				'name' => Loc::getMessage('BICONNECTOR_SUPERSET_DASHBOARD_GRID_FILTER_TITLE_CREATED_BY'),
				'default' => true,
				'type' => 'entity_selector',
				'partial' => true,
			]),
			'DATE_CREATE' => $this->createField('DATE_CREATE', [
				'name' => Loc::getMessage('BICONNECTOR_SUPERSET_DASHBOARD_GRID_FILTER_TITLE_DATE_CREATE'),
				'default' => true,
				'type' => 'date',
				'time' => true,
				'data' => [
					'exclude' => [
						UI\Filter\DateType::TOMORROW,
						UI\Filter\DateType::NEXT_DAYS,
						UI\Filter\DateType::NEXT_WEEK,
						UI\Filter\DateType::NEXT_MONTH,
					],
				],
			]),
			'DATE_MODIFY' => $this->createField('DATE_MODIFY', [
				'name' => Loc::getMessage('BICONNECTOR_SUPERSET_DASHBOARD_GRID_FILTER_TITLE_DATE_MODIFY'),
				'default' => true,
				'type' => 'date',
				'time' => true,
				'data' => [
					'exclude' => [
						UI\Filter\DateType::TOMORROW,
						UI\Filter\DateType::NEXT_DAYS,
						UI\Filter\DateType::NEXT_WEEK,
						UI\Filter\DateType::NEXT_MONTH,
					],
				],
			]),
			'TYPE' => $this->createField('TYPE', [
				'name' => Loc::getMessage('BICONNECTOR_SUPERSET_DASHBOARD_GRID_FILTER_TITLE_TYPE'),
				'default' => true,
				'type' => 'list',
				'partial' => true,
			]),
			'ID' => $this->createField('ID', [
				'name' => Loc::getMessage('BICONNECTOR_SUPERSET_DASHBOARD_GRID_FILTER_TITLE_ID'),
				'default' => false,
				'type' => 'number',
				'partial' => true,
			]),
			'SOURCE_ID' => $this->createField('SOURCE_ID', [
				'name' => Loc::getMessage('BICONNECTOR_SUPERSET_DASHBOARD_GRID_FILTER_TITLE_SOURCE_ID'),
				'default' => false,
				'partial' => true,
				'type' => 'entity_selector',
			]),
			'TAGS' => $this->createField('TAGS.ID', [
				'name' => Loc::getMessage('BICONNECTOR_SUPERSET_DASHBOARD_GRID_FILTER_TITLE_TAGS'),
				'default' => true,
				'partial' => true,
				'type' => 'entity_selector',
			]),
		];
	}

	public function prepareFieldData($fieldID): ?array
	{
		if ($fieldID === 'TYPE')
		{
			return [
				'params' => [
					'multiple' => 'N',
				],
				'items' => [
					'SYSTEM' => Loc::getMessage('BICONNECTOR_SUPERSET_DASHBOARD_GRID_FILTER_TYPE_SYSTEM'),
					'MARKET' => Loc::getMessage('BICONNECTOR_SUPERSET_DASHBOARD_GRID_FILTER_TYPE_MARKET'),
					'CUSTOM' => Loc::getMessage('BICONNECTOR_SUPERSET_DASHBOARD_GRID_FILTER_TYPE_CUSTOM'),
				],
			];
		}

		if ($fieldID === 'CREATED_BY_ID')
		{
			return $this->getUserEntitySelectorParams(
				$fieldID . '_filter',
				['fieldName' => $fieldID]
			);
		}

		if ($fieldID === 'SOURCE_ID')
		{
			return [
				'params' => [
					'multiple' => 'Y',
					'dialogOptions' => [
						'context' => 'filter',
						'entities' => [
							[
								'id' => 'biconnector-superset-dashboard',
								'dynamicLoad' => true,
								'dynamicSearch' => true,
							],
						],
					],
				],
			];
		}

		if ($fieldID === 'TAGS.ID')
		{
			return [
				'params' => [
					'multiple' => 'Y',
					'dialogOptions' => [
						'context' => 'biconnector-superset-dashboard-tag',
						'multiple' => 'Y',
						'entities' => [
							[
								'id' => 'biconnector-superset-dashboard-tag',
								'options' => ['filter' => true],
								'dynamicLoad' => true,
								'dynamicSearch' => true,
							],
						],
						'dropdownMode' => true,
						'compactView' => true,
					],
				],
			];
		}

		return null;
	}

	/**
	 * @inheritDoc
	 */
	public function prepareFilterValue(array $rawFilterValue): array
	{
		$rawFilterValue = parent::prepareFilterValue($rawFilterValue);

		if (!empty($rawFilterValue['FIND']))
		{
			if (!empty($rawFilterValue['TITLE']))
			{
				$rawFilterValue['TITLE'] = [
					$rawFilterValue['TITLE'],
					"%{$rawFilterValue['FIND']}%",
				];
			}
			else
			{
				$rawFilterValue['TITLE'] = "%{$rawFilterValue['FIND']}%";
			}
		}

		return $rawFilterValue;
	}
}