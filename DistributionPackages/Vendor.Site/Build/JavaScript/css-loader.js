/* eslint-disable */

const fs = require('fs');
const path = require('path');
const vm = require('vm');

function runInSandbox(code, loaderContext) {
	const sandbox = {
		module: {
			id: ''
		},
		get: request => new Promise((resolve, reject) => {
			if (request.endsWith('cssWithMappingToString.js')) {
				resolve(null);
			} else if (request.endsWith('runtime/api.js')) {
				resolve(() => ({
					push: () => { },
					i: () => { }
				}));
			} else {
				loaderContext.loadModule(request, (err, source) => {
					if (err) {
						reject(err);
					} else {
						resolve(runInSandbox(source, loaderContext));
					}
				});
			}

		})
	};

	const modifiedCode = `async function main() { ${code
		.replace(/module\.exports \= /gi, 'return ')
		.replace(/require\(/gi, 'await get(')
		} }`;

	vm.runInContext(modifiedCode, vm.createContext(sandbox));

	return sandbox.main();
}

module.exports = async function (content) {
	const callback = this.async();
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
			const sandbox = {
				get: request => new Promise((resolve, reject) => {
					this.loadModule(request, (err, source) => {
						if (err) {
							reject(err);
						} else {
							vm.runInContext(source, sandbox);
							resolve(sandbox.main());
						}
					});
				})
			};

			try {
				const {locals: json} = await runInSandbox(content, this);

				const additionalFusionSource = `prototype(${prototypeName}) {
	renderer.@context.styles = \${${JSON.stringify(json)}}
}
`;

				fs.writeFileSync(`${basePath}.css.fusion`, additionalFusionSource);
				callback(null, content);
			} catch (err) {
				callback(err);
			}
		}
	} else {
		callback(null, content);
	}
};
