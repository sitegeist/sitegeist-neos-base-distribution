module.exports = {
	content: [
		'./Resources/Private/Fusion/**/*',
		'./Resources/Private/Fusion/**/*.{ts,tsx,fusion,css}',
	],
	theme: {
		colors: {
			brand: {
				DEFAULT: '#564e58',
				contrast: '#fff',
				grey: '#efefef'
			},
			cta: {
				DEFAULT: '#ff934f',
				contrast: '#000'
			},
			info: {
				DEFAULT: '#76bed0',
				contrast: '#000'
			},
			error: {
				DEFAULT: '#f61067',
				contrast: '#fff'
			},
			success: {
				DEFAULT: '#20fc8f',
				contrast: '#000'
			},
			warning: {
				DEFAULT: '#f4e04d',
				contrast: '#000'
			},
		},
		extend: {},
	},
	variants: {
		extend: {},
	},
	plugins: [
		require('@tailwindcss/typography'),
	],
};
