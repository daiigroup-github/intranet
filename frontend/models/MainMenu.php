<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\base\View;
use yii\bootstrap;
use frontend\assets\NavPixel;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * ContactForm is the model behind the contact form.
 */
class MainMenu extends Model
{
    public static function mainMenu()
    {
        return [
            [
                'labelIcon' => 'fa-home',
                'label' => 'Home',
                'url' => ['/'],
            ],
            [
                'labelIcon' => 'fa-file-o',
                'label' => 'Document',
                'url' => ['site/index2'],
                'options' => [
                    'class' => 'mm-dropdown mm-dropdown-root'
                ],
                'items' => NavPixel::widget([
                    'options' => [
                        'class' => 'mmc-dropdown-delay animated fadeInLeft',
                    ],
                    'items' => [
                        [
                            'label' => 'Create',
                            'labelIcon' => 'fa-plus-circle',
                            'url'=>['/document']
                        ],
                        [
                            'label' => 'Drafts',
                            'labelIcon' => 'fa-files-o',
                            'url'=>['/document/draft']
                        ],
                        [
                            'label' => 'Inbox',
                            'labelIcon' => 'fa-inbox',
                            'url'=>['/document/inbox']
                        ],
                        [
                            'label' => 'Outbox',
                            'labelIcon' => 'fa-mail-forward',
                            'url'=>['/document/outbox']
                        ],
                        [
                            'label' => 'History',
                            'labelIcon' => 'fa-history',
                            'url'=>['/document/history']
                        ],
                    ],
                ]),
            ],
            //Fit and Fast

            [
                'labelIcon' => 'fa-line-chart',
                'label' => 'Fit and Fast',
                'url' => ['#'],
                'options' => [
                    'class' => 'mm-dropdown mm-dropdown-root'
                ],
                'items' => NavPixel::widget([
                    'options' => [
                        'class' => 'mmc-dropdown-delay animated fadeInLeft',
                    ],
                    'items' => [
                        [
                            'label' => 'Fit and Fast',
                            'labelIcon' => 'fa-plus-circle',
                            'url'=>['/fitandfast']
                        ],
                        [
                            'label' => 'Waiting : Employee',
                            'labelIcon' => 'fa-plus-circle',
                            'url'=>['/fitandfast/approve/employee']
                        ],
                        [
                            'label' => 'Waiting : Manager',
                            'labelIcon' => 'fa-plus-circle',
                            'url'=>['/fitandfast/approve/manager']
                        ],
                        [
                            'label' => 'Manage',
                            'labelIcon' => 'fa-plus-circle',
                            'url'=>['/fitandfast/manage']
                        ],
                        [
                            'label' => 'Report employees',
                            'labelIcon' => 'fa-files-o',
                            'url'=>['/fitandfast/report/employee-all-division']
                        ],
                        [
                            'label' => 'Report managers',
                            'labelIcon' => 'fa-inbox',
                            'url'=>['/fitandfast/report/all-manager']
                        ],
//                        [
//                            'label' => 'Company',
//                            'labelIcon' => 'fa-mail-forward'
//                        ],
//                        [
//                            'label' => 'History',
//                            'labelIcon' => 'fa-history'
//                        ],
                    ],
                ]),
            ],

            //Mileage
            [
                'label' => 'Mileage',
                'labelIcon' => 'fa-dashboard',
                'url' => ['/'],
                'options' => [
                    'class' => 'mm-dropdown mm-dropdown-root'
                ],
                'items' => NavPixel::widget([
                    'options' => [
                        'class' => 'mmc-dropdown-delay animated fadeInLeft',
                    ],
                    'items' => [
                        [
                            'label' => 'Create',
                            'labelIcon' => 'fa-plus-circle'
                        ],
                        [
                            'label' => 'Inbox',
                            'labelIcon' => 'fa-inbox'
                        ],
                        [
                            'label' => 'Outbox',
                            'labelIcon' => 'fa-mail-forward'
                        ],
                    ],
                ]),
            ],

            //Memo
            [
                'label' => 'Memo',
                'labelIcon' => 'fa-paper-plane',
                'url' => ['/'],
                'options' => [
                    'class' => 'mm-dropdown mm-dropdown-root'
                ],
                'items' => NavPixel::widget([
                    'options' => [
                        'class' => 'mmc-dropdown-delay animated fadeInLeft',
                    ],
                    'items' => [
                        [
                            'label' => 'Create',
                            'labelIcon' => 'fa-plus-circle'
                        ],
                        [
                            'label' => 'Inbox',
                            'labelIcon' => 'fa-inbox'
                        ],
                        [
                            'label' => 'Outbox',
                            'labelIcon' => 'fa-mail-forward'
                        ],
                    ],
                ]),
            ],
            [
                'label' => 'Extension',
                'labelIcon' => 'fa-phone',
                'url' => ['/']
            ],

            //employee
            [
                'label' => 'Employees',
                'labelIcon' => 'fa-users',
                'options' => [
                    'class' => 'mm-dropdown mm-dropdown-root'
                ],
                'items' => NavPixel::widget([
                    'options' => [
                        'class' => 'mmc-dropdown-delay animated fadeInLeft',
                    ],
                    'items' => [
                        [
                            'label' => 'Create',
                            'labelIcon' => 'fa-plus-circle',
                            'url'=>['/employee/create']
                        ],
                        [
                            'label' => 'List',
                            'labelIcon' => 'fa-th-list',
                            'url'=>['/employee']
                        ],
                    ],
                ]),
            ],

            //Sales report
            [
                'label'=>'Sales Report',
                'labelIcon' => 'fa-bar-chart',
                'options'=>['class'=>'mm-dropdown mm-dropdown-root'],
                'items' => NavPixel::widget([
                    'options' => [
                        'class' => 'mmc-dropdown-delay animated fadeInLeft',
                    ],
                    'items' => [
                        [
                            'label' => 'CI',
                            'labelIcon' => 'fa-users',
                            'url'=>['/salesreport/ci'],
                        ],
                        [
                            'label' => 'Project',
                            'labelIcon' => 'fa-building',
                            'url'=>['/salesreport/project'],
                        ],
                        [
                            'label' => 'Report',
                            'labelIcon' => 'fa-pie-chart',
                            'url'=>['/sales-report/report']
                        ],
                    ],
                ]),
            ],
            [
                'label' => 'Reports',
                'labelIcon' => 'fa-bar-chart',
                'url' => ['/memo']
            ],
            [
                'label' => 'Notices',
                'labelIcon' => 'fa-bullhorn',
                'url' => ['/memo']
            ],
            [
                'label' => 'Admin\'s Stock',
                'labelIcon' => 'fa-archive',
                'url' => ['/memo']
            ],
        ];
    }

