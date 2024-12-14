<?php

namespace CKSource\CKFinder\Plugin\ConvertWebP;

use CKSource\CKFinder\CKFinder;
use CKSource\CKFinder\Event\CKFinderEvent;
use CKSource\CKFinder\Plugin\PluginInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ConvertWebP implements PluginInterface, EventSubscriberInterface
{
    protected $app;

    public function setContainer(CKFinder $app)
    {
        $this->app = $app;
    }

    public function getDefaultConfig(): array
    {
        return [
            'convertable' => ['jpg', 'jpeg', 'png']
        ];
    }

    public function convertToWebP()
    {
        if (!env('IMAGE_WEBP') or $this->app['working_folder']->getResourceType()->getDirectory() !== 'images') {
            return false;
        }

        foreach ($this->app['working_folder']->listFiles() as $file) {
            if (in_array($file['extension'], $this->app['config']->get('ConvertWebP.convertable'))) {
                $originalFile = Storage::disk(config('constants.files.disk'))->path($file['path']);

                $convert = Image::make($originalFile)->encode('webp', env('IMAGE_QUALITY'))->save(str_replace(".{$file['extension']}", '.webp', $originalFile));

                if ($convert) {
                    File::delete($originalFile);
                }
            }
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CKFinderEvent::AFTER_COMMAND_FILE_UPLOAD => 'convertToWebP'
        ];
    }
}