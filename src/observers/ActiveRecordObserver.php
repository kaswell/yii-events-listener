<?php

namespace kaswell\events\listener\observers;

use yii\base\Event;
use yii\base\ModelEvent;
use yii\db\ActiveRecord;
use yii\db\AfterSaveEvent;

class ActiveRecordObserver extends AbstractObserver
{
    protected $method;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'found',
            ActiveRecord::EVENT_AFTER_INSERT => 'inserted',
            ActiveRecord::EVENT_AFTER_UPDATE => 'updated',
            ActiveRecord::EVENT_AFTER_VALIDATE => 'validated',
            ActiveRecord::EVENT_AFTER_REFRESH => 'refreshed',
            ActiveRecord::EVENT_AFTER_DELETE => 'deleted',
            ActiveRecord::EVENT_BEFORE_INSERT => 'inserting',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'updating',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'validating',
            ActiveRecord::EVENT_BEFORE_DELETE => 'deleting',
            ActiveRecord::EVENT_INIT => 'initialized',
        ];
    }

    public function found(Event $event)
    {
    }

    public function inserted(AfterSaveEvent $event)
    {
    }

    public function updated(AfterSaveEvent $event)
    {
    }

    public function validated(Event $event)
    {
    }

    public function deleted(Event $event)
    {
    }

    public function refreshed(ModelEvent $event)
    {
    }

    public function inserting(ModelEvent $event)
    {
    }

    public function updating(ModelEvent $event)
    {
    }

    public function validating(ModelEvent $event)
    {
    }

    public function deleting(ModelEvent $event)
    {
    }

    public function initialized(Event $event)
    {
    }
}