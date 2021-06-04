module.exports = {
	connect: {
		browserWSEndpoint: `ws://ddev-${process.env.DDEV_SITENAME}-chrome:3000`,
		args: ['--disable-dev-shm-usage']
	}
};

