/// <reference path="./node.d.ts" />

import {Selector} from "testcafe";

fixture(`#00000 - Placeholder Test`)
    .page(`http://${process.env.TEST_DOMAIN}/`);

test('Site Header is present', async t => {
    await t
        .expect(Selector('header').innerText).eql('SITE HEADER');
});

test('Site Footer is present', async t => {
    await t
        .expect(Selector('footer').innerText).eql('SITE FOOTER');
});