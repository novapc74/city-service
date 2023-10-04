<?php

namespace App\Entity\Features;

use App\Entity\Media;

interface HasMediaInterface
{
	public function uploadNewMedia(?Media $fieldMedia, string $fieldName): void;

	public static function mediaGetter($string): string;
	public static function mediaSetter($string): string;

	public static function allMediaFields(): array;
}