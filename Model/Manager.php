<?php

namespace TrashPanda\CallableEventListeners\Model;

use Magento\Framework\Event;
use Magento\Framework\Event\Observer;

/**
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class Manager
{
    /**
     * @var array
     */
    private $listeners = [];

    /**
     * @param string $eventName
     * @param callable $callback
     * @return void
     */
    public function listen(string $eventName, callable $callback)
    {
        if (!isset($this->listeners[$eventName])) {
            $this->listeners[$eventName] = [];
        }

        $this->listeners[$eventName][] = $callback;
    }

    /**
     * @param string $eventName
     * @param array $data
     * @return void
     */
    public function dispatch(string $eventName, array $data = [])
    {
        if (!isset($this->listeners[$eventName])) {
            return;
        }

        $event = new Event($data);
        $event->setName($eventName);

        $wrapper = new Observer;
        $wrapper->setData(array_merge(['event' => $event], $data));

        foreach ($this->listeners[$eventName] as $listener) {
            $listener($wrapper);
        }
    }
}
