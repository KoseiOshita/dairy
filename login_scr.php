<?php

function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

session_start();
//ログイン済みの場合
if (isset($_SESSION['EMAIL'])) {
  header('Location: index.php');
  echo 'ようこそ' .  h($_SESSION['EMAIL']) . "さん<br>";
  echo "<a href='/daily/logout.php'>ログアウトはこちら。</a>";
  exit;
}

 ?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Login</title>
   <link rel="stylesheet" href="style.css">
 </head>
 <body>
    <h2>ようこそ、ログインしてください。</h2>
   <form  action="login.php" method="post">
     <label for="email">email　</label>
     <input type="email" name="email"><br>
     <label for="password">password</label>
     <input type="password" name="password">
     <button type="submit">Sign In!</button>
   </form>
   <h2>初めての方はこちら</h2>
   <form action="signUp.php" method="post">
     <label for="email">email　</label>
     <input type="email" name="email"><br>
     <label for="password">password</label>
     <input type="password" name="password"><br>
     <label for="user_name">ユーザ名　</label>
     <input type="user_name" name="user_name">
     <button type="submit">Sign Up!</button>
     <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
   </form>
  </body>
</html>
