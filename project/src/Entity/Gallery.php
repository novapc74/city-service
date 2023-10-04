<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GalleryRepository;
use App\Entity\Features\HasMediaTrait;
use App\Entity\Features\HasMediaInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: GalleryRepository::class)]
#[Vich\Uploadable]
class Gallery implements HasMediaInterface
{
	use HasMediaTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Media::class, cascade: ['persist'])]
    private ?Media $image = null;

    #[ORM\Column(nullable: true)]
    private ?int $sort = 0;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'gallery')]
    private ?Service $service = null;

    #[ORM\ManyToOne(targetEntity: WorkCategory::class, cascade: ['persist'], inversedBy: 'gallery')]
    private ?WorkCategory $workCategory = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->type ?? 'no type';
    }

    public function getImage(): ?Media
    {
        return $this->image;
    }

    public function setImage(?Media $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(?int $sort): static
    {
        $this->sort = $sort;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getWorkCategory(): ?WorkCategory
    {
        return $this->workCategory;
    }

    public function setWorkCategory(?WorkCategory $workCategory): static
    {
        $this->workCategory = $workCategory;

        return $this;
    }

	public static function allMediaFields(): array
	{
		return ['image'];
	}

	public function getNewImage(): ?Media
	{
		return $this->image;
	}

	public function setNewImage(?Media $image): self
	{
		$this->uploadNewMedia($image, 'image');

		return $this;
	}
}
