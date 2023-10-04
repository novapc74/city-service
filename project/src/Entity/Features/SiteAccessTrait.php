<?php

namespace App\Entity\Features;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Slug;
use Symfony\Component\Serializer\Annotation\Groups;

trait SiteAccessTrait
{
	#[ORM\Column(type: 'string', length: 255, nullable: false)]
	#[Groups('basic')]
	protected ?string $title;

	#[ORM\Column(type: 'string', length: 255, nullable: true)]
	#[Slug(fields: ['title'], updatable: false)]
	#[Groups('basic')]
	protected ?string $slug;

	public function __toString(): string
	{
		return $this->title ?? 'Новый';
	}

	public function getTitle(): ?string
	{
		return $this->title;
	}

	public function setTitle(string $title): self
	{
		$this->title = $title;

		return $this;
	}

	public function getSlug(): ?string
	{
		return $this->slug;
	}


	public function setSlug(string $slug): self
	{
		$this->slug = $slug;

		return $this;
	}
}
