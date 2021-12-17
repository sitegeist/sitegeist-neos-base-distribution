import * as webpack from 'webpack';
import path from 'path';
import glob from 'glob';

import packageJson from './package.json';
import composerJson from './composer.json';

interface ComposerJson {
	extra: {
		neos: {
			'package-key': string;
		};
	};
}

const shared = [
	...Object.entries(packageJson.dependencies).map(
		([name, version]) => ({
			[name]: {
				requiredVersion: version,
				singleton: true
			}
		})
	)
];

export function buildCommonConfig(): webpack.Configuration {
	return {
		stats: 'minimal',

		output: {
			filename: 'JavaScript/[name].min.js',
			chunkFilename: `JavaScript/[id].chunk.js?t=${Date.now()}`,
			path: path.join(process.cwd(), 'Resources/Public/Build')
		},

		resolve: {
			extensions: ['.ts', '.tsx', '.js', '.json']
		},

		module: {
			rules: [
				{
					test: /\.entry\.tsx?$/,
					use: [{
						loader: require.resolve('./Build/ts-entry-loader')
					}]
				},
				{
					test: /\.tsx?$/,
					use: [{
						loader: 'ts-loader'
					}]
				},
			]
		},

		plugins: [
			new webpack.IgnorePlugin({
				resourceRegExp: /\.spec.ts$/,
			}),
		],

		optimization: {
			minimize: true,
		},
	};
}

export function buildRuntimeConfig() {
	const common = buildCommonConfig();

	return {
		...common,
		entry: './Resources/Private/Fusion/Root.ts',
		plugins: [
			...(common.plugins as any[]),
			new webpack.container.ModuleFederationPlugin({
				name: 'host',
				shared
			}),
		]
	};
}

export function buildComponentsConfig(composerJson: ComposerJson, entry?: string) {
	const common = buildCommonConfig();
	const foo = glob.sync('./Resources/Private/**/Root.ts');
	const components = glob.sync('./Resources/Private/Fusion/Presentation/**/*.entry.ts');

	return {
		...common,
		entry: entry ? entry : {foo},
		plugins: [
			...(common.plugins as any[]),
			new webpack.container.ModuleFederationPlugin({
				name: composerJson.extra.neos['package-key'].replace(/\./g, '_'),
				filename: 'JavaScript/components.js',
				exposes: components.reduce<{ [key: string]: string }>(
					(entries, pathToEntryFile) => {
						const componentName = path.basename(pathToEntryFile, '.entry.ts');
						entries[`components/${componentName}`] = pathToEntryFile;

						return entries;
					},
					{}
				),
				shared
			}),
		]
	};
}

export default [
	buildRuntimeConfig(),
	buildComponentsConfig(composerJson)
];
