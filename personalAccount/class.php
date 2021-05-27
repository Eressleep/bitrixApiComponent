<?php

if ( ! defined("B_PROLOG_INCLUDED") or B_PROLOG_INCLUDED !== true or !\Bitrix\Main\Loader::includeModule("iblock"))
	die();

class personalAccount extends CBitrixComponent
{
	private function deleteUserById()
	{
		if($this->checkUser($this->arParams['id']))
			\CUser::Delete($this->arParams['id']);
		$this->arResult['status'] = 'success';
	}
	private function setUserData()
	{
		if($this->checkUser() and $this->validateUserDate())
		{
			$userData = new CUser();
			$userData->Update($this->arParams['id'],
			[
				"NAME"        => $this->arParams['changeUserData']['name'],
				'LOGIN'       => $this->arParams['changeUserData']['login'],
				'LAST_NAME'   => $this->arParams['changeUserData']['surname'],
				'SECOND_NAME' => $this->arParams['changeUserData']['patronymic'],
				'EMAIL'       => $this->arParams['changeUserData']['mail'],
			]);
		}
	}
	private function validateUserDate()
	{
		foreach ($this->arParams['changeUserData'] as &$date)
			$date = trim($date);

		if(!filter_var($this->arParams['changeUserData']['mail'],FILTER_VALIDATE_EMAIL))
			$this->arResult['error']['mail']= "Invalid mail {$this->arParams['changeUserData']['mail']}";

		if(!preg_match('/^[A-Za-z]+$/u',$this->arParams['changeUserData']['name']))
			$this->arResult['error']['name']= "Invalid name {$this->arParams['changeUserData']['name']}";

		if(!preg_match('/^[A-Za-z]+$/u',$this->arParams['changeUserData']['surname']))
			$this->arResult['error']['surname']= "Invalid surname {$this->arParams['changeUserData']['surname']}";

		if(!preg_match('/^[A-Za-z]+$/u',$this->arParams['changeUserData']['patronymic']))
			$this->arResult['error']['patronymic']= "Invalid patronymic {$this->arParams['changeUserData']['patronymic']}";

		if(!preg_match('/^[A-Za-z]+$/u',$this->arParams['changeUserData']['login']))
			$this->arResult['error']['login']= "Invalid login {$this->arParams['changeUserData']['login']}";

		if(sizeof($this->arResult['error']))
		{
			$this->arResult['status'] = 'fail';
			return false;
		}

		return  true;
	}
	private function getUserById()
	{
		if($this->checkUser())
			$this->arResult['data'] =
				[
					'name'       => $this->arResult['dataObj']->getName(),
					'surname'    => $this->arResult['dataObj']->getLastName(),
					'patronymic' => $this->arResult['dataObj']->getSecondName(),
					'mail'       => $this->arResult['dataObj']->getEmail(),
					'login'      => $this->arResult['dataObj']->getLogin(),
				];


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
		$this->arResult['error']  = "Invalid user id {$this->arParams['id']}";
		$this->arResult['status'] = 'fail';
		return false;
	}
	public function executeComponent()
	{
		$requestMethod = \Bitrix\Main\Context::getCurrent()->getRequest()->getRequestMethod();

		if ($this->arParams['methodRequest'] === 'GET')
			$this->getUserById();
		elseif (sizeof($this->arParams['changeUserData']) > 0 and $this->arParams['methodRequest'] === 'POST')
			$this->setUserData();
		elseif ($this->arParams['methodRequest'] === 'DELETE')
			$this->deleteUserById();
		else
		{
			$this->arResult['status'] = 'fail';
			$this->arResult['error']  = "Invalid request {$requestMethod}";
		}

		if ($this->arParams['json'])
			$this->arResult = json_encode($this->arResult);

		unset($this->arResult['dataObj']);
		$this::IncludeComponentTemplate();
	}
}