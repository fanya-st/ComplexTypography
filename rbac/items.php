<?php

return [
    'updateOwnLabelDesigner' => [
        'type' => 2,
        'description' => 'Update own label by designer',
        'ruleName' => 'isOwnLabel',
    ],
    'updateOwnOrderManager' => [
        'type' => 2,
        'description' => 'Update own order by manager',
        'ruleName' => 'AllowToEditOrder',
    ],
    'allowToFlexformReadyRule' => [
        'type' => 2,
        'description' => 'Update own label by designer',
        'ruleName' => 'AllowToFlexformReadyRule',
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
            'allowToDesignReadyRule',
        ],
    ],
    'packer' => [
        'type' => 1,
    ],
    'rewinder' => [
        'type' => 1,
    ],
    'printer' => [
        'type' => 1,
    ],
    'prepress' => [
        'type' => 1,
        'children' => [
            'allowToPrepressReadyRule',
        ],
    ],
    'laboratory' => [
        'type' => 1,
        'children' => [
            'allowToFlexformReadyRule',
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
            'updateOwnLabelManager',
            'updateOwnOrderManager',
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
            'rewinder',
            'packer',
            'manager_admin',
            'manager',
            'laboratory',
            'designer',
            'printer',
        ],
    ],
];
