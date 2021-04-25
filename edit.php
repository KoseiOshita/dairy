<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>投稿の編集</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
日付：
<?php
    $today = date("Y-m-d H:i:s");   
    echo $today;
?>

<br>
<h2>投稿の編集<h2>
<br>



<!-- 過去ログの内容を表示 -->
<div class=wrapper>
<?php
$user = "oshko03_user1";
$pass = "Retype01";
try {

	if (empty($_GET['id'])) throw new Exeption('ID不正');
	$id = (int) $_GET['id'];
	$dbh = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=oshko03_01;charset=utf8',$user,$pass);
	$dbh -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM daily WHERE id = ?";
	$stmt = $dbh->prepare($sql);
	$stmt -> bindValue(1, $id, PDO::PARAM_INT);
	$stmt -> execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$dbh = null;

} catch (Exception $e) { 
	echo "エラー発生：　" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
	die();
}

   

?>
</div>
   

<form method="post" action="update.php">
<textarea name="logs" cols="50" rows="9" maxlength="500"><?php echo htmlspecialchars($result['logs'], ENT_QUOTES, 'UTF-8'); ?></textarea>
<br>

<a class="btn_cancel" href="http://oshko03.php.xdomain.jp/daily/index.php">キャンセル</a>
<input type="submit" value="更新">
<input type="hidden" name="id" value="<?php echo htmlspecialchars($result["id"], ENT_QUOTES, 'UTF-8'); ?>">
</form>

</body>
</head>
</html>