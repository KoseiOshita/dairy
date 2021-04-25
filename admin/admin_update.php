<?php
$user = 'oshko03_user1';
$pass = 'Retype01';
$id = $_POST['id'];
$user_name = $_POST['user_name'];
$password = $_POST['password'];
$email = $_POST['email'];
$admin = $_POST['admin'];

//POSTのValidate。
if (!$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo '入力された値が不正です。';
    return false;
  }
  //パスワードの正規表現
  //if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {
  //  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  //} else {
  //  echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。';
  //  return false;
  //}

  if(isset($_POST['admin'])) {
    $admin = 1;
  } else {
    $admin = 0;
  }



try {
    if (empty($_POST['id'])) throw new Exception('ID不正');
    $id = (int) $_POST['id'];
    $dbh = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=oshko03_01;charset=utf8', $user, $pass);
    $dbh ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE userDeta SET email = ?, user_name = ?, admin = ? WHERE id = ?";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(1, $email, PDO::PARAM_STR);
    $stmt->bindValue(2, $user_name, PDO::PARAM_STR);
    $stmt->bindValue(3, $admin, PDO::PARAM_STR);
    $stmt->bindValue(4, $id, PDO::PARAM_INT);

    $stmt->execute();
    $dbh = null;
    echo "ID: " . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "ユーザの更新が完了しました。";
    echo "<br>";
    echo "<a class='btn_cancel' href='http://oshko03.php.xdomain.jp/daily/admin/admin_form.php'>OK</a>";

} catch (Exception $e) {
    echo "エラー発生：　" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}
