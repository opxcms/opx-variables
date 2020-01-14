<?php

return [
    'items' => [
        'variables' => [
            'caption' => 'opx_variables::manage.variables',
            'section' => 'system/site',
            'route' => 'opx_variables::variables',
        ],
    ],

    'routes' => [
        'opx_variables::variables' => [
            'route' => '/variables',
            'loader' => 'manage/api/module/opx_variables/variables',
        ],
    ]
];