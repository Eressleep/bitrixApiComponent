<?php

if ( ! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true  )
	die();

if(!\Bitrix\Main\Loader::includeModule("iblock"))
	die;

class personalAccount extends CBitrixComponent
{

	private function getUserById()
	{
		if($this->checkUser())
			$this->arResult['data'] =
				[
					'name'       => $this->arResult['dataObj']->getName(),
					'surname'    => $this->arResult['dataObj']->getSecondName(),
					'patronymic' => $this->arResult['dataObj']->getSecondName(),
					'mail'       => $this->arResult['dataObj']->getEmail(),
					'login'      => $this->arResult['dataObj']->getLogin(),
				];
		unset($this->arResult['dataObj']);

	}
	private function checkUser()
	{
		$data = \Bitrix\Main\UserTable::getByPrimary($this->arParams['id'])->fetchObject();
		if($data)
		{
			$this->arResult['status'] = 'success';
			$this->arResult['dataObj'] = $data;
			return true;
		}
		$this->arResult['status'] = 'fail';
		return false;
	}

	public function executeComponent()
	{
		$this->arResult =
			[
				'status' => '',
				'data'   => '',
			];
		$this->getUserById();
		if($this->arParams['json'])
			$this->arResult = json_encode($this->arResult);
		$this::IncludeComponentTemplate();
	}

}