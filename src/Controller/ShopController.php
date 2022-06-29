<?php

namespace App\Controller;

use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/api/v1")
 */
class ShopController extends AbstractController
{
    /**
     * @Route("/shops", name="shop_list", methods={"GET"})
     */
    public function index(ShopRepository $shopRepository, SerializerInterface $serializer): JsonResponse
    {
    	$shops = $shopRepository->findAll();

		$jsonData = $serializer->serialize($shops, 'json', ['groups' => ['list_shop']]);

		return new JsonResponse(
			$jsonData,
			JsonResponse::HTTP_OK,
			[],
			true
		);
    }
}
