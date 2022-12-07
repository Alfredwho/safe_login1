<?php
require __DIR__.'/utils/Conn.php';
require __DIR__.'/Rsa/RsaCrypt.php';
header('Access-Control-Allow-Origin:*');
if (empty($_POST)) {
    require_once __DIR__.'/pages/register.html';
} else {
    $username = addslashes($_POST['username']);
    $password = addslashes($_POST['password']);
    $email = addslashes($_POST['email']);
    $nickname = addslashes($_POST['nickname']);
    $role = addslashes($_POST['role']);
    $phone = addslashes($_POST['phone']);
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

    if (empty($email)) {
        echo json_encode([
            'code' => '003',
            'message' => 'please input email'
        ],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        die();
    }

    if (empty($nickname)) {
        echo json_encode([
            'code' => '003',
            'message' => 'please input nickname'
        ],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        die();
    }

    if (empty($phone)) {
        echo json_encode([
            'code' => '003',
            'message' => 'please input phone'
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

    $sql_check = "select * from `sl_user` where `username` = '$username'";
    $checkRes = mysqli_query($conn, $sql_check);
    if(mysqli_fetch_array($checkRes)) {
        echo json_encode([
            'code' => '004',
            'message' => 'username: '.$username.' is Exists'
        ],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        die();
    }
    $createdAt = date('Y-m-d H:i:s',time());
    $updatedAt = date('Y-m-d H:i:s',time());
    $newPassword = password_hash($decryptPassword.'!@#$%^&*',PASSWORD_DEFAULT);
    $sql = "insert into `sl_user`(`username`, `password`, `salt`, `email`, `nickname`, `role`, `phone`,`created_at`,`updated_at`) values('$username','$newPassword','!@#$%^&*','$email','$nickname','$role','$phone','$createdAt','$updatedAt')";
    $res = mysqli_query($conn,$sql);

    if(!$res) {
        echo json_encode([
            'code' => '001',
            'message' => 'register fail'
        ],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        die();
    }

    echo json_encode([
        'code' => '000',
        'message' => 'register success'
    ],JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    die();
}