<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Gedmo\Slug(fields: ['title'])]
    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: self::class, cascade: ['persist'], inversedBy: 'products')]
    private ?self $product = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: self::class, cascade: ['persist', 'remove'])]
    private Collection $products;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Service::class, cascade: ['persist'])]
    private Collection $services;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->services = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getProduct(): ?self
    {
        return $this->product;
    }

    public function setProduct(?self $product): static
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(self $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setProduct($this);
        }

        return $this;
    }

    public function removeProduct(self $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getProduct() === $this) {
                $product->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->setProduct($this);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getProduct() === $this) {
                $service->setProduct(null);
            }
        }

        return $this;
    }

    #[Orm\PreRemove]
    public function preRemove(): void
    {
        if ($service = $this->getServices()->current()) {
            $service->setProduct(null);
            $this->removeService($service);
        }
    }
}
