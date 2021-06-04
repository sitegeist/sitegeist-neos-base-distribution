module.exports = {
	prototypeName: 'Dummy.Prototype',
	script: () => {
		throw new Error(`Script should not be called in a test. Please import initialization script directly.`);
	},
	styles: new Proxy({}, {
		get: (_, prop) => prop
	})
};
