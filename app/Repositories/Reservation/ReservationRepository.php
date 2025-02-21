<?php

namespace App\Repositories\Reservation;

use App\Models\Reservation;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class ReservationRepository implements ReservationInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

    public function create(array $data): Reservation
    {
        return Reservation::create($data);
    }

    public function update(Reservation $reservation, array $data): bool
    {
        return $reservation->update($data);
    }

    public function showStatus(string $status): Collection
    {
        return Reservation::where('status', $status)->get();
    }

    public function findReservationById(int $id): Reservation
    {
        return Reservation::findOrFail($id);
    }

    public function delete(Reservation $reservation): bool
    {
        return $reservation->delete();
    }
}
