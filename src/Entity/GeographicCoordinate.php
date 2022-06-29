<?php

namespace App\Entity;

use App\Repository\GeographicCoordinateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Embeddable()
 */
class GeographicCoordinate
{
	/**
	 * @ORM\Column(type="float")
	 * @var float
	 * @Groups({"list_shop"})
	 */
    private $lat;

	/**
	 * @ORM\Column(type="float")
	 * @var float
	 * @Groups({"list_shop"})
	 */
    private $lng;

    public function __construct(float $lat, float $lng)
	{
		$this->lat = $lat;
		$this->lng = $lng;
	}

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLng(): float
    {
        return $this->lng;
    }
}
