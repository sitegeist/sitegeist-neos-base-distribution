describe('Button', () => {
	const buttonTypes = ['static', 'link', 'button', 'submit'];

	it('renders content', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				content: 'Lorem ipsum...'
			}
		}));

		await expect(page).toMatch('Lorem ipsum...');

		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				content: 'Tuba, Mama, Parkuhr'
			}
		}));

		await expect(page).toMatch('Tuba, Mama, Parkuhr');
	});

	it('renders a <span>-Tag if type is set to "static"', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type: 'static'
			}
		}));

		await expect(page).toMatchElement('span');
	});

	it('has default type "static"', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {}
		}));

		await expect(page).toMatchElement('span');
	});

	it('renders attribute [role="button"] if type is set to "static"', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type: 'static'
			}
		}));

		await expect(page).toMatchElement('span[role="button"]');
	});

	it.each(buttonTypes.filter(buttonType => buttonType !== 'static'))
	('does not render attribute [role="button"] if type is set to "%s"', async type => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {type}
		}));

		await expect(page).not.toMatchElement('[role="button"]');
	});

	it('renders an <a>-Tag if type is set to "link"', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type: 'link'
			}
		}));

		await expect(page).toMatchElement('a');
	});

	it('renders a <button>-Tag with [type="button"] if type is set to "button"', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type: 'button'
			}
		}));

		await expect(page).toMatchElement('button[type="button"]');
	});

	it('renders a <button>-Tag with [type="submit"] if type is set to "submit"', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type: 'submit'
			}
		}));

		await expect(page).toMatchElement('button[type="submit"]');
	});

	it.each(buttonTypes.filter(buttonType => !['submit', 'button'].includes(buttonType)))
	('does not render attribute [type] if type is set to "%s"', async type => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {type}
		}));

		await expect(page).not.toMatchElement('[type]');
	});

	it('renders attribute [id] if id is set', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				id: 'SomeId'
			}
		}));

		await expect(page).toMatchElement('#SomeId');
	});

	it('renders attribute [disabled] if disabled is set to true', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				disabled: true
			}
		}));

		await expect(page).toMatchElement('[disabled]');
	});

	it('renders attribute [name] if name is set', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				name: 'butty-mc-button-the-third'
			}
		}));

		await expect(page).toMatchElement('[name="butty-mc-button-the-third"]');
	});

	it('does not render attribute [name] if name is set and type is set to "static"', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type: 'static',
				name: 'butty-mc-button-the-third'
			}
		}));

		await expect(page).not.toMatchElement('[name="butty-mc-button-the-third"]');
	});

	it('renders attribute [href] if href is set and type is set to "link"', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type: 'link',
				href: 'https://sitegeist.de'
			}
		}));

		await expect(page).toMatchElement('a[href="https://sitegeist.de"]');
	});

	it.each(buttonTypes.filter(buttonType => buttonType !== 'link'))
	('does not render attribute [href] if href is set and type is set to "%s"', async type => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type,
				href: 'https://sitegeist.de'
			}
		}));

		await expect(page).not.toMatchElement('[href="https://sitegeist.de"]');
	});

	it('renders attribute [target] if target is set and type is set to "link"', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type: 'link',
				target: '_blank'
			}
		}));

		await expect(page).toMatchElement('a[target="_blank"]');
	});

	it.each(buttonTypes.filter(buttonType => buttonType !== 'link'))
	('does not render attribute [target] if target is set and type is set to "%s"', async type => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type,
				target: '_self'
			}
		}));

		await expect(page).not.toMatchElement('[target="_self"]');
	});

	it('renders attribute [rel] if rel is set and type is set to "link"', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type: 'link',
				rel: 'nofollow noreferrer'
			}
		}));

		await expect(page).toMatchElement('a[rel="nofollow noreferrer"]');
	});

	it.each(buttonTypes.filter(buttonType => buttonType !== 'link'))
	('does not render attribute [rel] if rel is set and type is set to "%s"', async type => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type,
				rel: 'noopener'
			}
		}));

		await expect(page).not.toMatchElement('[rel="noopener"]');
	});

	it('renders attribute [formaction] if formaction is set and type is set to "submit"', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type: 'submit',
				formaction: 'https://sitegeist.de'
			}
		}));

		await expect(page).toMatchElement('button[formaction="https://sitegeist.de"]');
	});

	it.each(buttonTypes.filter(buttonType => buttonType !== 'submit'))
	('does not render attribute [formaction] if formaction is set and type is set to "%s"', async type => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type,
				formaction: 'https://sitegeist.de'
			}
		}));

		await expect(page).not.toMatchElement('[formaction="https://sitegeist.de"]');
	});

	it.each(['submit', 'button'])
	('renders attribute [value] if value is set to "%s"', async type => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type,
				value: 'The string formerly known as Prince.'
			}
		}));

		await expect(page).toMatchElement('button[value="The string formerly known as Prince."]');
	});

	it.each(buttonTypes.filter(buttonType => !['submit', 'button'].includes(buttonType)))
	('does not render attribute [value] if value is set and type is set to "%s"', async type => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button', {
			props: {
				type,
				value: 'The string formerly known as Prince.'
			}
		}));

		await expect(page).not.toMatchElement('[value="The string formerly known as Prince."]');
	});
});

