import fs from "fs";

export const COMPONENT_EXPORT_REGEX = /export\s+default\s+\(([^)]+)\)\s*=>\s*{([\s\S]*?)}/;
export const FUSION_PROTOTYPE_REGEX = /prototype\(([.:a-zA-Z0-9]*)\)/;
export const PROTOTYPE_NAME_INDEX = 1;

export const getFusionMetadata = (fusionFolderPath: string) => {
	const fusionFilePath = `${fusionFolderPath}.fusion`;

	const fusionContent = fs.readFileSync(fusionFilePath, "utf8");
	const parsedFusionSource = FUSION_PROTOTYPE_REGEX.exec(fusionContent);

	if (!parsedFusionSource) return;

	const prototypeName = parsedFusionSource[PROTOTYPE_NAME_INDEX];
	const [packageKey, componentName] = prototypeName.split(":");

	return { prototypeName, packageKey, componentName };
};
