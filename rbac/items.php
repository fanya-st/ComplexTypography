<?php

return [
    'updateOwnLabelDesigner' => [
        'type' => 2,
        'description' => 'Update own label by designer',
        'ruleName' => 'isOwnLabel',
        'children' => [
            'allowToDesignReadyRule',
        ],
    ],
    'updateOwnLabelManager' => [
        'type' => 2,
        'description' => 'Update own label by manager',
        'ruleName' => 'isOwnLabel',
    ],
    'allowToPrepressReadyRule' => [
        'type' => 2,
        'description' => 'prepress ready if it in prepress',
        'ruleName' => 'AllowToPrepressReadyRule',
    ],
    'allowToDesignReadyRule' => [
        'type' => 2,
        'description' => 'design ready if it in design',
        'ruleName' => 'AllowToDesignReadyRule',
    ],
    'designer' => [
        'type' => 1,
        'children' => [
            'updateOwnLabelDesigner',
        ],
    ],
    'prepress' => [
        'type' => 1,
        'children' => [
            'allowToPrepressReadyRule',
        ],
    ],
    'laboratory' => [
        'type' => 1,
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
            'updateOwnLabelManager',
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
            'laboratory',
            'designer',
        ],
    ],
];
