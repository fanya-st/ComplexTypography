<?php

return [
    'updateOwnLabelDesigner' => [
        'type' => 2,
        'description' => 'Update own label by designer',
        'ruleName' => 'isOwnLabel',
    ],
    'updateOwnShipmentManager' => [
        'type' => 2,
        'description' => 'Update own shipment by manager',
        'ruleName' => 'AllowToEditShipment',
    ],
    'updateOwnCustomerManager' => [
        'type' => 2,
        'description' => 'updateOwnCustomerManager',
        'ruleName' => 'AllowToEditCustomer',
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
    'driver' => [
        'type' => 1,
        'description' => 'Водитель',
    ],
    'accountant' => [
        'type' => 1,
        'description' => 'Бухгалтер',
    ],
    'designer' => [
        'type' => 1,
        'description' => 'Дизайнер',
        'children' => [
            'updateOwnLabelDesigner',
            'allowToDesignReadyRule',
        ],
    ],
    'logistician' => [
        'type' => 1,
        'description' => 'Логист',
    ],
    'packer' => [
        'type' => 1,
        'description' => 'Упаковщик',
    ],
    'rewinder' => [
        'type' => 1,
        'description' => 'Перемотчик',
    ],
    'printer' => [
        'type' => 1,
        'description' => 'Печатник',
    ],
    'prepress' => [
        'type' => 1,
        'description' => 'Допечатник',
        'children' => [
            'allowToPrepressReadyRule',
        ],
    ],
    'laboratory' => [
        'type' => 1,
        'description' => 'Лаборант',
        'children' => [
            'allowToFlexformReadyRule',
        ],
    ],
    'designer_admin' => [
        'type' => 1,
        'description' => 'Начальник отдела дизайна',
        'children' => [
            'designer',
            'prepress',
        ],
    ],
    'manager' => [
        'type' => 1,
        'description' => 'Менеджер',
        'children' => [
            'updateOwnLabelManager',
            'updateOwnShipmentManager',
            'updateOwnCustomerManager',
            'updateOwnOrderManager',
        ],
    ],
    'manager_admin' => [
        'type' => 1,
        'description' => 'Начальник отдела продаж',
        'children' => [
            'manager',
        ],
    ],
    'warehouse_manager' => [
        'type' => 1,
        'description' => 'Заведующий складом',
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Администратор',
        'children' => [
            'accountant',
            'designer_admin',
            'logistician',
            'warehouse_manager',
            'rewinder',
            'driver',
            'packer',
            'manager_admin',
            'manager',
            'laboratory',
            'designer',
            'printer',
        ],
    ],
];
