'use client';
import {useEffect, useState} from "react";
import MetaHeader from '../components/MetaHeader';
import Loading from '../components/Loading';
import ImageGrid from '../components/ImageGrid';
import Footer from '../components/Footer';
import {fetchImages, ImageProps} from "@/lib/api";
import Navbar from "@/components/Navbar";

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
        <div className="min-h-screen flex flex-col items-center justify-center bg-[#F0D333] py-2">
            <MetaHeader/>
            <Navbar/>

            <main className="flex flex-col items-center justify-center w-full flex-1 px-20 text-center">
                <h1 className="text-6xl font-bold">
                    Bem-vindo(a) a <span className="text-[#4CC9F5]"> MobilizeRent</span> <span className="text-blue-600">O Sistema de Aluguel de Veículos</span>
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
