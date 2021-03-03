const fs = require('fs');
const path = require('path');
const vm = require('vm');
const {Parser} = require('acorn');
const escodegen = require('escodegen');

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
			const cssModuleAst = Parser.parse(content, {sourceType: 'module'});
			const node = cssModuleAst.body.find(node => {
				return (
					node.type === 'ExpressionStatement' &&
					node.expression.type === 'AssignmentExpression' &&
					node.expression.left.type === 'MemberExpression' &&
					node.expression.left.object.name === '___CSS_LOADER_EXPORT___'
				);
			});

			if (node) {
				const code = escodegen.generate(node.expression.right);
				const additionalFusionSource = `prototype(${prototypeName}) {
	renderer.@context.styles = \${${code}}
}`;
				fs.writeFileSync(`${basePath}.css.fusion`, additionalFusionSource);
			}
		}
	}

	return content;
};
