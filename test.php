<?php

include __DIR__ . '/vendor/autoload.php';

use Twingie\Application as App;

$app = new App();

$app->addCommand("run <number>", function ($e) {
        $command = $e->getParam('command');
        echo "Running $command\n";
});

$app->addCommand("list users [-v|--verbose]", function ($e) {
        echo "Listing all users\n";

        if ($e->getParam('v') || $e->getParam('verbose')) {
            echo "Verbose mode!\n";
        }

});

$app->run();
