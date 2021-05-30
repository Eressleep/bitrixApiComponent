<?php
class favorites extends CBitrixComponent
{

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

	private function getFavorites()
	{
		if($this->checkUser())
		{
			$this->arResult['data'] = $this->arResult['dataObj']->getUfFavorit();

		}
		unset($this->arResult['dataObj']);
	}

	public function executeComponent()
	{

		$this->getFavorites();
		if($this->arParams['json'])
			$this->arResult = json_encode($this->arResult);
		$this::IncludeComponentTemplate();
	}
}