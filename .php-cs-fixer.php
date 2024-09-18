<?php

$finder = (new PhpCsFixer\Finder())
    ->in(['src', 'public'])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder)
    ;