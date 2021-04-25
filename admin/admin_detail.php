<?php
$user="oshko03_user1";
$pass="Retype01";

try {
    $id = (int) $_GET['id'];
    $dbh = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=oshko03_01;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * from userDeta WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($result);
    $dbh = null;
} catch (Exception $e) {
    echo "エラー発生：　" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}
