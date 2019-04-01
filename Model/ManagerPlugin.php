<?php

namespace TrashPanda\CallableEventListeners\Model;

use Magento\Framework\Event\ManagerInterface as MagentoEventManager;

/**
 * @author Aydin Hassan <aydin@wearejh.com>
 */
class ManagerPlugin
{
    /**
     * @var Manager
     */
    private $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param MagentoEventManager $manager
     * @param callable $proceed
     * @param array ...$args
     * @return void
     */
    public function aroundDispatch(MagentoEventManager $manager, callable $proceed, ...$args)
    {
        $proceed(...$args);
        $this->manager->dispatch(...$args);
    }
}