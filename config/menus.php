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
                'pathUrl' => ['/','dashboard']
            ],
            [
                'header' => 'Aktifitas Saya',
            ],
            [
                'title' => 'Formulir',
                'icon' => 'ki-filled ki-badge',
                'permission' => null,
                'route' => null,
                'pathUrl' => [
                                'my-activity/my-leave-confirm/*','my-activity/my-permit-confirm/*','my-activity/my-leave','my-activity/my-leave/*','my-activity/my-permit','my-activity/my-permit/*',
                                'my-activity/my-overtime*','my-activity/my-business-trip','my-activity/my-business-trip/*','my-activity/my-business-trip-confirm/*'
                            ],
                'children' => [
                    [
                        'title' => 'Persetujuan',
                        'icon' => 'ki-filled ki-information-4',
                        'permission' => ['approve-leave-coworker','approve-permit-coworker'],
                        'route' => null,
                        'pathUrl' => ['my-activity/my-leave-confirm/*','my-activity/my-permit-confirm/*','my-activity/my-overtime-confirm/*','my-activity/my-business-trip-confirm/*'],
                        'children' => [
                            [
                                'title' => 'Persetujuan Cuti',
                                'route' => 'my-activity.my-leave-confirm.confirm-leave-index',
                                'permission' => ['approve-leave-coworker'],
                                'pathUrl' => ['my-activity/my-leave-confirm/*'],
                            ],
                            [
                                'title' => 'Persetujuan Izin',
                                'route' => 'my-activity.my-permit-confirm.confirm-permit-index',
                                'permission' => ['approve-permit-coworker'],
                                'pathUrl' => ['my-activity/my-permit-confirm/*'],
                            ],
                            [
                                'title' => 'Persetujuan Lembur',
                                'route' => 'my-activity.my-overtime-confirm.confirm-overtime-index',
                                'permission' => ['approve-overtime-coworker'],
                                'pathUrl' => ['my-activity/my-overtime-confirm/*'],
                            ],
                            [
                                'title' => 'Persetujuan Perjalan Dinas',
                                'route' => 'my-activity.my-business-trip-confirm.confirm-business-trip-index',
                                'permission' => ['approve-business-trip-coworker'],
                                'pathUrl' => ['my-activity/my-business-trip-confirm/*'],
                            ],

                        ],
                    ],
                    [
                        'title' => 'Cuti',
                        'route' => 'my-activity.my-leave.index',
                        'permission' => null,
                        'pathUrl' => ['my-activity/my-leave','my-activity/my-leave/*'],
                    ],
                    [
                        'title' => 'Izin',
                        'route' => 'my-activity.my-permit.index',
                        'permission' => null,
                        'pathUrl' => ['my-activity/my-permit','my-activity/my-permit/*'],
                    ],
                    // [
                    //     'title' => 'Kasbon',
                    //     'route' => 'index',
                    //     'permission' => null,
                    //     'pathUrl' => ['my-activity/my-cash-receipt*'],
                    // ],
                    [
                        'title' => 'Lembur',
                        'route' => 'my-activity.my-overtime.index',
                        'permission' => null,
                        'pathUrl' => ['my-activity/my-overtime','my-activity/my-overtime/*'],
                    ],
                    [
                        'title' => 'Perjalan Dinas',
                        'route' => 'my-activity.my-business-trip.index',
                        'permission' => null,
                        'pathUrl' => ['my-activity/my-business-trip','my-activity/my-business-trip/*'],
                    ],

                ],
            ],
            [
                'title' => 'Kehadiran',
                'icon' => 'ki-filled ki-calendar-tick',
                'permission' => null,
                'route' => 'my-activity.my-attendance.index',
                'pathUrl' => ['my-activity/my-attendance*']
            ],
            [
                'header' => 'Ketenagakerjaan',
            ],
            [
                'title' => 'Tenaga Kerja',
                'icon' => 'ki-filled ki-user',
                'permission' => [
                                    'employee-read','workforce-leave-read','workforce-business-trip-read','workforce-permit-read','workforce-cash-receipt-read','workforce-overtimes-read',
                                    'workforce-payroll-read','workforce-loan-read'
                                ],
                'route' => null,
                'pathUrl' => ['workforce/employee*','workforce/submitted-form*'],
                'children' => [
                    [
                        'title' => 'Formulir',
                        'route' => null,
                        'permission' => ['workforce-leave-read','workforce-business-trip-read','workforce-permit-read','workforce-cash-receipt-read','workforce-overtime-read'],
                        'pathUrl' => ['workforce/submitted-form*'],
                        'children' => [
                            [
                                'title' => 'Cuti',
                                'route' => 'workforce.submitted-form.leave.index',
                                'permission' => ['workforce-leave-read'],
                                'pathUrl' => ['workforce/submitted-form/leave*'],
                            ],

                            [
                                'title' => 'Izin',
                                'route' => 'workforce.submitted-form.permit.index',
                                'permission' => ['workforce-permit-read'],
                                'pathUrl' => ['workforce/submitted-form/permit*'],
                            ],
                            // [
                            //     'title' => 'Kasbon',
                            //     'route' => 'index',
                            //     'permission' => ['workforce-cash-receipt-read'],
                            //     'pathUrl' => ['workforce/submitted-form/cash-receipt*'],
                            // ],
                            [
                                'title' => 'Lembur',
                                'route' => 'workforce.submitted-form.overtime.index',
                                'permission' => ['workforce-overtime-read'],
                                'pathUrl' => ['workforce/submitted-form/overtime*'],
                            ],
                            [
                                'title' => 'Perjalanan Dinas',
                                'route' => 'workforce.submitted-form.business-trip.index',
                                'permission' => ['workforce-business-trip-read'],
                                'pathUrl' => ['workforce/submitted-form/business-trip*'],
                            ],
                        ],
                    ],
                    [
                        'title' => 'Gaji',
                        'route' => null,
                        'permission' => ['workforce-payroll-read'],
                        'pathUrl' => ['workforce/employee-payroll*','workforce/employee-role-remuneration-package*'],
                        'children' => [
                            [
                                'title' => 'Payroll',
                                'route' => 'workforce.employee-payroll.index',
                                'permission' => ['workforce-payroll-read'],
                                'pathUrl' => ['workforce/employee-payroll','workforce/employee-payroll/*'],
                            ],
                            [
                                'title' => 'Compensation Benefits',
                                'route' => 'workforce.employee-payroll-comben.index',
                                'permission' => ['workforce-payroll-read'],
                                'pathUrl' => ['workforce/employee-payroll-comben*'],
                            ],
                            [
                                'title' => 'Deduction',
                                'route' => 'workforce.employee-payroll-deduction.index',
                                'permission' => ['workforce-payroll-read'],
                                'pathUrl' => ['workforce/employee-payroll-deduction*'],
                            ],
                            [
                                'title' => 'Kelola Paket Remunerasi',
                                'route' => 'workforce.employee-role-remuneration-package.index',
                                'permission' => ['workforce-payroll-read'],
                                'pathUrl' => ['workforce/employee-role-remuneration-package*'],
                            ],
                        ],
                    ],
                    [
                        'title' => 'Karyawan',
                        'route' => 'workforce.employee.index',
                        'permission' => ['employee-read'],
                        'pathUrl' => ['workforce/employee','workforce/employee/*'],
                    ],
                    [
                        'title' => 'Pinjaman',
                        'route' => 'workforce.employee-loan.index',
                        'permission' => ['workforce-loan-read'],
                        'pathUrl' => ['workforce/employee-loan*'],
                    ],
                ],

            ],
            [
                'title' => 'Jadwal Kerja',
                'icon' => 'ki-filled ki-time',
                'permission' => ['work-schedule-shift-read','work-schedule-holiday-read'],
                'route' => null,
                'pathUrl' => ['work-schedule/shift*','work-schedule/holiday*'],
                'children' => [
                    [
                        'title' => 'Hari Libur',
                        'route' => 'work-schedule.holiday.index',
                        'permission' => ['work-schedule-holiday-read'],
                        'pathUrl' => ['work-schedule/holiday*'],
                    ],
                    [
                        'title' => 'Kelola Shift',
                        'route' => null,
                        'permission' => ['work-schedule-shift-read'],
                        'pathUrl' => ['work-schedule/shift','work-schedule/shift/*','work-schedule/shift-fixed*','work-schedule/shift-rotating*'],
                        'children' => [
                            [
                                'title' => 'Shift',
                                'route' => 'work-schedule.shift.index',
                                'permission' => ['work-schedule-shift-read'],
                                'pathUrl' => ['work-schedule/shift','work-schedule/shift/*'],
                            ],
                            [
                                'title' => 'Shift Tetap',
                                'route' => 'work-schedule.shift-fixed.index',
                                'permission' => ['work-schedule-shift-read'],
                                'pathUrl' => ['work-schedule/shift-fixed*'],
                            ],
                            [
                                'title' => 'Shift Bergilir',
                                'route' => 'work-schedule.shift-rotating.index',
                                'permission' => ['work-schedule-shift-read'],
                                'pathUrl' => ['work-schedule/shift-rotating*'],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'header' => 'Laporan',
            ],
            [
                'title' => 'Laporan Karyawan',
                'icon' => 'ki-filled ki-document',
                'permission' => ['report-employee-attendance','report-employee-shift'],
                'route' => null,
                'pathUrl' => ['report/employee/attendance*','report/employee/shift*'],
                'children' => [
                    [
                        'title' => 'Kehadiran',
                        'route' => 'report.employee.attendance',
                        'permission' => ['report-employee-attendance'],
                        'pathUrl' => ['report/employee/attendance*'],
                    ],

                    [
                        'title' => 'Shift',
                        'route' => 'report.employee.shift',
                        'permission' => ['report-employee-shift'],
                        'pathUrl' => ['report/employee/shift*'],
                    ]
                ]
                    ],
            [
                'header' => 'Konfigurasi',
            ],
            [
                'title' => 'Perusahaan',
                'icon' => 'ki-filled ki-bank',
                'permission' => ['entity-read', 'company-read', 'division-read', 'department-read', 'role-read', 'permission-read', 'permission-group-read'],
                'route' => null,
                'pathUrl' => ['entity*', 'company*', 'division*', 'departement*', 'roles*', 'company*', 'permission*'],
                'children' => [
                    [
                        'title' => 'Entitas',
                        'route' => 'entity.index',
                        'permission' => ['entity-read'],
                        'pathUrl' => ['entity*'],
                    ],
                    [
                        'title' => 'Lokasi Kantor',
                        'route' => 'company.index',
                        'permission' => ['company-read'],
                        'pathUrl' => ['company*'],
                    ],
                    [
                        'title' => 'Divisi',
                        'route' => 'division.index',
                        'permission' => ['division-read'],
                        'pathUrl' => ['division*'],
                    ],
                    [
                        'title' => 'Departemen',
                        'route' => 'departement.index',
                        'permission' => ['department-read'],
                        'pathUrl' => ['departement*'],
                    ],
                    [
                        'title' => 'Jabatan',
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
