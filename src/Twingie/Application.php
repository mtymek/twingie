<?php

namespace Twingie;


use Twingie\Event\Event;
use Twingie\Router\Route\Route;
use Zend\Console\Console;
use Zend\EventManager\EventManager;

class Application
{

    /**
     * @var array
     */
    protected $commands = array();

    /**
     * @var EventManager
     */
    protected $eventManager;

    /**
     * @var Event
     */
    protected $event;

    /**
     * @var Console
     */
    protected $console;

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
        $eventManager = $this->getEventManager();
        $event = $this->getEvent();
        $eventManager->trigger(Event::EVENT_START, $event);

        // TODO: trigger route event here, find route elsewhere
        foreach ($this->commands as $command) {
            if ($match = $command['route']->match($argv)) {
                $event->setParams($match->getParams());
                $command['controller']($event);
                break;
            }
        }
        $eventManager->trigger(Event::EVENT_FINISH, $event);
    }

    /**
     * Run application
     */
    public function run()
    {
        global $argv;
        $argvCopy = $argv;
        array_shift($argvCopy);

        $this->console = Console::getInstance();
        $this->dispatch($argvCopy);
    }

    /**
     * @param \Zend\EventManager\EventManager $eventManager
     * @return self
     */
    public function setEventManager($eventManager)
    {
        $this->eventManager = $eventManager;
        return $this;
    }

    /**
     * @return \Zend\EventManager\EventManager
     */
    public function getEventManager()
    {
        if (null === $this->eventManager) {
            $this->eventManager = new EventManager();
        }
        return $this->eventManager;
    }

    /**
     * @param \Twingie\Event\Event $event
     *
     * @return self
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return \Twingie\Event\Event
     */
    public function getEvent()
    {
        if (null === $this->event) {
            $this->event = new Event();
            $this->event->setTarget($this);
        }
        return $this->event;
    }

    /**
     * @param \Zend\Console\Console $console
     *
     * @return self
     */
    public function setConsole($console)
    {
        $this->console = $console;
        return $this;
    }

    /**
     * @return \Zend\Console\Console
     */
    public function getConsole()
    {
        return $this->console;
    }
}
