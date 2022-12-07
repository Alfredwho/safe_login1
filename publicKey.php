<?php
header('Access-Control-Allow-Origin:*');
$config = require __DIR__.'/config/config.php';
echo json_encode([
    'code' => '000',
    'data' => [
        'publicKey' => $config['publicKey']
    ]
]);
die();