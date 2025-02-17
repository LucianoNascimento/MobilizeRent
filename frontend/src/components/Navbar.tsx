// components/NavBar.tsx
import React from "react";
import Link from "next/link";

const NavBar: React.FC = () => {
    return (
        <header className="w-full bg-[#FA433B] shadow p-4 flex justify-between items-center">
            <h1 className="text-xl font-bold">Sistema de Aluguel de Veículos</h1>
            <nav>
                <Link href="/login" legacyBehavior>
                    <a className="text-blue-600 hover:underline">Login</a>
                </Link>
            </nav>
        </header>
    );
};

export default NavBar;
