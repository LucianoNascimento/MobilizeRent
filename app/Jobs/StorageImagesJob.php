<?php

namespace App\Jobs;

use App\Repositories\Image\ImageRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class StorageImagesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $images;
    protected $vehicle_id;
    protected $imageRepository;
    public function __construct($images, $vehicle_id)
    {
        $this->images =$images;
        $this->vehicle_id =$vehicle_id;
    }

    /**
     * Execute the job.
     */
    public function handle(ImageRepositoryInterface $imageRepository): void
    {
        $imageData = $imageRepository->storeImages($this->images,$this->vehicle_id);
        $imageRepository->insert($imageData);
    }
}
