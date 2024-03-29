const fs = require('fs');
const path = require('path');

module.exports = function (fusionSource) {
	const basePath = path.join(
		path.dirname(this.resourcePath),
		path.basename(this.resourcePath, '.fusion')
	);
	const parsedFusionSource = /prototype\(([.:a-zA-Z0-9]*)\)/.exec(fusionSource);

	if (parsedFusionSource) {
		const prototypeName = parsedFusionSource[1];
		const exportName = prototypeName;
		const importStatements = [];
		const exportStatements = [];

		exportStatements.push(`export const prototypeName = '${exportName}';`);

		if (fs.existsSync(`${basePath}.css`)) {
			importStatements.push(`import styles from '${basePath}.css';`);
			exportStatements.push('export {styles};');
		}

		if (!fs.existsSync(`${basePath}.css`) && fs.existsSync(`${basePath}.css.fusion`)) {
			fs.unlinkSync(`${basePath}.css.fusion`);
		}

		if (fs.existsSync(`${basePath}.js`)) {
			throw new Error(`Do not use JS files for components. Please create a "${path.basename(basePath)}.ts" instead.`);
		}

		if (!fs.existsSync(`${basePath}.ts`) && !fs.existsSync(`${basePath}.js`) && fs.existsSync(`${basePath}.js.fusion`)) {
			fs.unlinkSync(`${basePath}.js.fusion`);
		}

		if (fs.existsSync(`${basePath}.ts`)) {
			importStatements.push(`import script from '${basePath}.ts';`);
			exportStatements.push('export {script};');

			const additionalFusionSource = `
prototype(${prototypeName}) {
	renderer.@process.augmentWithJavaScriptComponent = Neos.Fusion:Augmenter {
		data-component = '${exportName}'
	}
}
			`;

			fs.writeFileSync(`${basePath}.js.fusion`, additionalFusionSource);
		}

		return [...importStatements, '', ...exportStatements].join('\n');
	}

	return '';
};
