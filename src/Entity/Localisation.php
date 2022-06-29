<?php

namespace App\Entity;

use App\Repository\LocalisationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LocalisationRepository::class)
 * @ORM\Table(name="lh_localisation")
 */
class Localisation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
	 * @Groups({"list_shop"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
	 * @Groups({"list_shop"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
	 * @Groups({"list_shop"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
	 * @Groups({"list_shop"})
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
	 * @Groups({"list_shop"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
	 * @Groups({"list_shop"})
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean")
	 * @Groups({"list_shop"})
     */
    private $team = false;

    /**
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="localisations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $shop;

	/**
	 * @ORM\Embedded(class="GeographicCoordinate")
	 * @Groups({"list_shop"})
	 * @var GeographicCoordinate
	 */
	private $geographicCoordinate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(?string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function isTeam(): ?bool
    {
        return $this->team;
    }

    public function setTeam(bool $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    public function setShop(?Shop $shop): self
    {
        $this->shop = $shop;

        return $this;
    }

	public function getGeographicCoordinate(): GeographicCoordinate
	{
		return $this->geographicCoordinate;
	}

	public function setGeographicCoordinate(GeographicCoordinate $geographicCoordinate): self
	{
		$this->geographicCoordinate = $geographicCoordinate;
		return $this;
	}
}
