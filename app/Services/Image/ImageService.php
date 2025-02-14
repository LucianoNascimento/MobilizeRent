<?php

namespace App\Services\Image;

use App\Models\Image;
use App\Repositories\Image\ImageRepositoryInterface;
use Illuminate\Support\Collection;

class ImageService
{
    protected ImageRepositoryInterface $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function uploadImages($images, $vehicle_id): array
    {
        $imageData = $this->imageRepository->storeImages($images, $vehicle_id);
        $this->imageRepository->insert($imageData);

        return $imageData;
    }

    public function allImages():Collection
    {
        return Image::with('vehicle')->get();
    }
}
