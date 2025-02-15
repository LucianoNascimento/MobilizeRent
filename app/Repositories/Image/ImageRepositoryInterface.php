<?php

namespace App\Repositories\Image;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

interface ImageRepositoryInterface
{
    /**
     * Obter todas as imagens.
     *
     * @return Collection
     */
    public function getAllImages(): Collection;

    /**
     * Inserir nova imagem.
     *
     * @param array $imageData
     * @return void
     */
    public function insert(array $imageData): void;

    /**
     * Armazenar múltiplas imagens para um veículo.
     *
     * @param array $images
     * @param int $vehicle_id
     * @return array
     */
    public function storeImages(array $images, int $vehicle_id): array;

    /**
     * Obter detalhes da imagem e seu veículo relacionado.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function detailImageVehicle(int $id);
}
