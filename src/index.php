<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['id'] === "") {
    header('Location: /login.php');
    exit;
}
?>
<html>
    <head>
        <link rel="stylesheet" href="/milligram.css">
        <link rel="stylesheet" href="/style.css">
        <title>管理者のページ</title>
    </head>
    <body>
        <main class="wrapper">
            <section class="container">
                <h3>管理者のページ</h3>
                <p>**センシティブな情報が記載されています**</p>
                <a href="/logout.php">ログアウト</a>
            </section>
        </main>
        <? phpinfo(); ?>
    </body>
</html>
