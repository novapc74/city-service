<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
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

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: Gallery::class, cascade: ['persist', 'remove'])]
    private Collection $gallery;

	#[ORM\ManyToOne(targetEntity: self::class, cascade: ['persist'], inversedBy: 'about')]
	private ?self $aboutService = null;

	#[ORM\OneToMany(mappedBy: 'aboutService', targetEntity: self::class, cascade: ['persist', 'remove'])]
	private Collection $about;

    #[ORM\Column(type: Types::ARRAY)]
    private array $expertise = [];

    #[ORM\Column]
    private ?bool $isActive = false;

    #[ORM\ManyToOne(targetEntity: self::class, cascade: ['persist'], inversedBy: 'services')]
    private ?self $parentService = null;

    #[ORM\OneToMany(mappedBy: 'parentService', targetEntity: self::class, cascade: ['persist', 'remove'])]
    private Collection $services;

    public function __construct()
    {
        $this->gallery = new ArrayCollection();
        $this->about = new ArrayCollection();
        $this->services = new ArrayCollection();
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

    /**
     * @return Collection<int, Gallery>
     */
    public function getGallery(): Collection
    {
        return $this->gallery;
    }

    public function addGallery(Gallery $gallery): static
    {
        if (!$this->gallery->contains($gallery)) {
            $this->gallery->add($gallery);
            $gallery->setService($this);
        }

        return $this;
    }

    public function removeGallery(Gallery $gallery): static
    {
        if ($this->gallery->removeElement($gallery)) {
            // set the owning side to null (unless already changed)
            if ($gallery->getService() === $this) {
                $gallery->setService(null);
            }
        }

        return $this;
    }

    public function getExpertise(): array
    {
        return $this->expertise;
    }

    public function setExpertise(array $expertise): static
    {
        $this->expertise = $expertise;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getAboutService(): ?self
    {
        return $this->aboutService;
    }

    public function setAboutService(?self $aboutService): static
    {
        $this->aboutService = $aboutService;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAbout(): Collection
    {
        return $this->about;
    }

    public function addAbout(self $about): static
    {
        if (!$this->about->contains($about)) {
            $this->about->add($about);
            $about->setAboutService($this);
        }

        return $this;
    }

    public function removeAbout(self $about): static
    {
        if ($this->about->removeElement($about)) {
            // set the owning side to null (unless already changed)
            if ($about->getAboutService() === $this) {
                $about->setAboutService(null);
            }
        }

        return $this;
    }

    public function getParentService(): ?self
    {
        return $this->parentService;
    }

    public function setParentService(?self $parentService): static
    {
        $this->parentService = $parentService;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(self $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->setParentService($this);
        }

        return $this;
    }

    public function removeService(self $service): static
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getParentService() === $this) {
                $service->setParentService(null);
            }
        }

        return $this;
    }
}
