<?php
session_start();
$_SESSION = array();
session_destroy();
?>
<html>
    <head>
        <link rel="stylesheet" href="/milligram.css">
        <link rel="stylesheet" href="/style.css">
        <title>ログアウト</title>
    </head>
    <body>
        <main class="wrapper">
            <section class="container">
                <h3>ログアウトに成功しました</h3>
                <a href="/login.php">ログインページに戻る</a>
            </section>
        </main>
    </body>
</html>
