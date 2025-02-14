<?php

namespace App\Repositories\Image;

use Illuminate\Support\Collection;

interface ImageRepositoryInterface
{
    public function getAllImages(): Collection;
    public function insert(array $imageData): void;
    public function storeImages($images, $vehicle_id): array;
}
