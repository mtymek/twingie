<?php

namespace Twingie\Event;

use Zend\EventManager\EventInterface as BaseEventInterface;

interface EventInterface extends BaseEventInterface
{

    const EVENT_START = 'start';
    const EVENT_ROUTE = 'route';
    const EVENT_FINISH = 'finish';

}