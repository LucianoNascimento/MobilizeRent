<?php

namespace Database\Factories;

use App\Models\Vehicle;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Nome do arquivo para salvar a imagem
        $fileName = 'images' . DIRECTORY_SEPARATOR . $this->faker->uuid . '.jpg';

        // Criar uma imagem de placeholder localmente com PHP
        $width = 400;
        $height = 400;
        $image = imagecreate($width, $height);

        // Definir as cores
        $bgColor = imagecolorallocate($image, 204, 204, 204); // Cor de fundo cinza
        $textColor = imagecolorallocate($image, 0, 0, 0); // Cor do texto preto

        // Preencher o fundo
        imagefill($image, 0, 0, $bgColor);

        // Adicionar texto ao centro
        $fontSize = 5;
        $text = 'Placeholder';
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $textHeight = imagefontheight($fontSize);
        $x = ($width - $textWidth) / 2;
        $y = ($height - $textHeight) / 2;
        imagestring($image, $fontSize, $x, $y, $text, $textColor);

        // Salvar a imagem no diretório público
        ob_start();
        imagejpeg($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        Storage::disk('public')->put($fileName, $imageData);

        return [
            'vehicle_id' => Vehicle::inRandomOrder()->first()->id, // Seleciona um vehicle_id existente de forma aleatória
            'path' => $fileName, // Caminho da imagem salva
        ];
    }
}
