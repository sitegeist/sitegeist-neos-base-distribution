import * as webpack from 'webpack';
import querystring from 'querystring';
import TerserPlugin from 'terser-webpack-plugin';

const config: webpack.Configuration = {
	devtool: 'source-map',

	stats: {
		modules: false,
		entrypoints: false,
	},

	entry: {
		main: [
			`./Build/JavaScript/components-loader!?${querystring.stringify({
				componentPaths: [
					'./Resources/Private/Fusion/Presentation'
				],
				runtime: './Resources/Private/Fusion/Root.ts'
			})}`
		]
	},

	output: {
		filename: 'Resources/Public/JavaScript/[name].min.js',
		path: __dirname
	},

	resolve: {
		extensions: ['.ts', '.tsx', '.js', '.json']
	},

	module: {
		rules: [{
			test: /\.tsx?$/,
			exclude: /(node_modules)/,
			use: [{
				loader: 'ts-loader',
				options: {
					reportFiles: ['!**/*.spec.ts']
				}
			}]
		}, {
			test: /\.fusion$/,
			use: [{
				loader: './Build/JavaScript/fusion-loader',
				options: {
					compress: true
				}
			}]
		}]
	},

	plugins: [
		new webpack.IgnorePlugin({
			resourceRegExp: /\.spec.ts$/
		}),
	],

	optimization: {
		minimizer: [
			new TerserPlugin({
				terserOptions: {
					sourceMap: true
				},
				parallel: true,
			}),
		]
	}
};

export default config;
