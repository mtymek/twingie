<?php

namespace Twingie;


use Twingie\Router\Route\Route;

class Application
{

    /**
     * @var array
     */
    protected $commands = array();

    /**
     * @param $command
     * @param $controller
     */
    public function addCommand($command, $controller)
    {
        $route = new Route($command, array(), array(
            'controller' => $controller
        ));
        $this->commands[] = array(
            'route' => $route,
            'controller' => $controller,
        );
    }

    public function dispatch($argv)
    {
        foreach ($this->commands as $command) {
            if ($match = $command['route']->match($argv)) {
                $command['controller']();
            }
        }
    }

    /**
     * Run application
     */
    public function run()
    {
        global $argv;
        $argvCopy = $argv;
        array_shift($argvCopy);
        $this->dispatch($argvCopy);
    }

}
