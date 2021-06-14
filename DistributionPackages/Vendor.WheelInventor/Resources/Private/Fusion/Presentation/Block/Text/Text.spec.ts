describe('Text', () => {
	const allowedTagNames = ['div', 'article', 'section'];
	const disallowedTagNames = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'a', 'span'];

	it.each(allowedTagNames)('can be rendered as %s', async tagName => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Text', {
			props: {
				as: tagName
			}
		}));

		await expect(page).toMatchElement(tagName);
		await expect(page).not.toMatch('An exception was thrown while Neos tried to render your page');
	});

	it.each(disallowedTagNames)('cannot be rendered as %s', async tagName => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Text', {
			props: {
				as: tagName
			}
		}));

		await expect(page).toMatch(`Got "${tagName}" instead`);
	});

	it('renders as div by default', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Text', {}));

		await expect(page).toMatchElement('div');
		await expect(page).not.toMatch('An exception was thrown while Neos tried to render your page');
	});

	it('renders content', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Text', {
			props: {
				content: '<h1>I also render RTEs.</h1>'
			}
		}));

		await expect(page).toMatch('I also render RTEs.');
		await expect(page).toMatchElement('h1');
	});
});
