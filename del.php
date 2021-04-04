<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
session_start();
if($_SESSION['name'] != "developer") {
    redirect('/top.php');
}
?>
<!doctype html>
<?php
  require_once 'private/database.php';
  require_once 'private/bootstrap.php';
  $statement1 = $dbh->prepare('SELECT * FROM  `bbs` ORDER BY `id` DESC');
  $statement1->execute();
  $articles1 = $statement1->fetchAll();
  $statement2 = $dbh->prepare('SELECT * FROM `comments` ORDER BY `id`');
  $statement2->execute();
  $articles2 = $statement2->fetchAll();
?>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>onegai</title>
    <nav role="navigation">
      <div class="center-block">
        <a href="top.php" class="btn btn-danger">戻る</a>
      </div>
    </nav>
</head>
  <body>
    <header>
      <h1>SNS</h1>
    </header>
     <form action="del_complete.php" method="post">
     <input type="submit" value="削除" class="btn btn-outline-danger">
<?php  foreach ($articles1 as $article1) { ?>
      <hr>
          <div>
          <input type="checkbox" name="id[]" value="<?= $article1['id']; ?>"
          </div>
          <div>
          <?= htmlspecialchars($article1['name']); ?>:&nbsp;<?= $article1['created_at'] ?>
          </div>
          <div style="display: inline-flex;">
          <?php
          if(isset($article1['picture'])){
          echo "<div>";
          echo '<img src ='.$article1['picture'].' class="img-fluid">';
          echo "</div>";
          }
          ?>
          </div>
          <div><?= nl2br(htmlspecialchars($article1['content'])); ?></div>
      <br/>
      <br/>
      <br/>
 <?php  foreach ($articles2 as $article2) {
       if($article2['destination'] == $article1['id']){
?>
     <hr>
     <div class="col-md-9 offset-md-1">
          <div>
          <input type="checkbox" name="com_id[]" value="<?= $article2['id']; ?>"
          </div>
          <div>
              <?=htmlspecialchars($article2['name']); ?>:&nbsp;<?= $article2['created_at'] ?>
          </div>
          <div style="display: inline-flex;">
          <?php
          if(isset($article2['picture'])){
          echo "<div>";
          echo '<img src ='.$article2['picture'].' class="img-fluid">';
          echo "</div>";
          }
          ?>
          </div>
          <div><?= nl2br(htmlspecialchars($article2['content'])); ?></div>
     </div>
          <br/>
          <br/>
          <br/>
<?php 
      }
    }
  }
?>
   </form>
   </div>
</body>
<footer>
<a href="">削除依頼ご意見ご要望</a>
</footer>
</html>

