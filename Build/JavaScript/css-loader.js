const fs = require('fs');
const path = require('path');
const vm = require('vm');

module.exports = function (content) {
	const basePath = path.join(
		path.dirname(this.resourcePath),
		path.basename(this.resourcePath, '.css')
	);

	if (fs.existsSync(`${basePath}.fusion`)) {
		const parsedFusionSource = /prototype\(([.:a-zA-Z0-9]*)\)/.exec(
			fs.readFileSync(`${basePath}.fusion`)
		);

		if (parsedFusionSource) {
			const prototypeName = parsedFusionSource[1];
			const exports = {};
			const sandbox = {
				__webpack_public_path__: '', // eslint-disable-line
				module: {exports},
				exports
			};

			vm.createContext(sandbox);
			vm.runInContext(content.split('// Exports')[1], sandbox);

			const additionalFusionSource = `
prototype(${prototypeName}) {
	renderer.@context.styles = \${${JSON.stringify(sandbox.module.exports.locals)}}
}
			`;

			fs.writeFileSync(`${basePath}.css.fusion`, additionalFusionSource);
		}
	}

	return content;
};
