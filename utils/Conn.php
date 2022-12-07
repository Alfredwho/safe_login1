<?php
function getConn() {
    $config = require __DIR__.'/../config/config.php';
    $conn = mysqli_connect($config['db']['host'],$config['db']['dbuser'], $config['db']['dbpass'],$config['db']['dbname'],$config['db']['port']);
    if (!$conn) {
        die('database connection error!');
    }
    return $conn;
}

