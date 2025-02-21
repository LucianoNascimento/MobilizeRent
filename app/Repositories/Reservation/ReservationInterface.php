<?php

namespace App\Repositories\Reservation;


use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;

interface ReservationInterface
{
    public function findReservationById(int $id): Reservation;

    public function create(array $data): Reservation;

    public function update(Reservation $reservation, array $data): bool;

    public function delete(Reservation $reservation): bool;

    public function showStatus(string $status):Collection;
}
