<?php

namespace App\Entity\Features;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

trait DateTrait
{
	#[Gedmo\Timestampable(on: 'create')]
	#[ORM\Column(name: 'created_at', type: 'datetime_immutable', nullable: false)]
	protected ?DateTimeImmutable $created = null;

	#[Gedmo\Timestampable(on: 'update')]
	#[ORM\Column(name: 'updated_at', type: 'datetime_immutable', nullable: false)]
	protected ?DateTimeImmutable $updated = null;

	private static function defineDateFormat(): string
	{
		return 'd.m.Y H:i:s';
	}

	#[Groups('basic')]
	#[SerializedName('createdAt')]
	public function getCreatedString(?string $format = null): string
	{
		$format = $format ?? self::defineDateFormat();
		if ($this->created instanceof DateTimeInterface) {
			return $this->created->format($format);
		}

		return '';
	}

	public function getCreated(): DateTimeImmutable
	{
		return $this->created;
	}

	public function setCreated(?DateTimeImmutable $created): void
	{
		$created       = $created ?? new DateTimeImmutable();
		$this->created = $created;
	}

	public function getUpdated(): DateTimeImmutable
	{
		return $this->updated;
	}

	public function getUpdatedString(?string $format = null): string
	{
		$format = $format ?? self::defineDateFormat();
		if ($this->updated instanceof DateTimeImmutable) {
			return $this->updated->format($format);
		}

		return '';
	}

	public function setUpdated(?DateTimeImmutable $updated): void
	{
		$this->updated = $updated;
	}

	public function isPublished(): bool
	{
		return $this->getCreated() <= new DateTimeImmutable();
	}
}