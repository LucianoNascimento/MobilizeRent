<?php

namespace Tests\Feature;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ReservationControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }

    public function test_all_reservation()
    {
        Reservation::factory(3)->create();

        $response = $this->getJson('/api/reservations');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_create_reservation()
    {
        $vehicle = Vehicle::factory()->create();
        $reservationData = [
            'user_id' => $this->user->id,
            'vehicle_id' => $vehicle->id,
            'reservation_date' => '2024-01-15',
            'end_date' => '2024-01-20',
            'price' => 500.00,
            'status' => 'pending',
        ];

        $response = $this->postJson('/api/reservations', $reservationData);

        $response->assertStatus(201);
    }

    public function test_update_reservation()
    {
        $reservation = Reservation::factory()->create(['user_id' => $this->user->id]);
        $updatedData = [
            'price' => 750.00,
            'status' => 'confirmed',
        ];

        $response = $this->putJson("/api/reservation/{$reservation->id}", $updatedData);

        $response->assertStatus(200);
    }

    public function test_update_reservation_status()
    {
        $reservation = Reservation::factory()->create(['user_id' => $this->user->id]);
        $newStatus = ['status' => 'cancelled'];

        $response = $this->patchJson("/api/reservation/{$reservation->id}/status", $newStatus);

        $response->assertStatus(200);
    }



    public function test_delete_reservation()
    {
        $reservation = Reservation::factory()->create(['user_id' => $this->user->id]);

        $response = $this->deleteJson("/api/reservation/{$reservation->id}");
        $response->assertStatus(204);
    }
}
