describe('SiteHeader', () => {
	it('has a logo that links to the homepage', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.SiteHeader', {}));

		await expect(page).toMatchElement('a#logoLink[href="/"] img#logo');
	});

	it('has logo, that links to homepage with target _self', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.SiteHeader', {}));

		await expect(page).toMatchElement('a#logoLink[target="_self"]');
	});

	it('has a logo with title', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.SiteHeader', {
			props: {
				logo: {
					title: 'Homecoming'
				}
			}
		}));

		await expect(page).toMatchElement('img#logo[title="Homecoming"]');
	});

	it('has a logo with alt', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.SiteHeader', {
			props: {
				logo: {
					alt: 'You should see a logo here.'
				}
			}
		}));

		await expect(page).toMatchElement('img#logo[alt="You should see a logo here."]');
	});

	it('uses public svg as src for logo', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.SiteHeader', {}));

		await expect(page).toMatchElement('img#logo[src$="/Vendor.WheelInventor/Images/Logo.svg"]');
	});
});
