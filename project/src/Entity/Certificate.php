<?php

namespace App\Entity;

use App\Repository\CertificateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CertificateRepository::class)]
class Certificate
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\Column(length: 255, nullable: true)]
	private ?string $title = null;

	#[ORM\Column(type: Types::TEXT, nullable: true)]
	private ?string $description = null;

	#[ORM\ManyToOne(targetEntity: Media::class, cascade: ['persist'])]
	private ?Media $file = null;

	#[ORM\ManyToOne(targetEntity: Media::class, cascade: ['persist'])]
	private ?Media $preview = null;


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

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function setDescription(?string $description): static
	{
		$this->description = $description;

		return $this;
	}

	public function getFile(): ?Media
	{
		return $this->file;
	}

	public function setFile(?Media $file): static
	{
		$this->file = $file;

		return $this;
	}

	public function getPreview(): ?Media
	{
		return $this->preview;
	}

	public function setPreview(?Media $preview): static
	{
		$this->preview = $preview;

		return $this;
	}
}
