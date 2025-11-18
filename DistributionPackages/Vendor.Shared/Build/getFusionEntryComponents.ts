import { glob } from "glob";
import fs from "fs";
import { getFusionMetadata } from "./fusionUtils";

export const getFusionEntryComponents = () => {
	const components = glob.sync("./Resources/Private/Fusion/**/*.entry.ts");

	return components.reduce<{ [key: string]: string }>((entries, pathToEntryFile) => {
		const basePath = pathToEntryFile.replace(".entry.ts", "");

		if (!fs.existsSync(`${basePath}.fusion`)) return entries;

		const fusionMetadata = getFusionMetadata(basePath);
		if (!fusionMetadata) return entries;

		const { componentName } = fusionMetadata;
		entries[`components/${componentName}`] = pathToEntryFile;

		return entries;
	}, {});
};
