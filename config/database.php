<?php 

return [
    'host' => 'localhost',
    'port' => '5432',
    'database' => 'student_db',
    'username' => 'postgres',
    'password' => '',
    'charset' => 'utf8',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];