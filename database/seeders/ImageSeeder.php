<?php

namespace Database\Seeders;

use App\Jobs\StorageImagesJob;
use App\Models\Image;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $vehicles = Vehicle::factory()->count(10)->create();
        Image::factory()->count(100)->create()->each(function ($image) use ($vehicles) {
            $vehicle = $vehicles->random();
            $image->vehicle_id = $vehicle->id;
            $image->save();
          StorageImagesJob::dispatch([$image], $vehicle->id);
        });
    }
}
