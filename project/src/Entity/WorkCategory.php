<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Repository\WorkCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkCategoryRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class WorkCategory
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

    #[ORM\OneToMany(mappedBy: 'workCategory', targetEntity: Gallery::class, cascade: ['persist', 'remove'])]
    private ?Collection $gallery;

    #[ORM\ManyToOne(targetEntity: self::class, cascade: ['persist'], inversedBy: 'completedWorks')]
    private ?self $category = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: self::class, cascade: ['persist', 'remove'])]
    private Collection $completedWorks;

    public function __construct()
    {
        $this->gallery = new ArrayCollection();
        $this->completedWorks = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->title ?? 'no title';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getGallery(): ?Collection
    {
        return $this->gallery;
    }

    public function addGallery(?Gallery $gallery): static
    {
        if (!$this->gallery->contains($gallery)) {
            $this->gallery->add($gallery);
            $gallery->setWorkCategory($this);
        }

        return $this;
    }

    public function removeGallery(?Gallery $gallery): static
    {
        if ($this->gallery->removeElement($gallery)) {
            // set the owning side to null (unless already changed)
            if ($gallery->getWorkCategory() === $this) {
                $gallery->setWorkCategory(null);
            }
        }

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

    public function getCategory(): ?self
    {
        return $this->category;
    }

    public function setCategory(?self $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCompletedWorks(): Collection
    {
        return $this->completedWorks;
    }

    public function addCompletedWork(self $completedWork): static
    {
        if (!$this->completedWorks->contains($completedWork)) {
            $this->completedWorks->add($completedWork);
            $completedWork->setCategory($this);
        }

        return $this;
    }

    public function removeCompletedWork(self $completedWork): static
    {
        if ($this->completedWorks->removeElement($completedWork)) {
            // set the owning side to null (unless already changed)
            if ($completedWork->getCategory() === $this) {
                $completedWork->setCategory(null);
            }
        }

        return $this;
    }

    #[ORM\PreRemove]
    public function preRemove(): void
    {
        $completedWork = $this->getCompletedWorks()->toArray();

        array_map(function (WorkCategory $work) {
            $this->removeCompletedWork($work);
        }, $completedWork);
    }

}
