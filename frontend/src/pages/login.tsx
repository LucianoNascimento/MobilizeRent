import React, { useState, useEffect } from "react";
import MetaHeader from "@/components/MetaHeader";
import Link from "next/link";
import { useRouter } from "next/router";

const LoginPage: React.FC = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    const router = useRouter();

    useEffect(() => {
        const searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('logged_in') && searchParams.get('logged_in') === 'true') {
            alert('Usuário logado com sucesso com o Google!');
            router.replace(router.pathname); // Remove o parâmetro da URL
        }
    }, [router]);

    const handleLogin = (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        console.log('Email:', email);
        console.log('Password:', password);
        alert('Usuário logado com sucesso!');
    };

    const handleGoogleLogin = () => {
        window.location.href = 'http://localhost:80/auth/google'; // Redireciona para a rota correta
    };

    return (
        <div className="flex flex-col items-center justify-center h-screen bg-gray-100">
            <MetaHeader/>
            <h1 className="text-2xl font-bold mb-4">Login</h1>
            <form onSubmit={handleLogin} className="bg-white p-6 rounded shadow-md w-80">
                <div className="mb-4">
                    <label htmlFor="email" className="block text-sm font-medium text-gray-700">Email:</label>
                    <input
                        type="email"
                        id="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        required
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    />
                </div>
                <div className="mb-4">
                    <label htmlFor="password" className="block text-sm font-medium text-gray-700">Password:</label>
                    <input
                        type="password"
                        id="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                        className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    />
                </div>
                <button type="submit" className="w-full py-2 px-4 bg-indigo-500 hover:bg-indigo-600 text-white font-bold rounded shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    Login
                </button>
            </form>
            <button onClick={handleGoogleLogin} className="mt-4 w-full py-2 px-4 bg-red-500 hover:bg-red-600 text-white font-bold rounded shadow-md focus:outline-none focus:ring-2 focus:ring-red-400">
                Login com Google
            </button>
            <div className="mt-4">
                <Link href="/register" legacyBehavior>
                    <a className="text-indigo-500 hover:text-indigo-700 font-bold">Fazer Cadastro</a>
                </Link>
            </div>
        </div>
    );
};

export default LoginPage;
