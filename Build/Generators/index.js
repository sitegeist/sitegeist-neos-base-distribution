module.exports = plop => {
    plop.addHelper('phpNamespace', s => s.replace(/\./g, '\\'));

    require('./fusion-component')(plop);
    require('./eel-helper')(plop);
};