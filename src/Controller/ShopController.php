<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/api/v1")
 */
class ShopController extends AbstractController
{
	protected $shopRepository;
	protected $serializer;

	public function __construct(
		ShopRepository $shopRepository,
		SerializerInterface $serializer
	){
		$this->shopRepository = $shopRepository;
		$this->serializer = $serializer;
	}

    /**
     * @Route("/shops", name="shop_list", methods={"GET"})
     */
    public function listShops(): JsonResponse
	{
    	$shops = $this->shopRepository->findAll();
		$jsonData = $this->serializer->serialize($shops, 'json', ['groups' => ['list_shop']]);
		return new JsonResponse(
			$jsonData,
			JsonResponse::HTTP_OK,
			[],
			true
		);
    }

	/**
	 * @Route("/shop/{shop}", name="shop_get", methods={"GET"})
	 */
	public function getShop(Shop $shop): JsonResponse
	{
		$jsonData = $this->serializer->serialize($shop, 'json', ['groups' => ['list_shop']]);
		return new JsonResponse(
			$jsonData,
			JsonResponse::HTTP_OK,
			[],
			true
		);
	}

	/**
	 * @Route("/shop", name="shop_create", methods={"POST"})
	 */
	public function createShop(Request $request): JsonResponse
	{
		try {
			$payload = $request->getContent();
			if (empty($payload)) {
				Throw new \Exception('Error: Empty JSON payload');
			}
			$newShop = $this->serializer->deserialize($request->getContent(), Shop::class, 'json');
			$this->shopRepository->add($newShop, $flush = true);
			$jsonData = $this->serializer->serialize($newShop, 'json', ['groups' => ['list_shop']]);
			return new JsonResponse(
				$jsonData,
				JsonResponse::HTTP_CREATED,
				[],
				true
			);
		} catch (\Exception $e) {
			return new JsonResponse(
				$e->getMessage(),
				JsonResponse::HTTP_NOT_FOUND,
			);
		}
	}

	/**
	 * @Route("/shop/{shop}", name="shop_update", methods={"PUT"})
	 */
	public function updateShop(Request $request, Shop $shop): JsonResponse
	{
		try {
			$payload = $request->getContent();
			if (empty($payload)) {
				Throw new \Exception('Error: Empty JSON payload');
			}
			$this->serializer->deserialize($payload, Shop::class, 'json', array('object_to_populate' => $shop));
			$this->shopRepository->add($shop, $flush = true);
			$jsonData = $this->serializer->serialize($shop, 'json', ['groups' => ['list_shop']]);
			return new JsonResponse(
				$jsonData,
				JsonResponse::HTTP_OK,
				[],
				true
			);

		} catch(\Exception $e) {
			return new JsonResponse(
				$e->getMessage(),
				JsonResponse::HTTP_NOT_FOUND,
			);
		}
	}

	/**
	 * @Route("/shop/{shop}", name="shop_delete", methods={"DELETE"})
	 */
	public function deleteShop(Shop $shop): JsonResponse
	{
		try {
			$this->shopRepository->remove($shop, $flush = true);
			return new JsonResponse(
				'Ressource removed',
				JsonResponse::HTTP_OK,
				[],
				true
			);
		} catch(\Exception $e) {
			return new JsonResponse(
				$e->getMessage(),
				JsonResponse::HTTP_NOT_FOUND,
			);
		}
	}
}
