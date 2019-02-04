module.exports = plop => plop.setGenerator('fusion-component', {
    description: 'Generate a Fusion Component',
    prompts: [{
        type: 'rawlist',
        name: 'packageKey',
        message: 'In which package?',
        choices: require('../packages')
    }, {
        type: 'rawlist',
        name: 'type',
        message: 'What type of component?',
        choices: ['Atom', 'Molecule', 'Organism', 'Template', 'Base']
    }, {
        type: 'input',
        message: 'Enter the component name:',
        name: 'name'
    }],
    actions: [{
        type: 'add',
        path: '../../DistributionPackages/{{packageKey}}/Resources/Private/Fusion/Presentation/Component/{{type}}/{{name}}/{{name}}.fusion',
        templateFile: `${__dirname}/component.fusion.hbs`
    }]
});