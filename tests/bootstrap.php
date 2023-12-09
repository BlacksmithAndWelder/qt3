<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../vendor/laravel/framework/src/Illuminate/Foundation/helpers.php';

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

Mockery::getConfiguration()->allowMockingNonExistentMethods(false);

class_alias(MockeryPHPUnitIntegration::class, 'PHPUnit\Framework\TestCase');
