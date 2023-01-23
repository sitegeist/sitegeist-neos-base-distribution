const theme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')
module.exports = {
	content: [
		'./Resources/Private/Fusion/**/*'
	],
	theme: {
		colors: {
			brand: {
				DEFAULT: '#564e58',
				contrast: '#fff'
			},
			cta: {
				DEFAULT: '#ff934f',
				contrast: '#000'
			},
			neutral: {
				lighter: colors.gray[200],
				DEFAULT: colors.gray[500],
				darker: colors.gray[900]
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
	plugins: [
		require('@tailwindcss/typography'),
	],
};
