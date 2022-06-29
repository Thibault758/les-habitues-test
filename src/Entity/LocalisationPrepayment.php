<?php

namespace App\Entity;

use App\Repository\LocalisationPrepaymentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LocalisationPrepaymentRepository::class)
 * @ORM\Table(name="lh_localisation_prepayment")
 */
class LocalisationPrepayment
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
     * @ORM\Column(type="integer", nullable=true)
	 * @Groups({"list_shop"})
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="localisationPrepayments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $shop;

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

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

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
}
