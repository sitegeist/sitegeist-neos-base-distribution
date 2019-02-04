module.exports = plop => {
    plop.addHelper('cwd', () => process.cwd());

    plop.load('./fusion-component');
};