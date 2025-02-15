<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_images(): void
    {
        // Mockando o storage para não salvar arquivos de verdade
        Storage::fake('public');

        // Criando um veículo com ID 1
        $vehicle = Vehicle::factory()->create(['id' => 1]);

        // Dados da requisição
        $vehicleId = $vehicle->id;
        $files = [
            UploadedFile::fake()->image('image1.jpg'),
            UploadedFile::fake()->image('image2.jpg')
        ];

        // Fazendo a requisição POST para o endpoint de upload de imagens
        $response = $this->postJson('/api/images', [
            'vehicle_id' => $vehicleId,
            'images' => $files,
        ]);

        // Verificando o status da resposta
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'message',
            'data' => [
                '*' => [
                    'vehicle_id',
                    'path'
                ]
            ]
        ]);

        // Verificando se os arquivos foram armazenados
        foreach ($files as $file) {
            Storage::disk('public')->assertExists('images/' . $file->hashName());
        }

        // Verificando se os dados foram inseridos no banco de dados
        $this->assertDatabaseCount('images', count($files));
        $this->assertDatabaseHas('images', [
            'vehicle_id' => $vehicleId,
        ]);
    }

    public function test_show_returns_200(): void
    {
        $vehicle = Vehicle::factory()->create();

        $image = Image::factory()->create(['vehicle_id' => $vehicle->id]);

        $response = $this->getJson("/api/images/{$image->id}");

        $response->assertStatus(200);
    }
}
