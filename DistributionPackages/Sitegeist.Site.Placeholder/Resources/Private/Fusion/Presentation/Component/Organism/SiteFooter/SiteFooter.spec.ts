import shell from "shelljs";

const COMPONENT = `Sitegeist.Site.Placeholder:Component.Organism.SiteFooter`;
const RENDER = `./flow styleguide:render ${COMPONENT}`;

describe(COMPONENT, () => {
	describe(`Semantics`, () => {
		it(`must be a <footer>. #semantics`, () => {
			document.body.innerHTML = shell.exec(RENDER).stdout;

			expect(document.body.firstChild).not.toBeNull();

			if (document.body.firstChild !== null) {
				expect(document.body.firstChild.nodeName).toBe('FOOTER');
			}
		});
	});
});
