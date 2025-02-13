<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class VehicleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_all_vehicles()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        Vehicle::factory()->count(5)->create();
        $response = $this->getJson('/api/vehicles');

        $response->assertStatus(200);
    }

    public function test_save_vehicle()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $vehicleData = Vehicle::factory()->make()->toArray();

        $response = $this->postJson(url('/api/vehicles'), $vehicleData);

        $response->assertStatus(201);
    }

    public function test_update_vehicle()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $vehicle = Vehicle::factory()->create();
        $updatedData = Vehicle::factory()->make()->toArray();

        $response = $this->putJson("/api/vehicle/{$vehicle->id}", $updatedData);

        $response->assertStatus(200);
    }

    public function test_delete_vehicle()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $vehicle = Vehicle::factory()->create();

        $response = $this->deleteJson(route('vehicle.destroy', ['id' => $vehicle->id]));

        $response->assertStatus(204);

    }
}
