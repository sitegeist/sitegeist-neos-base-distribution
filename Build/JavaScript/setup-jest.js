//
// Extend jest with puppeteer
//
require('expect-puppeteer');

//
// Extend jest with the ability to render fusion components
//
const querystring = require('querystring');
const path = require('path');

const DEFAULT_OPTIONS = {
	propSet: '__default',
	sitePackageKey: process.env.SITE_PACKAGE_KEY,
	locales: '',
	props: {}
};

global.createFusionComponentUri = (prototypeName, __options = {}) => {
	const options = Object.assign(
		{},
		DEFAULT_OPTIONS,
		__options,
		__options.props ? {
			props: JSON.stringify(__options.props)
		} : {},
		{prototypeName}
	);

	return `http://ddev-${process.env.DDEV_SITENAME}-web/monocle/preview/index?${querystring.stringify(options)}`;
};

//
// Extend jest with Modal assertions
//
expect.extend({
	async toContainVisibleElement(page, selector) {
		const pass = await page.$eval(selector, el => {
			return (
				el !== null &&
				window.getComputedStyle(el).opacity > 0 &&
				window.getComputedStyle(el).display !== 'none' &&
				window.getComputedStyle(el).visibility === 'visible' &&
				el.getBoundingClientRect() &&
				el.getBoundingClientRect().bottom > 0 &&
				el.getBoundingClientRect().right > 0
			);
		});

		if (pass) {
			return {
				message: () => `expected element with selector "${selector}" not to be visible on the page.`,
				pass: true
			};
		}

		return {
			message: () => `expected element with selector "${selector}" to be visible on the page.`,
			pass: false
		};
	}
});

//
// Set Jest Timeout
//
jest.setTimeout(30000);
