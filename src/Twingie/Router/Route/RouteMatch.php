<?php

namespace Twingie\Router\Route;


use Twingie\Exception\InvalidArgumentException;

class RouteMatch
{

    /**
     * @var array
     */
    protected $params;

    /**
     * Class constructor
     *
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * Return parameter value
     *
     * @param $name
     *
     * @throws \Twingie\Exception\InvalidArgumentException
     * @return mixed
     */
    public function getParam($name)
    {
        if (!array_key_exists($name, $this->params)) {
            throw new InvalidArgumentException("Parameter $name does not exist.");
        }
        return $this->params[$name];
    }
}
