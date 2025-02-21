<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
use App\Services\Image\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class ImageController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        $images = Cache::remember('images', 3600, function () {
            return $this->imageService->allImages();
        });
        return response()->json($images, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreImageRequest $request): JsonResponse
    {
        $images = $request->file('images');
        $imageData = $this->imageService->uploadImages($images, $request->vehicle_id);

        return response()->json([
            'message' => 'Imagem(s) carregada(s) com sucesso',
            'data' => $imageData
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $image = Cache::remember('images_{id}', 3600, function () use ($id) {
            return $this->imageService->detailImageVehicle($id);
        });

        return response()->json($image, Response::HTTP_OK);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }
}
