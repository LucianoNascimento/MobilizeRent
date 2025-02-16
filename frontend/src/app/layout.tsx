import type { Metadata } from "next";
import { Inter, Roboto_Mono  } from "next/font/google";
import "./globals.css";

const inter = Inter({
  variable: "--font-inter",
  subsets: ["latin"],
});

const robotMono = Roboto_Mono({
  variable: "--font-robot-mono",
  subsets: ["latin"],
});

export const metadata: Metadata = {
  title: "MobilizeRent",
  description: "Sistema de gerenciamento de veiculos em geral",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body
        className={`${inter.variable} ${robotMono.variable} antialiased`}
      >
        {children}
      </body>
    </html>
  );
}
