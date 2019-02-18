module.exports = {
	transform: {
		'^.+\\.tsx?$': 'ts-jest'
	},
	testMatch: ['<rootDir>/DistributionPackages/*/Resources/Private/Fusion/**/*.spec.ts'],
	moduleFileExtensions: [
		'ts',
		'tsx',
		'js',
		'jsx',
		'json',
		'node'
	],
	modulePathIgnorePatterns: [
		'<rootDir>/Packages/'
	]
};
