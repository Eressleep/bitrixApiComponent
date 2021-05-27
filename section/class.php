<?php
if ( ! defined("B_PROLOG_INCLUDED") or B_PROLOG_INCLUDED !== true or !\Bitrix\Main\Loader::includeModule("iblock"))
	die();

class section extends CBitrixComponent
{
	private  function getSections()
	{
		$sections = \Bitrix\Iblock\SectionTable::getList(
			[
				'select' => ['ID', 'NAME', 'SORT'],
				'filter' =>
					[
						'IBLOCK_ID'   => 4,
						'ACTIVE'      => 'Y',
						'DEPTH_LEVEL' => 1,
					],
				'cache'  =>
					[
						'ttl'         => 3600,
						'cache_joins' => true,
					],
			]
		)->fetchAll();
		foreach ($sections as $section)
		{
			$this->arResult[] = $section;
		}
	}
	public function executeComponent()
	{
		$this->getSections();

		if($this->arParams['json'])
			$this->arResult = json_decode($this->arResult);

		$this::IncludeComponentTemplate();
	}
}