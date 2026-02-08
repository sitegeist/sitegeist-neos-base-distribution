import { defineConfig } from "vite";
import react from '@vitejs/plugin-react'

/** @type {import("vite").UserConfig} */
export default defineConfig({
	plugins: [react()],
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
			// Ignore "use-client" Warning
			onwarn(warning, warn) {
				if (warning.code === 'MODULE_LEVEL_DIRECTIVE') {
					return
				}
				warn(warning)
			},
		},
	},
});
