<?php

namespace App\Service\Shop\Import;

use App\Repository\ShopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class ImportShopFromApi
{
	protected $em;
	protected $client;
	protected $shopRepository;
	protected $shopsDataFromApi = [];
	protected $nbShopImported = 0;

	public function __construct(
		EntityManagerInterface $em,
		HttpClientInterface $client,
		ShopRepository $shopRepository
	) {
		$this->em = $em;
		$this->client = $client;
		$this->shopRepository = $shopRepository;
	}

	abstract protected function getShopDataFromApi();
	abstract protected function shopEntityAlreadyExist(array $shopApiData): bool;
	abstract protected function generateShopEntityFromApiData(array $shopApiData);

	public function importShop(): int
	{
		$this->getShopDataFromApi();

		foreach ($this->shopsDataFromApi as $shopDataFromApi) {
			if (!$this->shopEntityAlreadyExist($shopDataFromApi)) {
				$this->generateShopEntityFromApiData($shopDataFromApi);
				$this->nbShopImported ++;
			}
		}

		$this->em->flush();

		return $this->nbShopImported;
	}
}