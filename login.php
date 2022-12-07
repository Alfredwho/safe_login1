<?php
require __DIR__.'/utils/Conn.php';
require __DIR__.'/Rsa/RsaCrypt.php';
header('Access-Control-Allow-Origin:*');
if (empty($_POST)) {
    require_once __DIR__.'/pages/login.html';
} else {
    session_start();
    $username = addslashes($_POST['username']);
    $password = addslashes($_POST['password']);

    if (empty($username)) {
        echo json_encode([
            'code' => '003',
            'message' => 'please input username'
        ],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        die();
    }

    if (empty($password)) {
        echo json_encode([
            'code' => '003',
            'message' => 'please input password'
        ],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        die();
    }

    $rsa = new RsaCrypt();
    try {
        $decryptPassword = $rsa->decrypt($password);
    }catch (\Exception $e) {
        echo json_encode([
            'code' => '002',
            'message' => 'decrypt error'
        ],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        die();
    }
    $conn = getConn();
    $sql = "select * from `sl_user` where `username` = '$username'";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($res);

    $salt = $row['salt'];
    if(!password_verify($decryptPassword.$salt,$row['password'])) {
        echo json_encode([
            'code' => '001',
            'message' => 'login fail'
        ],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        die();
    }

    $_SESSION['user'] = $row;
    echo json_encode([
        'code' => '000',
        'message' => 'login success'
    ],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    die();
}