<?php
require_once('config.php');
$user = "oshko03_user1";
$pass = "Retype01";
//データベースへ接続、テーブルがない場合は作成
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec("create table if not exists userDeta(
      id int not null auto_increment primary key,
      email varchar(255),
      password varchar(255),
      user_name varchar(20),
      created timestamp not null default current_timestamp
    )");
} catch (Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
//POSTのValidate。
if (!$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  echo '入力された値が不正です。';
  return false;
}
//パスワードの正規表現
if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
} else {
  echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。';
  return false;
}
  $user_name = $_POST['user_name'];
//登録処理
try {
  $stmt = $pdo->prepare("insert into userDeta(email, password, user_name) value(?, ?, ?)");
  $stmt->execute([$email, $password, $user_name]);
  echo '登録完了';
  echo '<br>';
  echo '前の画面に戻って作成したユーザとパスワードでログインしてください。';
} catch (\Exception $e) {
  echo '登録済みのメールアドレスです。';
}
