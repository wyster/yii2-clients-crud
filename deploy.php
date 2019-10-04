<?php
namespace Deployer;

require 'recipe/yii2-app-basic.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'git@bitbucket.org:wyster/yii2-deltaplan-test.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
set('shared_files', [
    'config/db.php'
]);
add('shared_dirs', [
    'web/uploads'
]);

// Writable dirs by web server
add('writable_dirs', [
    'web/uploads'
]);
set('allow_anonymous_stats', false);

// Hosts
inventory('hosts.yml');
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