    public static function mainNavigation()
    {
        return [
//            [
//                'label' => 'Home',
//                'url' => ['/'],
//            ],
            //Employees
            [
                'label' => 'Employees',
                'url' => ['/memo'],
                'options' => [
                    'class' => 'dropdown'
                ],
                'items' => NavPixel::widget([
                    'options' => [
                        'class' => 'dropdown-menu',
                    ],
                    'items' => [
                        [
                            'label' => 'Groups',
                        ],
                    ],
                ]),
            ],
            //Document
            [
                'label' => 'Documents',
                'url' => ['/memo'],
                'options' => [
                    'class' => 'dropdown'
                ],
                'items' => NavPixel::widget([
                    'options' => [
                        'class' => 'dropdown-menu',
                    ],
                    'items' => [
                        [
                            'label' => 'Document Type',
                        ],
                        [
                            'label' => 'Document Template Fiels',
                        ],
                        [
                            'label' => 'Document Control Type',
                        ],
                        [
                            'label' => 'Document Control Data',
                        ],
                    ],
                ]),
            ],

            //Workflow
            [
                'label' => 'Workflow',
                'url' => ['/memo'],
                'options' => [
                    'class' => 'dropdown'
                ],
                'items' => NavPixel::widget([
                    'options' => [
                        'class' => 'dropdown-menu',
                    ],
                    'items' => [
                        [
                            'label' => 'Workflow Groups',
                        ],
                        [
                            'label' => 'Workflows',
                        ],
                        [
                            'label' => 'Workflow Status',
                        ],
                    ],
                ]),
            ],
        ];
    }
}
