<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

declare(strict_types=1);

namespace Vinkla\Tests\Hashids;

use GrahamCampbell\Analyzer\AnalysisTrait;
use Laravel\Lumen\Application;
use PHPUnit\Framework\TestCase;

class AnalysisTest extends TestCase
{
    use AnalysisTrait;

    protected function getPaths()
    {
        return [
            realpath(__DIR__ . '/../config'),
            realpath(__DIR__ . '/../src'),
            realpath(__DIR__),
        ];
    }

    protected function getIgnored()
    {
        return [Application::class];
    }
}
