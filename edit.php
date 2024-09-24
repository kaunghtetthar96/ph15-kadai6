<?php

// 他のPHPファイルを読み込む
require_once __DIR__ . '/functions/user.php';

// これを忘れない
session_start();

// セッションとCOOKIEにIDが保存されていなければ
// ログインページに移動
if (!isset($_SESSION['id']) && !isset($_COOKIE['id'])) {
    header('Location: ./login.php');
    exit();
}

// セッションにIDが保存されていればセッション
// ない場合はCOOKIEからID を取得
$id = $_SESSION['id'] ?? $_COOKIE['id'];

$user = getUser($id);

// ファイルが送信されましたがチェックする
if (isset($_POST['submit-button'])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $password = $_POST['password'];

   // 連想配列を作成
   $user = [
        'id' => $id,
        'name' => $name,
        'email' => $email,
        'password' => $password,
   ];

   // 関数を呼び出す
   $user = editUser($user);

   // my-page に移動させる (リダイレクト)
   header('Location: ./my-page.php');
   exit();
}

?>

<html>
    <head>
        <style>
            div {
                margin: 10px 0;
            }
        </style>
    </head>

    <body>
        <h1>会員登録</h1>
        <form action="./edit.php" method="post">
            <div class="input-wrap">
                <div>お名前<br>
                    <input type="text" name="name" value="<?php echo $user['name'] ?>">
                </div>

                <div>メールアドレス<br>
                    <input type="email" name="email" value="<?php echo $user['email'] ?>">
                </div>

                <div>パスワード<br>
                    <input type="password" name="password">
                </div>

                <div>
                    <input type="submit" value="登録" name="submit-button">
                    <!-- <button type="submit">登録</button> -->
                </div>
            </div>
        </form>
    </body>
</html>
