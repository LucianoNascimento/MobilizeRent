<?php

namespace App\Repositories\Vehicle;

use App\Models\Vehicle;
use Illuminate\Support\Collection;

class VehicleRepository implements VehicleRepositoryInterface
{
    public function getAll(): Collection
    {
        return Vehicle::with(['images' => fn($query) => $query->select('vehicle_id', 'path')
        ])->select('id', 'vehicle_type', 'model', 'brand', 'color', 'daily_price')->get();
    }

    public function findOrFail(string $vehicleId): Vehicle
    {
        return Vehicle::findOrFail($vehicleId);
    }

    public function create(array $data): Vehicle
    {
        return Vehicle::create($data);
    }

    public function update(Vehicle $vehicle, array $data): bool
    {
        return $vehicle->update($data);
    }

    public function delete(Vehicle $vehicle): bool
    {
        return $vehicle->delete();
    }

}
