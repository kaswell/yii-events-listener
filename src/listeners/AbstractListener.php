<?php

namespace kaswell\events\listener\listeners;

use yii\base\Event;

abstract class AbstractListener implements EventListenerInterface
{
    abstract public function handle(Event $event): void;
}