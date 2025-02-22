<x-mail::message>
    <!-- Adicione a logo no topo -->
    ![Logo]
    ({{ asset('logo/logo.png') }})

    # Seja bem-vindo(a)!

    {{ $user->name }},

    Estamos felizes em tê-lo(a) conosco. Seu cadastro foi realizado com sucesso.

    <x-mail::button :url="env('FRONTEND_URL') . '/login'">
        Acessar Conta
    </x-mail::button>

    Obrigado,<br>
    {{ config('app.name') }}
</x-mail::message>
