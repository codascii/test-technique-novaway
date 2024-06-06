<?php

use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;

return RectorConfig::configure()
    ->withConfiguredRule(AnnotationToAttributeRector::class, [
        new AnnotationToAttribute('Symfony\Component\Routing\Annotation\Route'),
    ])
    // register single rule
    ->withRules([
    ])
    // here we can define, what prepared sets of rules will be applied
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true
    );

