<?php

return [
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'host'     => $_ENV['SKEL_DB_HOST'],
                    'dbname'   => $_ENV['SKEL_DB_NAME'],
                    'user'     => $_ENV['SKEL_DB_USER'],
                    'password' => $_ENV['SKEL_DB_PASS'],
                    'port'     => $_ENV['SKEL_DB_PORT'],
                ],
            ],
        ],
    ],
];
