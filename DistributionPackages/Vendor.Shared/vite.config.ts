import { defineConfig } from "vite";

/** @type {import("vite").UserConfig} */
export default defineConfig({
	publicDir: false,
	build: {
		outDir: "./Resources/Public/Build/JavaScript",
		emptyOutDir: false,
		minify: true,
		modulePreload: false,

		rollupOptions: {
			input: {
				main: "./Resources/Private/Root.ts",
			},

			output: {
				entryFileNames: (chunk) => {
					if (chunk.name === "main") {
						return "[name].min.js";
					}
					return "[name].[hash].js";
				},

				chunkFileNames: "[name].[hash].js",
			},
		},
	},
	define: {
		BUILD_DATE: JSON.stringify(Date.now()),
	},
});
