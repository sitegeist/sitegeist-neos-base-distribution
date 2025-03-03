import { Plugin } from "vite";
import fs from "fs";
import { COMPONENT_EXPORT_REGEX, getFusionMetadata } from "./fusionUtils";

const createFusionSource = (prototypeName: string, packageKey: string, componentName: string) => {
	return `prototype(${prototypeName}) {
	renderer.@process.augmentWithJavaScriptComponent = Neos.Fusion:Augmenter {
		data-esm = '${packageKey}:${componentName}'
	}
}`;
};

const jsFusionLoader = (basePath: string) => {
	const fusionMetadata = getFusionMetadata(basePath);
	if (!fusionMetadata) return;

	const { prototypeName, packageKey, componentName } = fusionMetadata;
	const additionalFusionSource = createFusionSource(prototypeName, packageKey, componentName);

	const fusionOutputPath = `${basePath}.js.fusion`;
	fs.writeFileSync(fusionOutputPath, additionalFusionSource);

	return componentName;
};

const transformComponent = (code: string, componentName: string) => {
	const match = code.match(COMPONENT_EXPORT_REGEX);
	if (!match) return code;

	const [fullMatch, params, body] = match;
	const transformed = `window.componentFn["${componentName}"] = (${params}) => {${body}}`;

	return code.replace(fullMatch, transformed);
};

export const jsFusionPlugin = (): Plugin => {
	return {
		name: "js-fusion-plugin",
		transform(code, filePath) {
			if (!filePath.endsWith(".entry.ts")) return code;

			const basePath = filePath.replace(".entry.ts", "");
			if (!fs.existsSync(`${basePath}.fusion`)) return code;

			const componentName = jsFusionLoader(basePath);
			if (!componentName) return code;

			return transformComponent(code, componentName);
		},
	};
};
