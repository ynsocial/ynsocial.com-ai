<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CKFinder config
    |--------------------------------------------------------------------------
    |
    */

    'loadRoutes' => false,
    'licenseName' => 'CMS',
    'licenseKey' => '*F?H-*1**-A**B-*B**-*J**-E*M*-3**M',

    'privateDir' => [
        'backend' => 'laravel_cache',
        'tags' => 'ckfinder/tags',
        'cache' => 'ckfinder/cache',
        'thumbs' => 'ckfinder/cache/thumbs',
        'logs' => [
            'backend' => 'laravel_logs',
            'path' => 'ckfinder/logs'
        ]
    ],

    'images' => [
        'maxWidth' => 1920,
        'maxHeight' => 1080,
        'quality' => 90,
        'sizes' => [
            'small' => ['width' => 480, 'height' => 320, 'quality' => 80],
            'medium' => ['width' => 600, 'height' => 480, 'quality' => 80],
            'large' => ['width' => 800, 'height' => 600, 'quality' => 80]
        ]
    ],

    'backends' => [
        'laravel_cache' => [
            'name' => 'laravel_cache',
            'adapter' => 'local',
            'root' => storage_path('framework/cache')
        ],
        'laravel_logs' => [
            'name' => 'laravel_logs',
            'adapter' => 'local',
            'root' => storage_path('logs')
        ],
        'default' => [
            'name' => 'default',
            'adapter' => 'local',
            'baseUrl' => env('APP_URL') . '/',
            'root' => storage_path('app/public'),
            'chmodFiles' => 0777,
            'chmodFolders' => 0755,
            'filesystemEncoding' => 'UTF-8'
        ]
    ],

    'resourceTypes' => [
        [
            'name' => 'Dosyalar',
            'directory' => 'files',
            'maxSize' => '50M',
            'allowedExtensions' => '7z,aiff,asf,avi,bmp,csv,doc,docx,fla,flv,gif,gz,gzip,jpeg,jpg,mid,mov,mp3,mp4,mpc,mpeg,mpg,ods,odt,pdf,png,ppt,pptx,pxd,qt,ram,rar,rm,rmi,rmvb,rtf,sdc,sitd,swf,sxc,sxw,tar,tgz,tif,tiff,txt,vsd,wav,wma,wmv,xls,xlsx,zip,xml',
            'deniedExtensions' => '',
            'backend' => 'default'
        ],
        [
            'name' => 'Resimler',
            'directory' => 'images',
            'maxSize' => '10M',
            'allowedExtensions' => 'jpeg,jpg,png,webp,svg',
            'deniedExtensions' => '',
            'backend' => 'default'
        ]
    ],

    'accessControl' => [
        [
            'role' => '*',
            'resourceType' => '*',
            'folder' => '/',

            'FOLDER_VIEW' => true,
            'FOLDER_CREATE' => true,
            'FOLDER_RENAME' => true,
            'FOLDER_DELETE' => true,

            'FILE_VIEW' => true,
            'FILE_UPLOAD' => true,
            'FILE_RENAME' => true,
            'FILE_DELETE' => true,

            'IMAGE_RESIZE' => true,
            'IMAGE_RESIZE_CUSTOM' => true
        ]
    ],

    'defaultResourceTypes' => '',
    'roleSessionVar' => 'CKFinder_UserRole',
    'overwriteOnUpload' => false,
    'checkDoubleExtension' => true,
    'disallowUnsafeCharacters' => true,
    'secureImageUploads' => true,
    'checkSizeAfterScaling' => true,
    'forceAscii' => true,
    'xSendfile' => false,
    'debug' => false,
    'pluginsDirectory' => app_path('Plugins/CKFinder'),
    'plugins' => ['Rename', 'ConvertWebP', 'RemoveResized'],
    'tempDirectory' => sys_get_temp_dir(),
    'sessionWriteClose' => true,
    'csrfProtection' => true,
    'htmlExtensions' => ['html', 'htm', 'xml', 'js'],
    'hideFolders' => ['.*', 'CVS', '__thumbs'],
    'hideFiles' => ['.*'],

    'cache' => [
        'imagePreview' => 24 * 3600,
        'thumbnails' => 24 * 3600 * 365
    ],

];
