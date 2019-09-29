import shell from "shelljs";

const COMPONENT = `Vendor.Site:Component.Organism.SiteHeader`;
const RENDER = `./flow styleguide:render ${COMPONENT}`;

describe(COMPONENT, () => {
	describe(`Semantics`, () => {
		it(`must be a <header>. #semantics`, () => {
			document.body.innerHTML = shell.exec(RENDER).stdout;

			expect(document.body.firstChild).not.toBeNull();

			if (document.body.firstChild !== null) {
				expect(document.body.firstChild.nodeName).toBe('HEADER');
			}
		});
	});
});
