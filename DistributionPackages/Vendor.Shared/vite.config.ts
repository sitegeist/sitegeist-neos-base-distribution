import { defineConfig } from "vite";

/** @type {import("vite").UserConfig} */
export default defineConfig({
	build: {
		outDir: "Resources/Public/Build/JavaScript",
		minify: true,
		emptyOutDir: false,
		rollupOptions: {
			input: {
				main: "./Resources/Private/Fusion/Root.ts",
			},
			output: {
				entryFileNames: "[name].min.js",
				chunkFileNames: "[name].min.[hash].js",
				assetFileNames: "[name].min.[hash].[ext]",
			},
		},
	},
	define: {
		BUILD_DATE: Date.now(),
	},
});
