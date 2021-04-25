<?php
$user = "oshko03_user1";
$pass = "Retype01";

session_start();
//ログイン済みの場合
if (isset($_SESSION['EMAIL'])) {
//echo 'ようこそ' .  h($_SESSION['EMAIL']) . "さん<br>";
//echo "<a href='/daily/logout.php'>ログアウトはこちら。</a>";
} else {
    echo "ログインしてください。<br>";
    echo "<a href='/daily/login_scr.php'>ログインはこちらから。</a>";
    exit;
}

$today = date("Y-m-d H:i:s"); 
$logs = $_POST['logs'];
$username = $_SESSION['USERNAME'];


$dbh = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=oshko03_01;charset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO daily (updated_date, logs, user_name) VALUES (?, ?, ?)";
$stmt = $dbh->prepare($sql);

$stmt->bindValue(1, $today, PDO::PARAM_STR);
$stmt->bindValue(2, $logs, PDO::PARAM_STR);
$stmt->bindValue(3, $username, PDO::PARAM_STR);

$stmt -> execute();
$dbh = null;

// echo "ログが更新されました。";

header('Location: http://oshko03.php.xdomain.jp/daily/index.php');
?>
