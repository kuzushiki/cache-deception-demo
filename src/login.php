<?php
session_start();
$err = "IDとパスワードを入力してください";
if (isset($_POST['id']) && $_POST['id'] !== "") {
    if ($_POST['id'] === 'admin') {
        if ($_POST['pw'] === 'admin') {
            $_SESSION['id'] = $_POST['id'];
            header('Location: /index.php');
            exit; 
        }
    }
    $err = "IDもしくはパスワードが無効です...";
}
?>
<html>
    <head>
        <link rel="stylesheet" href="/milligram.css">
        <link rel="stylesheet" href="/style.css">
        <title>管理者用ログインページ</title>
    </head>
    <body>
        <main class="wrapper">
            <section class="container">
                <h3>管理者用ログインページ</h3>
                <form name="login" action="login.php" method="POST">
                    ID: <input type="text" name="id"><br>
                    PW: <input type="password" name="pw"><br>
                    <input type="submit" value="send">
                </form>
                <p><?= $err ?></p>
            </section>
        </main>
    </body>
</html>
