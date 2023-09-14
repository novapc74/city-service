<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks()]
#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\Column(type: Types::TEXT)]
	private ?string $address = null;

	#[ORM\Column(length: 20)]
	private ?string $inn = null;

	#[ORM\Column(type: Types::ARRAY, nullable: true)]
	private ?array $phone = null;

	#[ORM\Column(length: 255)]
	private ?string $coordinates = null;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getAddress(): ?string
	{
		return $this->address;
	}

	public function setAddress(string $address): static
	{
		$this->address = $address;

		return $this;
	}

	public function getInn(): ?string
	{
		return $this->inn;
	}

	public function setInn(string $inn): static
	{
		$this->inn = $inn;

		return $this;
	}

	public function getPhone(): ?array
	{
		return $this->phone;
	}

	public function setPhone(?array $phone): static
	{
		$this->phone = $phone;

		return $this;
	}

	public function getCoordinates(): ?string
	{
		return $this->coordinates;
	}

	public function setCoordinates(string $coordinates): static
	{
		$this->coordinates = $coordinates;

		return $this;
	}
}
