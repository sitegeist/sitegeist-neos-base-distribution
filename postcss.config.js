module.exports = {
	plugins: [
		require('precss'),
		require('postcss-custom-media'),
		require('postcss-media-minmax'),
		require('postcss-mixins'),
		require('autoprefixer'),
		require('postcss-discard-duplicates'),
	]
};
