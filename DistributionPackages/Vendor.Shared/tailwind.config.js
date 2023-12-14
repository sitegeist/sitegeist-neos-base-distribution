const MIN_TOUCH = '48px';
const MAX_CONTENT_WIDTH = '1000px';

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
		extend: {
			gridTemplateColumns: {
				'2-33-66': '1fr 2fr',
				'2-66-33': '2fr 1fr',
			},
			maxWidth: {
				'content-full': `${MAX_CONTENT_WIDTH}`
			},
			minWidth: {
				touch: MIN_TOUCH,
			},
			minHeight: {
				touch: MIN_TOUCH,
			},
		},
	},
	variants: {
		extend: {},
	},
	plugins: [
		require('@tailwindcss/typography'),
	],
};
