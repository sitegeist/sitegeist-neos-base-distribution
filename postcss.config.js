module.exports = {
	plugins: [
		require('postcss-nested'),
		require('postcss-custom-media'),
		require('postcss-media-minmax'),
		require('postcss-mixins'),
		require('precss'),
		require('autoprefixer'),
		require('postcss-custom-properties'),
		require('postcss-calc'),
		require('postcss-image-set-polyfill'),
		require('postcss-selector-not'),
		require('postcss-discard-duplicates'),
		require('postcss-object-fit-images')
	]
};
