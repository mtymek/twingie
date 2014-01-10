<?php

include __DIR__ . '/vendor/autoload.php';
print_r($argv);
$app = new Twingie\Application();
$app->addCommand(
    "run",
    function () {
        echo "command output!\n";
    }
);

$app->run();
