module.exports = plop => {
    plop.addHelper('cwd', () => process.cwd());
};