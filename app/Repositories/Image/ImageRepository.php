<?php

namespace App\Repositories\Image;

use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class ImageRepository implements ImageRepositoryInterface
{
    public function getAllImages(): Collection
    {
        return Image::with('vehicle')->get();
    }

    public function insert(array $imageData): void
    {
        Image::insert($imageData);
    }

    public function storeImages($images, $vehicle_id): array
    {
        $imageData = [];

        if (!Storage::disk('public')->exists('images')) {

            Storage::disk('public')->makeDirectory('images');
        }

        if (is_array($images)) {
            foreach ($images as $image) {
                $path = Storage::disk('public')->put('images', $image);
                $imageData[] = [
                    'vehicle_id' => $vehicle_id,
                    'path' => $path,
                ];
            }
        } else {
            $path = Storage::disk('public')->put('images', $images);
            $imageData[] = [
                'vehicle_id' => $vehicle_id,
                'path' => $path,
            ];
        }

        return $imageData;
    }
}
