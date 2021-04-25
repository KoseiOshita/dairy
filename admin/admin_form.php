<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../style.css">
<title>管理画面</title>
</head>
<body>
<h2>管理フォーム</h2>
<form method="post" action="admin_receive.php">

<?php
$user = oshko03_user1;
$pass = Retype01;


// DBからSQLを実行してユーザデータを抽出 
$dbh = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=oshko03_01;charset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'select * from userDeta';

//sql実行してデータが存在したら全件fetch
if ($stmt = $dbh->query($sql)) {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$url = "http://oshko03.php.xdomain.jp/daily/admin/admin_edit.php?id=";
    
    // テーブルのデータをoptionタグに成形 
    foreach($result as $user_data_val) {
        $user_data .= "<option value='". $url . $user_data_val['id'];
        $user_data .= "'>". $user_data_val['user_name']. "</option>";
        $email = $user_data_val['email'];
        
        $user_name2 = $user_data_val['user_name'];
        

    }
}
$dbh = null;


?>
編集するユーザを選択してください。<br>
ユーザ名：　
<!--  全ユーザをセレクトボックスに書き出し -->
<form method='POST' action='/test.php'>
<select name='user' onChange="location.href=value;">
    <?php 
    echo "<option value=''>選択してください</option>";   
    echo $user_data; ?>
</select>


</form>


<br>
掲示板の各投稿の編集・削除をするには、<a href="http://oshko03.php.xdomain.jp/daily/index.php">こちらの掲示板</a><br>
にアクセスしてください。<br>

<a class="btn_cancel" href="http://oshko03.php.xdomain.jp/daily/index.php">キャンセル</a>



</body>
</html>