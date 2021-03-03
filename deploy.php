<?php
namespace Deployer;

require 'recipe/flow_framework.php';

// Configuration
ini_set('display_errors', 1);

// Git
set('repository', 'ssh://git@git.example.com/example/project.git');

// SSH
set('ssh_type', 'native');
set('ssh_multiplexing', true);

// composer
set('composer_options', function() {
    switch (input()->getArgument('stage')) {
        case 'develop':
            return '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader';
        default:
            return '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader';
    }
});

// composer
set('branch', function() {
    switch (input()->getArgument('stage')) {
        case 'develop':
            return 'develop';
        case 'staging':
            return 'staging';
        default:
            return 'master';
    }
});

/**
 * Servers
 */
inventory('deploy-hosts.yml');

/**
 * Build frontend
 */
task('deploy:build', function () {
    run('cd {{release_path}} && yarn build', ['timeout' => 60 * 10]);
})->desc('Install and build');

/**
 * Upload to server
 */
task('upload', function () {
    upload(
        __DIR__ . '/.build/current/',
        '{{release_path}}',
        ['options' => ['--exclude node_modules/']]
    );
});

/**
 * Run node repair
 */
task('deploy:node_repair', function () {
    run('FLOW_CONTEXT={{flow_context}} {{bin/php}} {{release_path}}/{{flow_command}} node:repair --only addMissingDefaultValues,createMissingChildNodes,reorderChildNodes');
})->desc('Run node repair');

/**
 * Flow cache flush
 */
task('deploy:flush_caches', function () {
    run('FLOW_CONTEXT={{flow_context}} {{bin/php}} {{release_path}}/{{flow_command}} cache:flush --force');
})->desc('Run node repair');

/**
 * Deploy and build locally
 */
task('build', function () {
    set('deploy_path', __DIR__ . '/.build');
    invoke('deploy:prepare');
    invoke('deploy:release');
    invoke('deploy:update_code');
    invoke('deploy:vendors');
    invoke('deploy:build');
    invoke('deploy:symlink');
    invoke('cleanup');
    invoke('success');
})->local();

/**
 * Release
 */
task('release', [
    'deploy:prepare',
    'deploy:release',
    'upload',
    'deploy:shared',
    'deploy:flush_caches',
    'deploy:run_migrations',
    'deploy:node_repair',
    'deploy:publish_resources',
    'deploy:symlink'
]);

/**
 * Main Task
 */
task('deploy', [
    'build',
    'release',
    'cleanup',
    'success'
]);
