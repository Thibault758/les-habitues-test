<?php

namespace App\Service\Shop\Import;

abstract class ImportShopFromApi
{
	protected $nbShopImported = 0;

	abstract protected function getShopDataFromApi();

	public function importShop(): int
	{
		$this->getShopDataFromApi();

		return $this->nbShopImported;
	}
}