<?php

session_start();
session_destroy();
$_SESSION = [];
header('refresh:1;url=index.php');