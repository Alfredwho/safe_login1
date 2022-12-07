<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to the home page</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .inner_c {
            width: 1024px;
            margin: 0 auto;
        }

        ul li {
            list-style: none;
        }

        a {
            text-decoration: none;
            color: #fff;
        }

        .header {
            width: 100%;
            height: 50px;
            background-color: #000;
        }

        .header .inner_c {
            height: 100%;
        }

        .header ul {
            display: flex;
            height: 100%;
            justify-content: space-between;
            align-items: center;
        }

        .header ul li :hover {
            color: cornflowerblue;
        }

        .main {
            margin-top: 100px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="inner_c">
        <ul>
            <li><a href="index.php">Main</a></li>
            <?php
            session_start();
            if(empty($_SESSION['user'])) {
                ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <?php
            } else {
                ?>
                <li><a href="comment.php">Comment</a></li>
                <li><a href="logout.php">Logout</a></li>
                <?php
            }
            ?>

            <?php if(!empty($_SESSION['user']['role']) && ( $_SESSION['user']['role']== 2)): ?>
                <li><a href="list.php">CommentList</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="main inner_c">
        <?php if(!empty($_SESSION['user'])): ?>
            <h1 align="center">
                <a href="comment.php" style="color: blue; font-size: 32px">Go To Comment</a>
            </h1>
        <?php endif; ?>
    </div>
</div>
</body>
</html>