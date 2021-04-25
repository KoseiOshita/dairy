<?php
$user = "oshko03_user1";
$pass = "Retype01";
try {
    if (empty($_GET['id'])) throw new Exception('ID不正');
    $id = (int) $_GET['id'];
    $dbh = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=oshko03_01;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM daily where id = ?";
    $stmt = $dbh->PREPARE($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $dbh = null;
    echo "ID: ". htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "の削除が完了しました。";
    echo ("<br>");
    echo "<a href='http://oshko03.php.xdomain.jp/daily/index.php'>掲示板に戻る</a>";
    //header('Location: http://oshko03.php.xdomain.jp/daily/index.php');

} catch (exception $e) {
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}