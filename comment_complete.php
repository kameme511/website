<?php
require_once 'private/database.php';
require_once 'private/bootstrap.php';
/** @var PDO $dbh データベースハンドラ */

/* --------------------
 * セッション開始
 * -------------------- */
session_start();
/* ------------------------------
 * 送られてきた値を取得する
 * ------------------------------ */
$token = $_POST['token'];
if(isset($_POST['path'])){
    $path = $_POST['path'];
    }
$id = $_POST['id'];
$content = $_POST['content'];
/* --------------------------------------------------
 * 送られてきたトークンのバリデーション
 *
 * セッションに保存されているトークンと比較し、
 * 一致していなかった場合はトップ画面にリダイレクトする
 * -------------------------------------------------- */
if($token != $_SESSION['token']) {
    unset($_SESSION['token']);
    redirect('/top.php');
}
if(empty($content) == true) {
    require_once 'private/top_post.php';
}
/* ----------------------------------------
 * セッション内に保存した投稿内容を取得する
 * ---------------------------------------- */
$name = $_SESSION['name'];
/* --------------------
 * データのインサート処理
 * -------------------- */
$statement = $dbh->prepare('INSERT INTO `comments`(name, content, picture, destination) VALUE(:name, :content, :picture, :destination)');
$statement->execute([
    'name' => $name,
    'content' => $content,
    'picture' => $path,
    'destination' => $id,
    ]);
/* ----------------------------------------
 * セッション内のデータを削除する
 * ---------------------------------------- */
unset($_SESSION['content']);
unset($_SESSION['token']);
?>

<!-- 描画するHTML -->
<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登録成功</title>
</head>
<body>
    <header>
        <h1>登録成功</h1>
    </header>
    <main>
        <a href="top.php">戻る</a>
    </main>
    <footer>
        <hr>
        <div>o(ωk)</div>
    </footer>
</body>
</html>

