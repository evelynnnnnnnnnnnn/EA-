<?php

namespace Bitrix\BIConnector\Superset\Grid\Row\Assembler\Field;

use Bitrix\BIConnector\Integration\Superset\Integrator\ProxyIntegrator;
use Bitrix\BIConnector\Integration\Superset\Model\SupersetDashboardTable;
use Bitrix\BIConnector\Integration\Superset\SupersetController;
use Bitrix\Main\Grid\Row\FieldAssembler;
use Bitrix\Main\UI\Extension;

class TagTitleFieldAssembler extends FieldAssembler
{
	protected function prepareColumn($value): string
	{
		$id = (int)$value['ID'];
		$title = htmlspecialcharsbx($value['TITLE']);

		$editButton = $this->getEditButton($id);

		return <<<HTML
			<div class="tag-title-wrapper">
				<div class="tag-title-wrapper__item tag-title-preview">
					<span>{$title}</span>
					{$editButton}
				</div>
			</div>
		HTML;
	}

	protected function getEditButton(int $tagId): string
	{
		Extension::load('ui.design-tokens');

		return <<<HTML
			<a
				onclick="event.stopPropagation(); BX.BIConnector.SupersetDashboardTagGridManager.Instance.renameTag({$tagId})"
			>
				<i
					class="ui-icon-set --pencil-60"
					style="--ui-icon-set__icon-size: 21px; --ui-icon-set__icon-color: none"
				></i>
			</a>
		HTML;
	}

	protected function prepareRow(array $row): array
	{
		if (empty($this->getColumnIds()))
		{
			return $row;
		}

		$row['columns'] ??= [];

		foreach ($this->getColumnIds() as $columnId)
		{
			if ($row['data'][$columnId])
			{
				$value = [
					'TITLE' => $row['data']['TITLE'],
					'ID' => $row['data']['ID'],
				];
			}
			else
			{
				$value = [];
			}
			$row['columns'][$columnId] = $this->prepareColumn($value);
		}

		return $row;
	}
}
