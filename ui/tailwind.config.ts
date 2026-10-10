import type { Config } from "tailwindcss";
const config: Config = { content: ["./src/**/*.{js,ts,jsx,tsx,mdx}"], theme: { extend: { colors: { ocean: "#063b4c", lagoon: "#0d7181", sand: "#f4ead8", coral: "#ef8b62" }, fontFamily: { sans: ["Arial", "sans-serif"] } } }, plugins: [] };
export default config;