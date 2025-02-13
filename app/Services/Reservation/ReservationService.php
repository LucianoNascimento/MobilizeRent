<?php

namespace App\Services\Reservation;

use App\Models\Reservation;

use App\Repositories\Reservation\ReservationInterface;
use App\Repositories\Reservation\ReservationRepository;


class ReservationService
{
    protected ReservationRepository $reservationRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(ReservationInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function createReserve(array $data): Reservation
    {
        return $this->reservationRepository->create($data);
    }

    public function updateReserve(int $id, array $data): ?Reservation
    {
        $reservation = $this->reservationRepository->findReservationById($id);
        $this->reservationRepository->update($reservation, $data);
        return $reservation;
    }

    public function deleteReservation(int $id): bool
    {
        $reservation = $this->reservationRepository->findReservationById($id);
        return $this->reservationRepository->delete($reservation);
    }

}
