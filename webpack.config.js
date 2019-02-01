const path = require('path');
const querystring = require('querystring');
const webpack = require('webpack');
const LiveReloadPlugin = require('webpack-livereload-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');

module.exports = (_, argv) => ({
	devtool: 'source-map',

	entry: {
		'Sitegeist.Site.Placeholder': [
			'./Build/JavaScript/polyfill',
			`./Build/JavaScript/components-loader!?${querystring.stringify({
				componentPaths: [
					'./DistributionPackages/Sitegeist.Site.Placeholder/Resources/Private/Fusion/Presentation'
				],
				runtime: './DistributionPackages/Sitegeist.Site.Placeholder/Resources/Private/Fusion/Root.js'
			})}`
		]
	},

	output: {
		filename: '[name]/Resources/Public/JavaScript/main.js',
		path: path.join(__dirname, 'DistributionPackages')
	},

	module: {
		rules: [{
			test: /\.jsx?$/,
			exclude: /(node_modules)/,
			use: {
				loader: 'babel-loader'
			}
		}, {
			test: /\.fusion$/,
			use: [{
				loader: 'babel-loader'
			}, {
				loader: './Build/JavaScript/fusion-loader',
				options: {
					compress: argv.mode === 'production'
				}
			}]
		}, {
			test: /\.css$/,
			exclude: /(node_modules)/,
			use: [{
				loader: MiniCssExtractPlugin.loader
			}, {
				loader: './Build/JavaScript/css-loader'
			}, {
				loader: 'css-loader',
				options: {
					sourceMap: true,
					modules: true,
					localIdentName: '[local]___[hash:base64:5]'
				}
			}, {
				loader: 'postcss-loader'
			}]
		}]
	},

	plugins: [
		new webpack.IgnorePlugin(/\.spec.js?$/),
		new MiniCssExtractPlugin({
			filename: '[name]/Resources/Public/Styles/main.css',
			path: path.join(__dirname, 'DistributionPackages')
		}),
		new LiveReloadPlugin({
			appendScriptTag: true
		})
	],

	optimization: {
		minimizer: [
			new UglifyJsPlugin({
				cache: true,
				parallel: true,
				sourceMap: true
			}),
			new OptimizeCSSAssetsPlugin({})
		]
	}
});
