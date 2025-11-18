import { defineConfig } from "vite";

import { jsFusionPlugin } from "./Build/jsFusionPlugin";
import { getFusionEntryComponents } from "./Build/getFusionEntryComponents";

/** @type {import("vite").UserConfig} */
export default defineConfig(() => {
	return {
		plugins: [jsFusionPlugin()],
		build: {
			outDir: "Resources/Public/Build/JavaScript",
			minify: true,
			emptyOutDir: false,
			modulePreload: false,
			rollupOptions: {
				input: getFusionEntryComponents(),
				output: {
					entryFileNames: "[name].js",
					chunkFileNames: "[name].[hash].js",
					assetFileNames: "[name].[hash].[ext]",
				},
			},
		},
	};
});
