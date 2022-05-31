<?php

return [
    'updateOwnLabel' => [
        'type' => 2,
        'description' => 'Update own label',
        'ruleName' => 'isOwnLabel',
    ],
    'prepressOwnLabel' => [
        'type' => 2,
        'description' => 'prepress own label',
        'ruleName' => 'isPrepressLabel',
    ],
    'designer' => [
        'type' => 1,
        'children' => [
            'updateOwnLabel',
        ],
    ],
    'prepress' => [
        'type' => 1,
        'children' => [
            'prepressOwnLabel',
        ],
    ],
    'designer_admin' => [
        'type' => 1,
        'children' => [
            'designer',
            'prepress',
        ],
    ],
    'manager' => [
        'type' => 1,
        'children' => [
            'updateOwnLabel',
        ],
    ],
    'manager_admin' => [
        'type' => 1,
        'children' => [
            'manager',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'designer_admin',
            'manager_admin',
            'manager',
            'designer',
        ],
    ],
];
