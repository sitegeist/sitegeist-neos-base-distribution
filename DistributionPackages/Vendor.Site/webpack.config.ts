import * as webpack from 'webpack';
import querystring from 'querystring';
import path from 'path';
import fs from 'fs';
import CssMinimizerPlugin from 'css-minimizer-webpack-plugin';
import MiniCssExtractPlugin from 'mini-css-extract-plugin';
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
		filename: 'Resources/Public/Build/JavaScript/[name].min.js',
		path: __dirname
	},

	resolve: {
		extensions: ['.ts', '.tsx', '.js', '.json']
	},

	module: {
		rules: [{
			test: /\.tsx?$/,
			loader: 'esbuild-loader',
			options: {
				loader: 'tsx',
				target: 'es2015'
			}
		}, {
			test: /\.fusion$/,
			use: [{
				loader: './Build/JavaScript/fusion-loader',
				options: {
					compress: true
				}
			}]
		}, {
			test: /\.css$/,
			exclude: /(node_modules)/,
			use: [MiniCssExtractPlugin.loader, {
				loader: './Build/JavaScript/css-loader'
			}, {
				loader: 'css-loader',
				options: {
					esModule: false,
					modules: {
						auto: (resourcePath: string) => {
							const basePath = path.join(
								path.dirname(resourcePath),
								path.basename(resourcePath, '.css')
							);

							return (
								basePath.endsWith('.module') ||
								fs.existsSync(`${basePath}.fusion`) ||
								fs.existsSync(`${basePath}.ts`)
							);
						},
						localIdentName: '[local]___[hash:base64:5]'
					},
					sourceMap: true,
					importLoaders: 1
				}
			}, {
				loader: 'postcss-loader'
			}]
		}]
	},

	plugins: [
		new webpack.IgnorePlugin({
			resourceRegExp: /\.spec.ts$/
		}),
		new MiniCssExtractPlugin({
			filename: 'Resources/Public/Build/Styles/[name].min.css'
		})
	],

	optimization: {
		minimizer: [
			new TerserPlugin({
				terserOptions: {
					sourceMap: true
				},
				parallel: true,
			}),
			new CssMinimizerPlugin()
		]
	}
};

export default config;
