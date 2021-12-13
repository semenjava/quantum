<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        'app',
        'database',
        'Modules',
        'routes',
    ]);

$config = new PhpCsFixer\Config();

return $config
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache')
    ->setFinder($finder);
