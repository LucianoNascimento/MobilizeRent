<?php

namespace App\Services\Image;

use App\Repositories\Image\ImageRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;

class ImageService
{
    protected ImageRepositoryInterface $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * Upload images and associate them with a vehicle.
     *
     * @param array $images
     * @param int $vehicle_id
     * @return array
     */
    public function uploadImages(array $images, int $vehicle_id): array
    {
        $imageData = $this->imageRepository->storeImages($images, $vehicle_id);
        $this->imageRepository->insert($imageData);

        return $imageData;
    }

    /**
     * Get all images.
     *
     * @return Collection
     */
    public function allImages(): Collection
    {
        return $this->imageRepository->getAllImages();
    }

    /**
     * Get details of an image and its associated vehicle.
     *
     */
    public function detailImageVehicle(int $id)
    {
        return $this->imageRepository->detailImageVehicle($id);
    }
}
