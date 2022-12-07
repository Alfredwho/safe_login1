<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="./lib/css/layui.css" />
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
    <?php
        session_start();
        if ((int)$_SESSION['user']['role'] === 1) {
            echo 'access denied';
            header('refresh:1;url=index.php');
            die();
        }
        require __DIR__.'/utils/Conn.php';
        $conn = getConn();
        $sql = "select * from sl_comment";
        $res = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_array($res);
    ?>
    <div class="main inner_c">
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="200">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>ID</th>
                <th>detail</th>
                <th>user</th>
                <th>Cover</th>
                <th>contact_mode</th>
                <th>contact</th>
                <th>createdAt</th>
                <th>updatedAt</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach($rows as $row) {
                    echo '<tr>';
                        echo '<td><?php $row["id"] ?></td>';
                        echo '<td><?php $row["detail"] ?></td>';
                        echo '<td><?php $row["user"] ?></td>';
                        echo '<td><img style="width: 100px; height: 50px;" src="<?php echo $row["cover"] ?>" /></td>';
                        echo '<td><?php $row["contact_mode"] ?></td>';
                        echo '<td><?php $row["contact"] ?></td>';
                        echo '<td><?php $row["createdAt"] ?></td>';
                        echo '<td><?php $row["updatedAt"] ?></td>';
                    echo '</tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="./lib/layui.js"></script>