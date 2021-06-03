module.exports = {
	plugins: [
		require('tailwindcss'),
		require('autoprefixer'),
		require('postcss-discard-duplicates'),
		require('cssnano'),
	]
};
