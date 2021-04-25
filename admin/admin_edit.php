<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../style.css">

<?php
$user="oshko03_user1";
$pass="Retype01";

try {
    if (empty($_GET['id'])) throw new Exception('ID不正');
    $id = (int) $_GET['id'];
    $dbh = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=oshko03_01;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM userDeta WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $dbh = null;

    
} catch (Exception $e) { 
    echo "エラー発生： " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>入力フォーム</title>
</head>
<body>
<h2>ユーザ詳細</h2><br>
<form method="post" action="admin_update.php">
ユーザ：<input type="text" name="user_name" value="<?php echo htmlspecialchars($result['user_name'], ENT_QUOTES, 'UTF-8'); ?>" required><br>
<!--新パスワード：<input type='text' name='password' value='<?php echo htmlspecialchars($result['password'], ENT_QUOTES, 'UTF-8'); ?>' required)><br>";
-->

Email：<input type="text" name="email" value="<?php echo htmlspecialchars($result['email'], ENT_QUOTES, 'UTF-8'); ?>" required><br>
管理権限：　　
<?php
if ($result[('admin')] === "1") {
    echo "<input name='admin' type='checkbox' value='1' checked/>";
} else {
    echo "<input name='admin' type='checkbox' value='0' />";
}
?>

<br>


<!-- <?php var_dump($_POST["admin"]); ?>  -->
<!-- 他の項目はここに書く。p218付近  -->

<input type="hidden" name="id" value="<?php echo htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8'); ?>">

<br>

<input type="submit" value="登録" class="button">
<a class="btn_cancel" href="http://oshko03.php.xdomain.jp/daily/admin/admin_form.php">キャンセル</a>
</form>
</body>
</html>
