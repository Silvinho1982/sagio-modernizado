import type { Metadata } from "next";
import "./globals.css";
import { SiteHeader } from "@/components/site-header";
import { SiteFooter } from "@/components/site-footer";
export const metadata: Metadata = { title: "Sagio Turismo | Rota das Emoções", description: "Experiências no Delta do Parnaíba, Lençóis Maranhenses e Rota das Emoções." };
export default function RootLayout({ children }: Readonly<{children: React.ReactNode}>) { return <html lang="pt-BR"><body><SiteHeader />{children}<SiteFooter /></body></html>; }