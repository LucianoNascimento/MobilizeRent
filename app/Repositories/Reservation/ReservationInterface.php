<?php

namespace App\Repositories\Reservation;


use App\Models\Reservation;

interface ReservationInterface
{
    public function findReservationById(int $id): Reservation;

    public function create(array $data): Reservation;

    public function update(Reservation $reservation, array $data): bool;

    public function delete(Reservation $reservation): bool;
}
