<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function login()
    {
        try {
            // Obter o usuário do Google
            $googleUser = Socialite::driver('google')->user();

            // Verificar se o email está presente
            if (!$googleUser->email) {
                throw new \Exception('O email do usuário não está disponível.');
            }

            // Atualizar ou criar o usuário no banco de dados
            $user = User::updateOrCreate([
                'email' => $googleUser->email
            ], [
                'name' => $googleUser->name,
                'nickname' => $googleUser->nickname,
                'avatar' => $googleUser->avatar,
                'token' => $googleUser->token,
                'refreshToken' => $googleUser->refreshToken,
                'google_id' => $googleUser->id,
                'password' => bcrypt($googleUser->token),
                'user_type' => 'client', // Definir valor padrão para user_type
            ]);

            Log::info(json_encode($user));

            // Logar o usuário
            Auth::login($user);

            // Redirecionar o usuário para a página de login do Next.js com o parâmetro de sucesso
            return redirect('http://localhost:3000/login?logged_in=true');
        } catch (\Exception $e) {
            Log::error('Erro ao autenticar com o Google: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Erro ao autenticar com o Google');
        }
    }
}
