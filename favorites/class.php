<?php
class favorites extends CBitrixComponent
{

	/**
	 * Достает поля и свойства товара
	 * @param  $arResult['data'][$this->arParams['page']
	 * @return void
	 */
	private function getProductData()
	{
		$dataProducts = \Bitrix\Iblock\ElementTable::getList((
			[
				'select' => ['ID', 'NAME',],
				'filter' =>
					[
						'IBLOCK_ID' => 5,
						'ID'        => array_values($this->arResult['data']),
					],
				'cache'  =>
					[
	                   'ttl'         => 3600,
	                   'cache_joins' => true,
					],
			]
		));
		unset($this->arResult['data']);
		foreach ($dataProducts->fetchCollection() as $dataItem)
			$this->arResult['data'][] =
			[
				'id'   => $dataItem->getId(),
				'name' => $dataItem->getName(),
			];

	}
	/**
	 * Проверяют наличие пользователя
	 * @param  arParams['id']
	 * @return bool
	 */
	private function checkUser()
	{
		$data = \Bitrix\Main\UserTable::getList([
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
	 * @return void
	 */
	private function getFavorites()
	{
		if($this->checkUser())
		{
			$this->arResult['data'] =
				array_chunk($this->arResult['dataObj']->getUfFavorit(), $this->arParams['onThePage']);
			$this->arResult['totalPages'] = sizeof($this->arResult['data']);

			if($this->arParams['page'] > sizeof($this->arResult['data']))
			{
				$this->arResult['error']  = "Invalid page {$this->arParams['page']}";
				$this->arResult['status'] = 'fail';
				unset($this->arResult['data']);
			}
			else
			{
				$this->arResult['data'] = $this->arResult['data'][$this->arParams['page']];
				$this->getProductData();
			}
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