<?php
session_start();

if (empty($_SESSION)) {
    echo 'please login';
    header('refresh:1;url=login.php');
    die();
}

require __DIR__.'/utils/Conn.php';
if (empty($_POST)) {
    require_once __DIR__.'/pages/comment.html';
} else {
    require_once __DIR__.'/upload.php';
    $upload = new upload([
        'fileName'=>'myfile',
        'maxSize'=>1024*1024,
        'allowMime'=>['image/png','image/jpg','image/git','image/jpeg'],
        'allowExt'=>['jpg','png','jpeg','gif'],
        'uploadPath'=>'./upload',
        'imgFlag'=>true
    ]);
    $res = $upload->uploadFile();
    $detail = addslashes($_POST['detail']);
    $contactMode = addslashes($_POST['contactMode']);
    $userId = $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];
    $contact = $_SESSION['user']['phone'];
    if ((int) $contactMode === 2) {
        $contact = $_SESSION['user']['email'];
    }

    $conn = getConn();

    $createdAt = date('Y-m-d H:i:s',time());
    $updatedAt = date('Y-m-d H:i:s',time());
    $sql = "insert into `sl_comment`(`detail`, `user_id`, `contact_mode`, `username`, `contact`,`created_at`,`updated_at`,`cover`) values('$detail','$userId','$contactMode','$username','$contact','$createdAt','$updatedAt','$res')";
    $res = mysqli_query($conn,$sql);

    if(!$res) {
        echo 'comment fail';
        header('refresh:1;url=comment.php');
       die();
    }
    echo 'comment success';
    header('refresh:1;url=comment.php');
}