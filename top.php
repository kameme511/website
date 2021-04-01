<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
require_once 'private/database.php';
session_start();
$name = $_SESSION['name'];
if(empty($_SESSION['name']) == true){
   require_once'private/failure_post.php';
}
$statement = $dbh->prepare('SELECT * FROM  `bbs` ORDER BY `id` DESC');
$statement->execute();
$articles = $statement->fetchAll();
?>
<!doctype html>
<?php
  require_once 'private/database.php';
  require_once 'private/bootstrap.php';
?>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>onegai</title>
    <nav role="navigation">
      <div class="center-block">
        <a href="logout.php" class="btn btn-danger">ログアウト</a>
        <?php
        if($_SESSION['name'] == "developer"){
          echo '<a href="del.php" class="btn btn-outline-danger">投稿削除</a>';
        }
        ?>
      </div>
    </nav>
</head>
  <body>
    <header>
      <h1>SNS</h1>
      <img src="https://1.bp.blogspot.com/-H61djj8LaRk/X68akpuOknI/AAAAAAABcSA/6h-CmsvWsw0eum4hgZ6jje0f4ctNxZG9wCNcBGAsYHQ/s675/cthulhu_deep_ones.png" class="img-fluid" title="kawaii" />
    </header>
    <div class="container">
       <div class="row">
          <div class="col">
            <form action="confirm.php" method="post" enctype="multipart/form-data">
            <table>
                <thead>
                <tr>
                    <th colspan="2">新規投稿</th>
                  </tr>
              </thead>
              <tbody>
              <tr>
                  <th><label for="name">名前</label></th>
                  <td><name="name" id="name"><?= $name ?></td>
              </tr>
              <tr>
                  <th><label for="content">投稿内容</label></th>
                  <td><textarea name="content" id="content" rows="2" required></textarea></td>
              </tr>
              <tr>
                  <th><label for="image">画像</th>
                  <td><input type="file" name="upimg" accept="image/*"></td>
              </tr>
              </tbody>
          </table>
          <button type="submit" class="btn btn-outline-success">投稿</button>
      </form>
<?php
  if(isset($_SESSION['img_failure'])){
  echo "<tr><td><p class='text-warning'>画像ファイルを選択してください！！</p></td></tr>";
  unset($_SESSION['img_failure']);
  }
?>
      </div>
<?php  foreach ($articles as $article) { ?>
      <hr>
          <div>
              <?=htmlspecialchars($article['name']); ?>:&nbsp;<?= $article['created_at'] ?>
          </div>
          <div style="display: inline-flex;">
          <?php
          if(isset($article['picture'])){
          echo "<div>";
          echo '<img src ='.$article['picture'].' class="img-fluid">';
          echo "</div>";
          }
          ?>
          </div>
          <div><?= nl2br(htmlspecialchars($article['content'])); ?></div>
      <br/>
      <br/>
      <br/>
  <?php } ?>
   </div>
</body>
<footer>
<a href="">削除依頼ご意見ご要望</a>
</footer>
</html>
