<?php

namespace App\Service\Shop\Import;

use App\Entity\GeographicCoordinate;
use App\Entity\Localisation;
use App\Entity\LocalisationPrepayment;
use App\Entity\Offer;
use App\Entity\Shop;
use App\Entity\Tag;
use App\Repository\ShopRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class ImportShopFromLesHabituesApiService extends ImportShopFromApi
{
	private $lesHabituesApiUrl;
	private $lesHabituesApiShopEndpoint;

	public function __construct(
		string $lesHabituesApiUrl,
		string $lesHabituesApiShopEndpoint,
		EntityManagerInterface $em,
		HttpClientInterface $client,
		ShopRepository $shopRepository
	) {
		parent::__construct($em, $client, $shopRepository);
		$this->lesHabituesApiUrl = $lesHabituesApiUrl;
		$this->lesHabituesApiShopEndpoint = $lesHabituesApiShopEndpoint;
	}

	final protected function getShopDataFromApi(): void
	{
		$response = $this->client->request(
			'GET',
			$this->lesHabituesApiUrl . $this->lesHabituesApiShopEndpoint
		);

		$statusCode = $response->getStatusCode();
		if ($statusCode !== 200) {
			Throw new \Exception("API Les Habitues return status code $statusCode");
		}

		$responseArray = $response->toArray();
		if (!isset($responseArray['data'])) {
			Throw new \Exception("API Les Habitues no return shops data.");
		}

		$this->shopsDataFromApi = $responseArray['data'];
	}

	final protected function shopEntityAlreadyExist(array $shopApiData): bool
	{
		if (!isset($shopApiData['id'])) {
			Throw new \Exception('API Les Habitues shop data "id" missing');
		}

		$shopApiId = $shopApiData['id'];
		$shopExist = $this->shopRepository->findOneBy(['id_api' => $shopApiId]);

		return $shopExist ? true : false;
	}

	final protected function generateShopEntityFromApiData(array $shopApiData)
	{
		$newShopEntity = new Shop();

		if (!isset($shopApiData['id'])) {
			Throw new \Exception('API Les Habitues shop data "id" missing');
		}
		$newShopEntity
			->setIdApi($shopApiData['id'])
			->setChain( isset($shopApiData['chain']) ? $shopApiData['chain'] : null)
			->setCategory(isset($shopApiData['category']) ? $shopApiData['category'] : null)
			->setCategoryId(isset($shopApiData['category_id']) ? $shopApiData['category_id'] : null)
			->setEcommercePrepayment(isset($shopApiData['ecommerce_prepayment']) ? $shopApiData['ecommerce_prepayment'] : false)
			->setTotalSupplierUsers(isset($shopApiData['total_supplier_users']) ? $shopApiData['total_supplier_users'] : null)
			->setTotalOffers(isset($shopApiData['total_offers']) ? $shopApiData['total_offers'] : null)
			->setPublication(isset($shopApiData['publication']) ? $shopApiData['publication'] : false)
			->setCreatedAt(
				isset($shopApiData['created_at']) ?
					( new \DateTime() )->setTimestamp($shopApiData['created_at']) :
					new \DateTime()
			)
			->setUpdatedAt(
				isset($shopApiData['updated_at']) ?
					( new \DateTime() )->setTimestamp($shopApiData['updated_at']) :
					new \DateTime()
			)
			->setActive(isset($shopApiData['active']) ? $shopApiData['active'] : false)
			->setSlug(isset($shopApiData['slug']) ? $shopApiData['slug'] : null)
			->setWalletsTotal(isset($shopApiData['wallets_total']) ? $shopApiData['wallets_total'] : null)
			->setPictureUrl(isset($shopApiData['picture_url']) ? $shopApiData['picture_url'] : null)
			->setWalletsLastMonth(isset($shopApiData['wallets_last_month']) ? $shopApiData['wallets_last_month'] : null)
			->setPipedriveDealId(isset($shopApiData['pipedrive_deal_id']) ? $shopApiData['pipedrive_deal_id'] : null)
			->setPipedriveOrgId(isset($shopApiData['pipedrive_org_id']) ? $shopApiData['pipedrive_org_id'] : null)
		;

		$this->setShopOffers($newShopEntity, $shopApiData);
		$this->setShopLocalisations($newShopEntity, $shopApiData);
		$this->setShopTags($newShopEntity, $shopApiData);
		$this->setShopGeographicCoordinate($newShopEntity, $shopApiData);
		$this->setShopLocalisationsPrepayment($newShopEntity, $shopApiData);

		$this->shopRepository->add($newShopEntity);
	}

	final protected function setShopLocalisationsPrepayment(Shop $shop, array $shopApiData): void
	{
		if (isset($shopApiData['localisations_prepayment'])) {
			foreach ($shopApiData['localisations_prepayment'] as $localisationPrepayment) {
				$newLocalisationPrepaymentEntity = ( new LocalisationPrepayment() )
					->setName(isset($localisationPrepayment['name']) ? $localisationPrepayment['name'] : null)
					->setAmount(isset($localisationPrepayment['amount']) ? $localisationPrepayment['amount'] : null)
				;
				$shop->addLocalisationPrepayment($newLocalisationPrepaymentEntity);
			}
		}
	}

	final protected function setShopOffers(Shop $shop, array $shopApiData): void
	{
		if (isset($shopApiData['offers'])) {
			foreach ($shopApiData['offers'] as $offer) {
				if (isset($offer['amount']) && isset($offer['reduction'])) {
					$newOfferEntity = ( new Offer() )
						->setAmount($offer['amount'])
						->setReduction($offer['reduction'])
					;
					$shop->addOffer($newOfferEntity);
				}
			}
		}
	}

	final protected function setShopLocalisations(Shop $shop, array $shopApiData): void
	{
		if (isset($shopApiData['localisations'])) {
			foreach ($shopApiData['localisations'] as $localisation) {
				$newLocalisationEntity = ( new Localisation() )
					->setName(isset($localisation['name']) ? $localisation['name'] : null)
					->setAddress(isset($localisation['address']) ? $localisation['name'] : null)
					->setZipcode(isset($localisation['zipcode']) ? $localisation['zipcode'] : null)
					->setCity(isset($localisation['city']) ? $localisation['city'] : null)
					->setSlug(isset($localisation['slug']) ? $localisation['slug'] : null)
					->setTeam(isset($localisation['team']) ? $localisation['team'] : false)
				;

				if (
					isset($localisation['geoloc']) &&
					isset($localisation['geoloc']['lat']) &&
					isset($localisation['geoloc']['lng'])
				) {
					$geographicCoordinate = new GeographicCoordinate(
						$localisation['geoloc']['lat'],
						$localisation['geoloc']['lng']
					);
					$newLocalisationEntity->setGeographicCoordinate($geographicCoordinate);
				}

				$shop->addLocalisation($newLocalisationEntity);
			}
		}
	}

	final protected function setShopTags(Shop $shop, array $shopApiData): void
	{
		if (isset($shopApiData['_tags'])) {
			foreach ($shopApiData['_tags'] as $tag) {
				$newTagEntity = ( new Tag() )
					->setCode($tag)
				;
				$shop->addTag($newTagEntity);
			}
		}
	}

	final protected function setShopGeographicCoordinate(Shop $shop, array $shopApiData): void
	{
		if (isset($shopApiData['_geoloc'][0])) {
			$geographicCoordinate = new GeographicCoordinate(
				$shopApiData['_geoloc'][0]['lat'],
				$shopApiData['_geoloc'][0]['lng']
			);
			$shop->setGeographicCoordinate($geographicCoordinate);
		}
	}
}