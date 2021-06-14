describe('Page', () => {
	it('has a header', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Layout.Page', {
		}));

		await expect(page).toMatchElement('header');
	});

	it('has a main container', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Layout.Page', {
		}));

		await expect(page).toMatchElement('main');
	});

	it('has a footer', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Layout.Page', {
		}));

		await expect(page).toMatchElement('footer');
	});
});
