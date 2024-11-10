<?php
use Symplify\EasyCodingStandard\Config\ECSConfig;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use Symplify\EasyCodingStandard\ValueObject\Option;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
         __DIR__ . '/tests',
         __DIR__ . '/config',
    ])
    ->withRules([
        ArraySyntaxFixer::class,
        NoUnusedImportsFixer::class
    ])
    ->withSpacing(indentation: Option::INDENTATION_SPACES, lineEnding: PHP_EOL)
    ->withPhpCsFixerSets(perCS20: true, doctrineAnnotation: true)
    ->withPreparedSets(psr12: true);
