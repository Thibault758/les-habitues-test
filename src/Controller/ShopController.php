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
    public function list(): JsonResponse
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
}
