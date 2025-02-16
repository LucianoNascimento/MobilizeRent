'use client';
import {useEffect, useState} from "react";
import Header from '../components/Header';
import Loading from '../components/Loading';
import ImageGrid from '../components/ImageGrid';
import Footer from '../components/Footer';
import {fetchImages, ImageProps} from "@/lib/api";

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
            <Header/>

            <main className="flex flex-col items-center justify-center w-full flex-1 px-20 text-center">
                <h1 className="text-6xl font-bold">
                    Bem-vindo ao <span className="text-blue-600">Sistema de Aluguel de Veículo</span>
                </h1>

                <p className="mt-3 text-2xl">
                    Descubra o veículo ideal para cada momento da sua jornada!
                </p>

                {loading ? (<Loading/>) : (<ImageGrid images={images}/>)}
            </main>

            <Footer/>
        </div>
    );
}
