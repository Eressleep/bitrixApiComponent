<?php
class favorites extends CBitrixComponent
{

	/**
	 * Проверяют на наличие пользователя
	 * checkUser
	 */
	private function checkUser()
	{
		$data = $user = \Bitrix\Main\UserTable::getList([
			'filter' => ['=ID' => $this->arParams['id'],],
			'select' => ['ID','UF_FAVORIT'],
			'cache'  =>
				[
					'ttl'         => 3600,
					'cache_joins' => true,
				],

		])->fetchObject();;
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
	/**
	 * Достает избранные товары пользователя
	 * getFavorites
	 */
	private function getFavorites()
	{
		if($this->checkUser())
		{
			$this->arResult['data'] =
				array_chunk($this->arResult['dataObj']->getUfFavorit(), $this->arParams['onThePage']);

			$this->arResult['totalPages'] = sizeof($this->arResult['data']);

			$this->arResult['data'] = $this->arResult['data'][$this->arParams['page']];
		}
		unset($this->arResult['dataObj']);
	}

	public function executeComponent()
	{
		if($this->arParams['method'] == 'GET')
			$this->getFavorites();
		else
			{
				$this->arResult['error']  = "Invalid method {$this->arParams['method']}";
				$this->arResult['status'] = 'fail';
			}
		if($this->arParams['json'])
			$this->arResult = json_encode($this->arResult);
		$this::IncludeComponentTemplate();
	}
}