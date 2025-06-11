<?php
// config/menus.php

return


    [
        'main_menu' => [
            [
                'header' => 'Beranda',
            ],
            [
                'title' => 'Dashboard',
                'icon' => 'ki-filled ki-element-11',
                'permission' => null,
                'route' => 'index',
                'pathUrl' => ['/', 'dashboard']
            ],
            // [
            //     'header' => 'Aktifitas Saya',
            // ],
            // [
            //     'title' => 'Kehadiran',
            //     'icon' => 'ki-filled ki-calendar-tick',
            //     'permission' => null,
            //     'route' => 'my-activity.my-attendance.index',
            //     'pathUrl' => ['my-activity/my-attendance*']
            // ],

            [
                'header' => 'Administrator',
            ],

            [
                'title' => 'Roles & Permissions',
                'icon' => 'ki-filled ki-bank',
                'permission' => [ 'role-read', 'permission-read', 'permission-group-read'],
                'route' => null,
                'pathUrl' => [ 'roles*', 'company*', 'permission*'],
                'children' => [

                    [
                        'title' => 'Roles',
                        'route' => 'roles.index',
                        'permission' => ['role-read'],
                        'pathUrl' => ['roles*'],
                    ],
                    [
                        'title' => 'Hak Akses',
                        'route' => null,
                        'permission' => ['permission-read', 'permission-group-read'],
                        'pathUrl' => ['permission*'],
                        'children' => [
                            [
                                'title' => 'Grup Hak Akses',
                                'route' => 'permission-groups.index',
                                'pathUrl' => ['permission-groups*'],
                                'permission' => ['permission-group-read'],
                            ],
                            [
                                'title' => 'Hak Akses',
                                'route' => 'permissions.index',
                                'pathUrl' => ['permissions*'],
                                'permission' => ['permission-read'],
                            ],
                        ],
                    ],
                ],
            ]
        ]
    ];
