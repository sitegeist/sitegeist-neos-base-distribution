/* eslint-disable */

const fs = require('fs');
const path = require('path');

module.exports = function(content) {
	const basePath = path.join(
		path.dirname(this.resourcePath),
		path.basename(this.resourcePath, '.entry.ts')
	);

	if (fs.existsSync(`${basePath}.fusion`)) {
		const parsedFusionSource = /prototype\(([.:a-zA-Z0-9]*)\)/.exec(
			fs.readFileSync(`${basePath}.fusion`)
		);

		if (parsedFusionSource) {
			const prototypeName = parsedFusionSource[1];
			const [packageKey] = prototypeName.split(':');
			const exportName = path.basename(this.resourcePath, '.entry.ts');
			const additionalFusionSource = `prototype(${prototypeName}) {
	renderer.@process.augmentWithJavaScriptComponent = Neos.Fusion:Augmenter {
		data-esm = '${packageKey}:${exportName}'
	}
}
`;

			fs.writeFileSync(`${basePath}.js.fusion`, additionalFusionSource);
		}
	}

	return content;
}
