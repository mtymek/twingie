<?php

namespace Twingie\Router\Route;

use Zend\Console\RouteMatcher\DefaultRouteMatcher;
use Zend\Console\RouteMatcher\RouteMatcherInterface;

class Route implements RouteInterface
{
    /**
     * @var RouteMatcherInterface
     */
    protected $matcher;

    /**
     * Class constructor
     *
     * @param $route
     * @param array $constraints
     * @param array $defaults
     * @param array $aliases
     * @param array $filters
     * @param array $validators
     */
    public function __construct($route,
        array $constraints = array(),
        array $defaults = array(),
        array $aliases = array(),
        array $filters = null,
        array $validators = null)
    {
        $this->matcher = new DefaultRouteMatcher($route, $constraints, $defaults, $aliases, $filters, $validators);
    }

    /**
     * @param array $argv
     *
     * @return RouteMatch|null
     */
    public function match(array $argv)
    {
        $params = $this->matcher->match($argv);
        if (null === $params) {
            return null;
        }
        return new RouteMatch($params);
    }
}
