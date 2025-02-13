<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthRegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_register()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'user_type' => 'client'];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(201);
    }

    public function test_user_login()
    {
        // Criando um usuário de teste
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'), // Necessário para autenticação correta
            'user_type' => 'client'
        ]);

        // Fazendo a requisição para login
        $response = $this->postJson('/api/login', [
            'email' => 'testuser@example.com',
            'password' => 'password',
        ]);

        // Verificando a resposta
        $response->assertStatus(200) // Passport retorna 200 normalmente
        ->assertJsonStructure([
            'token_type',
            'access_token',
        ]);
    }

}
