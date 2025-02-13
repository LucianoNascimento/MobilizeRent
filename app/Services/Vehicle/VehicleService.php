<?php

namespace App\Services\Vehicle;

use App\Models\Vehicle;
use App\Repositories\Vehicle\VehicleRepositoryInterface;
use Illuminate\Support\Collection;

class VehicleService
{

    protected VehicleRepositoryInterface $vehicleRepository;

    public function __construct(VehicleRepositoryInterface $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function getAllVehicles(): Collection
    {
        return $this->vehicleRepository->getAll();
    }

    public function saveVehicle(array $vehicle): Vehicle
    {
        return $this->vehicleRepository->create($vehicle);
    }

    public function updateVehicle(string $vehicleId, array $data): ?Vehicle
    {
        $vehicle = $this->vehicleRepository->findOrFail($vehicleId);
        $this->vehicleRepository->update($vehicle, $data);
        return $vehicle;
    }

    public function deleteVehicle(string $vehicleId): bool
    {
        $vehicle = $this->vehicleRepository->findOrFail($vehicleId);
        return $this->vehicleRepository->delete($vehicle);
    }
}
