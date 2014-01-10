<?php

namespace Twingie\Router\Route;

use Zend\Console\RouteMatcher\RouteMatcherInterface;

interface RouteInterface
{
    /**
     * @param array $argv
     *
     * @return RouteMatch
     */
    public function match(array $argv);
}
