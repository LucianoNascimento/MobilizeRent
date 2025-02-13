<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Services\Reservation\ReservationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function index(): JsonResponse
    {
        $reservation = Reservation::all();

        return response()->json($reservation, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $reservation = $this->reservationService->createReserve($request->all());
        return response()->json($reservation, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $reservation = Reservation::findOrFail($id);
        $this->reservationService->updateReserve($id, $request->all());

        return response()->json($reservation, 200);
    }

    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $reservation = Reservation::findOrFail($id);
        $status = $request->status;
        $this->reservationService->updateReserve($id, ['status', $status]);

        return response()->json($reservation, 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->reservationService->deleteReservation($id);
        return response()->json(null, 204);
    }
}
