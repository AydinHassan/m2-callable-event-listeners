<h1 align="center">Magento 2 Callable Event Listeners</h1>

<p align="center">Allow to register event listeners with a plain PHP callable - minus the config.</p>


## Installation

```sh
$ composer require trash-panda/m2-callable-event-listeners
$ php bin/magento setup:upgrade
```

## Usage

Grab an instance of `\TrashPanda\CallableEventListeners\Model\Manager` either via DI or from the object manager:

```php

use TrashPanda\CallableEventListeners\Model\Manager;
use Magento\Framework\Event\Observer;

class MyCommand
{
    public function ___construct(Manager $manager)
    {
        $manager->listen('some-event', function (Observer $observer) {
            echo "Hey!\n\n";
            var_dump($observer->getData());
        });
    }
}
```

Now when the event `some-event` is dispatched from `\Magento\Framework\Event\Manager` your callable will be invoked
along with any other listeners attached via config.

## Use Cases

 * Scoping events to one particular code path - eg a command or a cron
 * Prototyping
 * Improved feedback from IDE - regarding classes and method existence

