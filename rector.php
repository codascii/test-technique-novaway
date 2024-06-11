<?php

use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;

return RectorConfig::configure()
    ->withConfiguredRule(AnnotationToAttributeRector::class, [
        new AnnotationToAttribute('Doctrine\ORM\Mapping\Column'),
        new AnnotationToAttribute('Doctrine\ORM\Mapping\Entity'),
        new AnnotationToAttribute('Doctrine\ORM\Mapping\GeneratedValue'),
        new AnnotationToAttribute('Doctrine\ORM\Mapping\Id'),
        new AnnotationToAttribute('Doctrine\ORM\Mapping\ManyToMany'),
        new AnnotationToAttribute('Doctrine\ORM\Mapping\ManyToOne'),
        new AnnotationToAttribute('Doctrine\ORM\Mapping\OneToMany'),
        new AnnotationToAttribute('Doctrine\ORM\Mapping\Table'),
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

