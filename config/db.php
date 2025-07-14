<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlsrv:Server=DESKTOP-2VPR9IB\JAMES;Database=INVENTORY',
    'username' => 'inventory_user',
    'password' => 'securepass123',
    'charset' => 'utf8',
    'attributes' => [
        PDO::SQLSRV_ATTR_DIRECT_QUERY => true,
    ],
];
