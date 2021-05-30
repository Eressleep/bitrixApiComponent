<?php
class favorites extends CBitrixComponent
{
	public function executeComponent()
	{


		$this->arResult = [1];
		$this::IncludeComponentTemplate();
	}
}