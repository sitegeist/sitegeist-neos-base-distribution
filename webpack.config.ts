import * as webpack from 'webpack';
import querystring from 'querystring';
import path from 'path';
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
		'Vendor.Site': [
			`./Build/JavaScript/components-loader!?${querystring.stringify({
				componentPaths: [
					'./DistributionPackages/Vendor.Site/Resources/Private/Fusion/Presentation'
				],
				runtime: './DistributionPackages/Vendor.Site/Resources/Private/Fusion/Root.ts'
			})}`
		]
	},

	output: {
		filename: '[name]/Resources/Public/JavaScript/main.min.js',
		path: path.join(__dirname, 'DistributionPackages')
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
					reportFiles: ['!DistributionPackages/**/*.spec.ts']
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
		}, {
			test: /\.css$/,
			exclude: /(node_modules)/,
			use: [MiniCssExtractPlugin.loader, {
				loader: './Build/JavaScript/css-loader'
			}, {
				loader: 'css-loader',
				options: {
					modules: {
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
			filename: '[name]/Resources/Public/Styles/main.min.css'
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
