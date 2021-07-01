<?php
if ( ! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

\Bitrix\Main\Loader::includeModule("iblock");

class detailProducts extends CBitrixComponent
{

	/**
	 * Проверяют на наличие товар
	 *
	 * @param  arParams['id]
	 *
	 * @return bool
	 */
	private function checkProduct()
	{
		$item = \Bitrix\Iblock\ElementTable::getByPrimary($this->arParams['id'])->fetchObject();
		if ($item)
		{
			$this->arResult['status'] = 'success';
			$this->arResult['dataObj'] = $item;
			return true;
		}
		$this->arResult['status']      = 'failed';
		$this->arResult['description'] = "Invalid item id - {$this->arParams['id']}";

		return false;
	}
	/**
	 * Достает поля и свойсва товара
	 *
	 * @param  arParams['id]
	 *
	 * @return bool
	 */
	private function getFields()
	{
		$this->arResult['item'] =
		[
			'id'   => $this->arResult['dataObj']->getId(),
			'name' => $this->arResult['dataObj']->getName(),
		];
		unset($this->arResult['dataObj']);
	}
	public function executeComponent()
	{
		if($this->checkProduct())
			$this->getFields();

		if($this->arParams['json'])
			$this->arResult = json_encode($this->arResult);
		$this::IncludeComponentTemplate();
	}
}