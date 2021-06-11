const path = require('path');
const glob = require('glob');
const querystring = require('querystring');

const asArray = value => Array.isArray(value) ? value : [value];

module.exports = function () {
	const options = {componentPaths: [],
		runtime: '', ...querystring.parse(this.resourceQuery.substr(1))};
	const componentFileNames = asArray(options.componentPaths)
		.map(path => {
			return `${path}/**/*.+(css|ts|fusion)`;
		})
		.reduce((files, pattern) => [...files, ...glob.sync(pattern)], [])
		.filter(fileName => !fileName.endsWith('.css.fusion'))
		.filter(fileName => !fileName.endsWith('.js.fusion'));
	const source = [];
	const components = [];

	for (const fileName of componentFileNames) {
		const basePath = path.join(
			path.dirname(fileName),
			path.basename(fileName, '.fusion')
		);
		const importName = `_${basePath.split('/').join('_').split('.').join('_')}`;

		switch (true) {
			case fileName.endsWith('.fusion'):
				source.push(`import * as ${importName} from '${fileName}';`);
				components.push(importName);
				break;

			case fileName.endsWith('.css'):
			case fileName.endsWith('.js') && !fileName.endsWith('.spec.js'):
			case fileName.endsWith('.ts') && !fileName.endsWith('.spec.ts'):
				source.push(`import '${fileName}';`);
				break;

			default:
				break;
		}
	}

	source.push(`import runtime from '${options.runtime}';`);
	source.push('var components = {};');

	for (const component of components) {
		source.push(`components[${component}.prototypeName] = ${component};`);
	}

	source.push('runtime(components);');

	return source.join('\n');
};
