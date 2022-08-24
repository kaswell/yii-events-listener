<?php

namespace kaswell\events\listener\listeners;

use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;

class EventListener extends Component implements EventListenerInterface, BootstrapInterface
{
    public $listeners = [];

    public $observers = [];

    public function bootstrap($app)
    {
        $container = \Yii::$container;
        $container->setSingleton(EventListenerInterface::class, $this);
    }

    public function init()
    {
        $this->initListeners();
        $this->initObservers();
    }

    protected function normalizeConfig($array)
    {
        foreach ($array as $key => $value) {
            if (!is_array($value)) {
                $value = [$value];
            }

            $array[$key] = array_combine($value, $value);
        }

        return $array;
    }

    protected function initListeners()
    {
        if (empty($this->listeners)) {
            return;
        }

        foreach ($this->listeners as $watchedName => $listeners) {
            $this->listeners[$watchedName] = $this->normalizeConfig($listeners);
        }

        foreach ($this->listeners as $watchedName => $modelEvents) {
            foreach ($modelEvents as $eventName => $listeners) {
                foreach ($listeners as $listenerClass) {
                    $listener = new $listenerClass();
                    Event::on($watchedName, $eventName, [$listener, 'handle']);

                    $this->listeners[$watchedName][$eventName][$listenerClass] = $listener;
                }
            }
        }
    }

    protected function initObservers()
    {
        if (empty($this->observers)) {
            return;
        }

        $this->observers = $this->normalizeConfig($this->observers);

        foreach ($this->observers as $className => $observers) {
            foreach ($observers as $observerClass) {
                $observer = new $observerClass();
                $events = $observer->events();

                foreach ($events as $eventName => $methodName) {
                    Event::on($className, $eventName, [$observer, $methodName]);
                }

                $this->observers[$className][$observerClass] = $observer;
            }
        }
    }
}