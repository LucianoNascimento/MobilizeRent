<?php

namespace App\Repositories\Vehicle;

use App\Models\Vehicle;
use Illuminate\Support\Collection;

interface VehicleRepositoryInterface
{
    public function getAll():Collection ;

    public function findOrFail(string $vehicleId): Vehicle;

    public function create(array $data): Vehicle;

    public function update(Vehicle $vehicle, array $data): bool;

    public function delete(Vehicle $vehicle): bool;
}
