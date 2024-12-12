<?php

namespace CKSource\CKFinder\Plugin\Rename;

use CKSource\CKFinder\CKFinder;
use CKSource\CKFinder\Event\BeforeCommandEvent;
use CKSource\CKFinder\Event\CKFinderEvent;
use CKSource\CKFinder\Event\RenameFolderEvent;
use CKSource\CKFinder\Exception\AlreadyExistsException;
use CKSource\CKFinder\Plugin\PluginInterface;
use Illuminate\Support\Str;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Rename implements PluginInterface, EventSubscriberInterface
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

    public function beforeUpload(BeforeCommandEvent $event)
    {
        $request = $event->getRequest();
        $uploadedFile = $request->files->get('upload');
        $workingFolder = $this->app['working_folder'];

        if ($uploadedFile) {
            $uploadedFilename = $uploadedFile->getClientOriginalName();
            $filename = Str::of(pathinfo($uploadedFilename, PATHINFO_FILENAME))->slug();
            $extension = pathinfo($uploadedFilename, PATHINFO_EXTENSION);

            $i = 0;
            while (true) {
                $uploadedFilename = $filename;

                if ($i > 0) {
                    $uploadedFilename = $filename . "-$i";
                }

                if (env('IMAGE_WEBP') and in_array($extension, $this->app['config']->get('ConvertWebP.convertable'))) {

                    if (!$workingFolder->containsFile($uploadedFilename . '.webp')) {
                        break;
                    }

                } else if (!$workingFolder->containsFile($uploadedFilename . $extension)) {
                    break;
                }

                $i++;
            }

            $setOriginalName = function (UploadedFile $file, $newFileName) {
                $file->originalName = $newFileName;
            };

            $setOriginalName = \Closure::bind($setOriginalName, null, $uploadedFile);

            $setOriginalName($uploadedFile, $uploadedFilename . ".$extension");
        }
    }

    /**
     * @throws AlreadyExistsException
     */
    public function beforeRenameFile(BeforeCommandEvent $event)
    {
        $request = $event->getRequest()->query;
        $workingFolder = $this->app['working_folder'];

        $filename = Str::of(pathinfo($request->get('newFileName'), PATHINFO_FILENAME))->slug();
        $extension = pathinfo($request->get('newFileName'), PATHINFO_EXTENSION);

        if ($workingFolder->containsFile("{$filename}.{$extension}")) {
            throw new AlreadyExistsException('File already exists');
        }

        $request->set('newFileName', "{$filename}.{$extension}");
    }

    public function onRenameFolder(RenameFolderEvent $renameFolderEvent)
    {
        $renameFolderEvent->setNewFolderName(Str::of($renameFolderEvent->getNewFolderName())->slug());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CKFinderEvent::BEFORE_COMMAND_FILE_UPLOAD => 'beforeUpload',
            CKFinderEvent::BEFORE_COMMAND_RENAME_FILE => 'beforeRenameFile',
            CKFinderEvent::RENAME_FOLDER => 'onRenameFolder',
        ];
    }
}