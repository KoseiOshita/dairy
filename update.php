<?php
$user = "oshko03_user1";
$pass = "Retype01";
$today = date("Y-m-d H:i:s");
$logs = $_POST['logs'];
try {
    if (empty($_POST['id'])) throw new Exception('ID不正');
    $id= (int) $_POST['id'];
    $dbh = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=oshko03_01;charset=utf8',$user,$pass);
	$dbh -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE daily SET updated_date = ?, logs = ? where id = ?";
    $stmt = $dbh-> prepare($sql);
    $stmt -> bindValue(1,$today, PDO::PARAM_STR);
    $stmt -> bindValue(2,$logs, PDO::PARAM_STR);
    $stmt -> bindValue(3,$id, PDO::PARAM_INT);
    
    $stmt->execute();
    $dbh = null;
    
    echo "ID: " . htmlspecialchars($id,ENT_QUOTES, 'UTF-8') . "コメントの更新が完了しました";
    echo ("<br>");
    echo "<a href='http://oshko03.php.xdomain.jp/daily/index.php'>掲示板に戻る</a>";

} catch (Exception $e) { 
    echo "エラー発生：　". htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}



?>