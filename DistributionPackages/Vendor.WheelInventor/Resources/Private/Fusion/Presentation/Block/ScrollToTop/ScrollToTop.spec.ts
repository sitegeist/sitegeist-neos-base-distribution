describe('ScrollToTop', () => {
	it('has a title', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.ScrollToTop', {
			props: {
				id: 'scroll-to-top',
				title: 'Scroll to the top and never back!'
			}
		}));

		await expect(page).toMatchElement('#scroll-to-top[title]');
	});

	it('initially is not visible', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.ScrollToTop', {
			props: {
				id: 'scroll-to-top'
			}
		}));

		await expect(page).not.toContainVisibleElement('#scroll-to-top');
	});

	it('is visible after scrolling vertically', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.ScrollToTop', {
			props: {
				id: 'scroll-to-top'
			}
		}));

		await page.evaluate(() => {
			window.scroll({top: 1});
		});

		await page.waitForTimeout(300);

		await expect(page).toContainVisibleElement('#scroll-to-top');
	});

	it('scrolls back to the document top on click', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.ScrollToTop', {
			props: {
				id: 'scroll-to-top'
			}
		}));

		await page.evaluate(() => {
			window.scroll({top: 100});
		});

		await page.waitForTimeout(300);

		await page.click('#scroll-to-top');

		await page.waitForTimeout(800);

		await expect(page.evaluate(() => window.scrollY)).resolves.toBe(0);
	});

	it('is not visible after scrolling back to the document top via click', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.ScrollToTop', {
			props: {
				id: 'scroll-to-top'
			}
		}));

		await page.evaluate(() => {
			window.scroll({top: 100});
		});

		await page.waitForTimeout(300);

		await page.click('#scroll-to-top');

		await page.waitForTimeout(800);

		await expect(page).not.toContainVisibleElement('#scroll-to-top');
	});

	it('is not visible after scrolling back to the document top manually', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.ScrollToTop', {
			props: {
				id: 'scroll-to-top'
			}
		}));

		await page.evaluate(() => {
			window.scroll({top: 100});
		});

		await page.waitForTimeout(300);

		await page.evaluate(() => {
			window.scroll({top: 0});
		});

		await page.waitForTimeout(300);

		await expect(page).not.toContainVisibleElement('#scroll-to-top');
	});

	it('is visible after loading document with scroll-y higher than 0', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.ScrollToTop', {
			props: {
				id: 'scroll-to-top'
			}
		}));

		await page.evaluate(() => {
			window.scroll({top: 300});
		});

		await page.reload();

		await page.waitForTimeout(300);

		await expect(page).toContainVisibleElement('#scroll-to-top');
	});
});
