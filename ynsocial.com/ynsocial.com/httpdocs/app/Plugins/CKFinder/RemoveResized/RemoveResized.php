<?php

namespace CKSource\CKFinder\Plugin\RemoveResized;

use CKSource\CKFinder\CKFinder;
use CKSource\CKFinder\Event\AfterCommandEvent;
use CKSource\CKFinder\Event\CKFinderEvent;
use CKSource\CKFinder\Plugin\PluginInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RemoveResized implements PluginInterface, EventSubscriberInterface
{
    protected $app;

    public function setContainer(CKFinder $app)
    {
        $this->app = $app;
    }

    public function getDefaultConfig(): array
    {
        return [];
    }

    public function afterDeleteFile(AfterCommandEvent $event): void
    {
        if ($this->app['working_folder']->getResourceType()->getDirectory() !== 'images') {
            return;
        }

        foreach ($event->getRequest()->get('files') as $file) {
            removeThumbnails($this->app['working_folder']->getPath() . $file['name']);
        }
    }

    public function afterRenameFile(AfterCommandEvent $event): void
    {
        if ($this->app['working_folder']->getResourceType()->getDirectory() !== 'images') {
            return;
        }

        removeThumbnails($this->app['working_folder']->getPath() . $event->getRequest()->get('fileName'));
    }

    public function afterDeleteFolder(): void
    {
        if ($this->app['working_folder']->getResourceType()->getDirectory() !== 'images') {
            return;
        }

        removeThumbnails($this->app['working_folder']->getPath());
    }

    public function afterRenameFolder(): void
    {
        if ($this->app['working_folder']->getResourceType()->getDirectory() !== 'images') {
            return;
        }

        removeThumbnails($this->app['working_folder']->getPath());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CKFinderEvent::AFTER_COMMAND_DELETE_FILES => 'afterDeleteFile',
            CKFinderEvent::AFTER_COMMAND_RENAME_FILE => 'afterRenameFile',
            CKFinderEvent::AFTER_COMMAND_DELETE_FOLDER => 'afterDeleteFolder',
            CKFinderEvent::AFTER_COMMAND_RENAME_FOLDER => 'afterRenameFolder',
        ];
    }
}