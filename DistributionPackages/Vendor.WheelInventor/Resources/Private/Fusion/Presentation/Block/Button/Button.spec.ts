describe('Button', () => {
	it('exists', async () => {
		await page.goto(createFusionComponentUri('Vendor.WheelInventor:Block.Button'));

		expect(await page.$eval('body', body => body.innerHTML)).toContain('<button>');
	});
});
