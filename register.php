<html lang="ja">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会員登録</title>
    <div>
        <form action="register_reveiw.php" method="post">
            <table>
                <thead>
                <tr>
                    <th colspan="2">新規会員登録</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th><label for="name">ユーザー名</label></th>
                    <td><input type="text" name="name" id="name" required></td>
                </tr>
                <tr>
                    <th><label for="content">パスワード</label></th>
                    <td><input name="content" id="content" pattern="^[0-9A-Za-z]+$" required></td>
                </tr>
                </tbody>
            </table>
            <a>パスワードは、半角英数字で入力する必要があります。</a></br>
            <button type="submit" class="btn btn-success">登録</button>
        </form>
    </div>
  </body>
</html>
