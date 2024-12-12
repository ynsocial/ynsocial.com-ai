<?php

/**
 * Admin Modules
 */
return [


    'dashboard' => [
        'name'      => 'dashboard',
        'title'     => 'admin/menu.dashboard',
        'icon'      => 'admin.svgs.dashboard',
        'status'    => true,
    ],

    'contents' => [
        'title'     => 'admin/menu.contents',
        'icon'      => 'admin.svgs.contents',
        'status'    => true,
        'subs'      => [

            'pages' => [
                'name'      => 'pages',
                'title'     => 'admin/menu.pages',
                'status'    => true,
                'alias'     => true
            ],

            'posts' => [
                'name'      => 'posts',
                'title'     => 'admin/menu.posts',
                'status'    => true,
                'alias'     => true
            ],

            'widgets' => [
                'name'      => 'widgets',
                'title'     => 'admin/menu.widgets',
                'status'    => true,
            ]
        ]
    ],

    'structures' => [
        'title'     => 'admin/menu.structures',
        'icon'      => 'admin.svgs.structures',
        'status'    => true,
        'subs'      => [

            'categories' => [
                'name'      => 'categories',
                'title'     => 'admin/menu.categories',
                'status'    => true,
                'alias'     => true
            ],

            'content_types' => [
                'name'      => 'content_types',
                'title'     => 'admin/menu.content_types',
                'status'    => true,
                'alias'     => true
            ]
        ]
    ],

    'files' => [
        'name'      => 'files',
        'title'     => 'admin/menu.files',
        'icon'      => 'admin.svgs.files',
        'status'    => true,
    ],

    'messages' => [
        'title'     => 'admin/menu.messages',
        'icon'      => 'admin.svgs.messages',
        'status'    => true,
        'subs'      => [

            'envelopes' => [
                'name'      => 'envelopes',
                'title'     => 'admin/menu.envelopes',
                'status'    => true,
                'alias'     => true
            ],

            'newsletters' => [
                'name'      => 'newsletters',
                'title'     => 'admin/menu.newsletters',
                'status'    => true,
                'alias'     => true
            ]
        ]
    ],

    'persons' => [
        'title'     => 'admin/menu.persons',
        'icon'      => 'admin.svgs.persons',
        'status'    => true,
        'subs'      => [

            'customers' => [
                'name'      => 'customers',
                'title'     => 'admin/menu.customers',
                'status'    => true,
                'alias'     => true
            ],

            'users' => [
                'name'      => 'users',
                'title'     => 'admin/menu.users',
                'status'    => true,
                'alias'     => true
            ],

            'permissions' => [
                'name'      => 'permissions',
                'title'     => 'admin/menu.permissions',
                'status'    => true,
                'alias'     => true
            ]

        ]
    ],

    'tools' => [
        'title'     => 'admin/menu.tools',
        'icon'      => 'admin.svgs.tools',
        'status'    => true,
        'subs'      => [

            'redirections' => [
                'name'      => 'redirections',
                'title'     => 'admin/menu.redirections',
                'status'    => true,
            ],

            'gones' => [
                'name'      => 'gones',
                'title'     => 'admin/menu.gones',
                'status'    => true,
            ],

            'failures' => [
                'name'      => 'failures',
                'title'     => 'admin/menu.failures',
                'status'    => true,
            ],

            'slugs' => [
                'name'      => 'slugs',
                'title'     => 'admin/menu.slugs',
                'status'    => true,
            ],

            'keywords' => [
                'name'      => 'keywords',
                'title'     => 'admin/menu.keywords',
                'status'    => true,
            ],

            'extras' => [
                'name'      => 'extras',
                'title'     => 'admin/menu.extras',
                'status'    => true,
            ]

        ]
    ],

    'settings' => [
        'title'     => 'admin/menu.settings',
        'icon'      => 'admin.svgs.settings',
        'status'    => true,
        'subs'      => [

            'brands' => [
                'name'      => 'brands',
                'title'     => 'admin/menu.brands',
                'status'    => true,
            ],

            'infos' => [
                'name'      => 'infos',
                'title'     => 'admin/menu.infos',
                'status'    => true,
            ],

            'links' => [
                'name'      => 'links',
                'title'     => 'admin/menu.links',
                'status'    => true,
            ],

            'seo' => [
                'name'      => 'seo',
                'title'     => 'admin/menu.seo',
                'status'    => true,
            ],

            'mods' => [
                'name'      => 'mods',
                'title'     => 'admin/menu.mods',
                'status'    => true,
            ]

        ]
    ],

];
