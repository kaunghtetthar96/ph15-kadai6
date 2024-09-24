<?php

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

// ユーザーが見つからなかったらログインページへ
if (is_null($user)) {
    header('Location: ./login.php');
    exit();
}

?>
<html>
    <body>
        <h1>マイページ</h1>
        <table>
            <tr>
                <td>ID</td>
                <td>
                    <?php echo $user['id'] ?>
                </td>
            <tr>
                <td>名前</td>
                <td>
                    <?php echo $user ['name'] ?>
                </td>
            </tr>
            <tr>
                <td>メールアドレス</td>
                <td></td>
            </tr>
        </table>
        <div>
            <a href="./edit.php">
                情報変更
            </a>
        </div>
        <div>
            <a href="./logout.php">
                ログアウト
            </a>
        </div>
    </body>
</html>
