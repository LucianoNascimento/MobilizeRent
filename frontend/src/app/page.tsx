'use client';
import {useEffect, useState} from "react";
import Head from 'next/head';
import {fetchImages, ImageProps} from "@/lib/api";
import Image from '../components/Image';

export default function Home() {
    const [images, setImages] = useState<ImageProps[]>([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const getImages = async () => {
            try {
                const data = await fetchImages();
                console.log('Dados recebidos da API:', data);
                setImages(data);
            } catch (error) {
                console.error(error);
            } finally {
                setLoading(false);
            }
        };

        getImages();
    }, []);

    return (
        <div className="min-h-screen flex flex-col items-center justify-center bg-gray-100 py-2">
            <Head>
                <title>Sistema de Aluguel de Veículos</title>
                <link rel="icon" href="/favicon.ico"/>
            </Head>

            <main className="flex flex-col items-center justify-center w-full flex-1 px-20 text-center">
                <h1 className="text-6xl font-bold">
                    Bem-vindo ao <span className="text-blue-600">Sistema de Aluguel de Veículos</span>
                </h1>

                <p className="mt-3 text-2xl">
                    Descubra o veículo ideal para cada momento da sua jornada!
                </p>

                {loading ? (
                    <p>Carregando imagens...</p>
                ) : (
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                        {images.map((image, index) => (
                            <Image key={index} image={image}/>
                        ))}
                    </div>
                )}
            </main>

            <footer className="flex items-center justify-center w-full h-24 border-t">
                <p className="text-center">&copy; 2025 Sistema de Aluguel de Veículos. Todos os direitos reservados.</p>
            </footer>
        </div>
    );
}
