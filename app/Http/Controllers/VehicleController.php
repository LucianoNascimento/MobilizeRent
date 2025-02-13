<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Vehicle;
use App\Services\Vehicle\VehicleService;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    protected VehicleService $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $vehicle = $this->vehicleService->getAllVehicles();
        return response()->json($vehicle);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request): JsonResponse
    {
        $vehicle = $this->vehicleService->saveVehicle($request->validated());
        return response()->json($vehicle, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, string $id): JsonResponse
    {
        $vehicle = $this->vehicleService->updateVehicle($id, $request->validated());
        return response()->json($vehicle, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $this->vehicleService->deleteVehicle($id);
        return response()->json(null, 204);
    }
}
