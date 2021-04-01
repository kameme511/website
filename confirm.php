<?php
/* --------------------
 * セッション開始
 * -------------------- */
session_start();
/* ------------------------------
 * 送られてきた値を取得する
 * セッションにも保存しておく
 * ------------------------------ */
$name = $_SESSION['name'];
$content =  $_POST['content'];
$_SESSION['content'] = $content;
if($_FILES['upimg']['name']){
    $ext = substr($_FILES['upimg']['name'], strrpos($_FILES['upimg']['name'], '.') + 1);
    if(strtolower($ext) !== 'png' && strtolower($ext) !== 'jpg' && strtolower($ext) !== 'gif'){
    $_SESSION['img_failure'] = $ext;
    header('location:/top.php');
    exit;
    }
    $tmpname = str_replace('/tmp/','',$_FILES['upimg']['tmp_name']);
    $new_filename = 'files/'.$tmpname.'-'.time().'.'.'png';
    $upimg = fopen($_FILES['upimg']['tmp_name'],'rb');
    $img = fread($upimg, filesize($_FILES['upimg']['tmp_name']));
    fclose($upimg);
    require_once 'private/upimg.php';
  }
/* --------------------------------------------------
 * 値のバリデーションを行う
 *
 * 入力された値が正しいフォーマットで送られているかを確認する
 * 今回は値が入力されているかのみを確認する
 * -------------------------------------------------- */
if(empty($content) == true) {
    require_once 'private/top_post.php';
}

/* ----------------------------------------
 * 確認画面と登録画面で利用するトークンを発行する
 * 今回は時刻をトークンとする
 * ---------------------------------------- */
$token = strval(time());
$_SESSION['token'] = $token;
?>

<!-- 描画するHTML -->
<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>投稿確認</title>
</head>
<body>
    <header>
        <h1>確認</h1>
    </header>
    <main>
        <div>下記の内容で投稿しますがよろしいですか?</div>
        <table>
            <tbody>
            <tr><th>名前</th><td><?= htmlspecialchars($name); ?></td></tr>
            <tr><th>投稿内容</th><td><?= nl2br(htmlspecialchars($content)); ?></td></tr>
            <?php
            if(isset($img)){
            echo "<tr><th>画像</th><td>".htmlspecialchars($_FILES['upimg']['name'])."</td></tr>";  
        }
        ?>
        </tbody>
        </table>
        <form action="con_complete.php" method="post">
            <?php
            if(isset($path)){
            echo "<input type='hidden' name='path' value='$path'>";
            }
            ?>
            <input type="hidden" name="token" value="<?= $token ?>">
            <button type="submit">投稿</button>
        </form>
    </main>
    <footer>
        <hr>
        <div>_〆(ω;)</div>
    </footer>
</body>
</html>
