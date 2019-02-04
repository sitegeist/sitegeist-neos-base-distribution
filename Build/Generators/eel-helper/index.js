module.exports = plop => plop.setGenerator('eel-helper', {
    description: 'Generate an Eel Helper',
    prompts: [{
        type: 'rawlist',
        name: 'packageKey',
        message: 'In which package?',
        choices: require('../packages')
    }, {
        type: 'input',
        message: 'Enter the helper name:',
        name: 'name'
    }],
    actions: [{
        type: 'add',
        path: '../../DistributionPackages/{{packageKey}}/Classes/Eel/Helper/{{name}}Helper.php',
        templateFile: `${__dirname}/helper.php.hbs`
    },  data => `
        Do not forget to register the Eel Helper in your Config, e.g.:

        (${data.packageKey}/Configuration/Settings.yaml)

            Neos:
              Fusion:
                defaultContext:
                   '${data.packageKey}.${data.name}': '${data.packageKey.replace(/\./g, '\\')}\\Eel\\Helper\\${data.name}'
    `]
});