<?php
if ( ! defined("B_PROLOG_INCLUDED") or B_PROLOG_INCLUDED !== true or !\Bitrix\Main\Loader::includeModule("iblock"))
	die();

class section extends CBitrixComponent
{
	private function getElementFields($element)
	{
		return
		[
			'id'   => $element->getId(),
			'name' => $element->getName(),
			'sort' => $element->getSort(),
		];
	}
	private function getSections()
	{
		$sections = \Bitrix\Iblock\SectionTable::getList(
			[
				'select' => ['ID', 'NAME', 'SORT', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID'],
				'filter' =>
					[
						'IBLOCK_ID'   => $this->arParams['iblockId'],
						'ACTIVE'      => 'Y',
					],
				'cache'  =>
					[
						'ttl'         => 3600,
						'cache_joins' => true,
					],
			]
		);

		foreach ($sections->fetchCollection() as $section)
		{
			if(empty($section->getIblockSectionId()))
				$this->arResult['section'][$section->getId()] = $this->getElementFields($section);
			elseif (in_array($section->getIblockSectionId(), array_keys($this->arResult['section'])))
				$this->arResult['section'][$section->getIblockSectionId()]['children'][$section->getId()]
					= $this->getElementFields($section);
			elseif ($section->getDepthLevel() == 3)
			{
				foreach ($this->arResult['section'] as &$subSection)
				{
					if(in_array($section->getIblockSectionId(), array_keys($subSection['children'])))
					{
						$this->arResult['section'][$subSection['id']]['children'][$section->getIblockSectionId()]['children'][]
							= $this->getElementFields($section);
						break;
					}
				}
			}
		}
		$this->arResult['status'] = 'success';
	}
	public function executeComponent()
	{
		if ($this->arParams['method'] === 'GET')
		{
			$this->getSections();
			if($this->arParams['json'])
				$this->arResult = json_decode($this->arResult);
		}
		else
			$this->arResult['status'] = 'fail';
		$this::IncludeComponentTemplate();
	}
}