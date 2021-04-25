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


<form method="post" action="../Passwd_update.php">
新パスワード：<input type='text' name='password' value='' required)><br>
<input type="hidden" name="id" value="<?php echo htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8'); ?>">
<br>
<input type="submit" value="登録" class="button">
　
<a class="btn_cancel" href="http://oshko03.php.xdomain.jp/daily/admin/admin_form.php">キャンセル</a>
</form>