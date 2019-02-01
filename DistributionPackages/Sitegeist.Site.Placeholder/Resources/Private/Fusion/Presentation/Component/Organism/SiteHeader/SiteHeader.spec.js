import shell from 'shelljs';

const COMPONENT = `Sitegeist.Site.Placeholder:Component.Organism.SiteHeader`;
const RENDER = `./flow styleguide:render ${COMPONENT}`;

describe(COMPONENT, () => {
	describe(`Semantics`, () => {
		it(`must be a <header>. #semantics`, () => {
			document.body.innerHTML = shell.exec(RENDER);

			expect(document.body.firstChild.nodeName).toBe('HEADER');
		});
	});
});
