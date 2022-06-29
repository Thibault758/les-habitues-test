<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 * @ORM\Table(name="lh_shop")
 */
class Shop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
	 * @Groups({"list_shop"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
	 * @Groups({"list_shop"})
     */
    private $id_api;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
	 * @Groups({"list_shop"})
     */
    private $chain;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
	 * @Groups({"list_shop"})
     */
    private $category;

    /**
     * @ORM\Column(type="integer", nullable=true)
	 * @Groups({"list_shop"})
     */
    private $category_id;

    /**
     * @ORM\Column(type="boolean")
	 * @Groups({"list_shop"})
     */
    private $ecommerce_prepayment = false;

    /**
     * @ORM\Column(type="integer", nullable=true)
	 * @Groups({"list_shop"})
     */
    private $total_supplier_users;

    /**
     * @ORM\Column(type="integer", nullable=true)
	 * @Groups({"list_shop"})
     */
    private $total_offers;

    /**
     * @ORM\Column(type="boolean")
	 * @Groups({"list_shop"})
     */
    private $publication = false;

    /**
     * @ORM\Column(type="datetime")
	 * @Groups({"list_shop"})
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
	 * @Groups({"list_shop"})
     */
    private $updated_at;

    /**
     * @ORM\Column(type="boolean")
	 * @Groups({"list_shop"})
     */
    private $active = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
	 * @Groups({"list_shop"})
     */
    private $slug;

    /**
     * @ORM\Column(type="integer", nullable=true)
	 * @Groups({"list_shop"})
     */
    private $wallets_total;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
	 * @Groups({"list_shop"})
     */
    private $picture_url;

    /**
     * @ORM\Column(type="integer", nullable=true)
	 * @Groups({"list_shop"})
     */
    private $wallets_last_month;

    /**
     * @ORM\Column(type="integer", nullable=true)
	 * @Groups({"list_shop"})
     */
    private $pipedrive_deal_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
	 * @Groups({"list_shop"})
     */
    private $pipedrive_org_id;

	/**
	 * @ORM\Embedded(class="GeographicCoordinate")
	 * @Groups({"list_shop"})
	 * @var GeographicCoordinate
	 */
	private $geographicCoordinate;

    /**
     * @ORM\OneToMany(targetEntity=Localisation::class, mappedBy="shop", orphanRemoval=true, cascade={"persist"})
	 * @Groups({"list_shop"})
     */
    private $localisations;

    /**
     * @ORM\OneToMany(targetEntity=LocalisationPrepayment::class, mappedBy="shop", orphanRemoval=true, cascade={"persist"})
	 * @Groups({"list_shop"})
     */
    private $localisationPrepayments;

    /**
     * @ORM\OneToMany(targetEntity=Tag::class, mappedBy="shop", orphanRemoval=true, cascade={"persist"})
	 * @Groups({"list_shop"})
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity=Offer::class, mappedBy="shop", orphanRemoval=true, cascade={"persist"})
	 * @Groups({"list_shop"})
     */
    private $offers;

    public function __construct()
    {
        $this->localisations = new ArrayCollection();
        $this->localisationPrepayments = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->offers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdApi(): ?int
    {
        return $this->id_api;
    }

    public function setIdApi(int $id_api): self
    {
        $this->id_api = $id_api;

        return $this;
    }

    public function getChain(): ?string
    {
        return $this->chain;
    }

    public function setChain(?string $chain): self
    {
        $this->chain = $chain;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(?int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function isEcommercePrepayment(): ?bool
    {
        return $this->ecommerce_prepayment;
    }

    public function setEcommercePrepayment(bool $ecommerce_prepayment): self
    {
        $this->ecommerce_prepayment = $ecommerce_prepayment;

        return $this;
    }

    public function getTotalSupplierUsers(): ?int
    {
        return $this->total_supplier_users;
    }

    public function setTotalSupplierUsers(?int $total_supplier_users): self
    {
        $this->total_supplier_users = $total_supplier_users;

        return $this;
    }

    public function getTotalOffers(): ?int
    {
        return $this->total_offers;
    }

    public function setTotalOffers(?int $total_offers): self
    {
        $this->total_offers = $total_offers;

        return $this;
    }

    public function isPublication(): ?bool
    {
        return $this->publication;
    }

    public function setPublication(bool $publication): self
    {
        $this->publication = $publication;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

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

    public function getWalletsTotal(): ?int
    {
        return $this->wallets_total;
    }

    public function setWalletsTotal(?int $wallets_total): self
    {
        $this->wallets_total = $wallets_total;

        return $this;
    }

    public function getPictureUrl(): ?string
    {
        return $this->picture_url;
    }

    public function setPictureUrl(?string $picture_url): self
    {
        $this->picture_url = $picture_url;

        return $this;
    }

    public function getWalletsLastMonth(): ?int
    {
        return $this->wallets_last_month;
    }

    public function setWalletsLastMonth(?int $wallets_last_month): self
    {
        $this->wallets_last_month = $wallets_last_month;

        return $this;
    }

    public function getPipedriveDealId(): ?int
    {
        return $this->pipedrive_deal_id;
    }

    public function setPipedriveDealId(?int $pipedrive_deal_id): self
    {
        $this->pipedrive_deal_id = $pipedrive_deal_id;

        return $this;
    }

    public function getPipedriveOrgId(): ?int
    {
        return $this->pipedrive_org_id;
    }

    public function setPipedriveOrgId(?int $pipedrive_org_id): self
    {
        $this->pipedrive_org_id = $pipedrive_org_id;

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

    /**
     * @return Collection<int, Localisation>
     */
    public function getLocalisations(): Collection
    {
        return $this->localisations;
    }

    public function addLocalisation(Localisation $localisation): self
    {
        if (!$this->localisations->contains($localisation)) {
            $this->localisations[] = $localisation;
            $localisation->setShop($this);
        }

        return $this;
    }

    public function removeLocalisation(Localisation $localisation): self
    {
        if ($this->localisations->removeElement($localisation)) {
            // set the owning side to null (unless already changed)
            if ($localisation->getShop() === $this) {
                $localisation->setShop(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LocalisationPrepayment>
     */
    public function getLocalisationPrepayments(): Collection
    {
        return $this->localisationPrepayments;
    }

    public function addLocalisationPrepayment(LocalisationPrepayment $localisationPrepayment): self
    {
        if (!$this->localisationPrepayments->contains($localisationPrepayment)) {
            $this->localisationPrepayments[] = $localisationPrepayment;
            $localisationPrepayment->setShop($this);
        }

        return $this;
    }

    public function removeLocalisationPrepayment(LocalisationPrepayment $localisationPrepayment): self
    {
        if ($this->localisationPrepayments->removeElement($localisationPrepayment)) {
            // set the owning side to null (unless already changed)
            if ($localisationPrepayment->getShop() === $this) {
                $localisationPrepayment->setShop(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->setShop($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            // set the owning side to null (unless already changed)
            if ($tag->getShop() === $this) {
                $tag->setShop(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Offer>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offer $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers[] = $offer;
            $offer->setShop($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getShop() === $this) {
                $offer->setShop(null);
            }
        }

        return $this;
    }
}
