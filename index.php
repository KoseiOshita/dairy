<?php
session_start();
//ログイン済みの場合
if (isset($_SESSION['EMAIL'])) {
//    echo $_SESSION['USERNAME'];
echo 'ようこそ、<strong>' .  $_SESSION['USERNAME'] . "</strong>さん";
echo "　　　　";
echo "<a href='http://oshko03.php.xdomain.jp/daily/admin/admin_form.php'>管理画面(要管理権限)はこちら</a><br>";
} else {
    echo "ログインしてください。<br>";
    echo "<a href='/daily/login_scr.php'>ログインはこちらから。</a>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>ログの入力</title>
<link rel="stylesheet" href="style.css">
<style>
    html, body {
        font-size: 12px ;
    }
</style>   
</head>

<body>

<!--  <script src="zoom-block.js"></script>   -->  

日付：
<?php
    $today = date("Y-m-d H:i:s");   
    echo $today;
    echo "　　　　　　";
    echo "<a href='/daily/logout.php'>ログアウトはこちら</a>";
?>


<br>
ログの入力
<?php echo "　　　　　　　　　　　　　　　　";?>
<?php echo '<a href="http://oshko03.php.xdomain.jp/daily/admin/admin_chgPasswd.php?id=' . $_SESSION['ID'] . '">パスワードの変更</a>'; ?><br>   

<form method="post" action="add.php">
<textarea name="logs" cols="50" rows="9" maxlength="500"></textarea>

<br><br>
<input type="submit" value="送信" class="button">

</form>

<br>
<hr>
<br>


<!-- 過去ログの内容を表示 -->
<div class=wrapper>
<?php
$user = "oshko03_user1";
$pass = "Retype01";
// try {
    $dbh = new PDO('mysql:host=mysql1.php.xdomain.ne.jp;dbname=oshko03_01;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM daily order by id DESC";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
    define('MAX', '10');
    $log_num = count($result);
    $max_page = ceil($log_num / MAX);


    if(!isset($_GET['page_id'])) {   //$_GET['page_id'] はURLに渡された現在のページ数
        $now = 1;                   // 設定されてない場合は1ページ目にする
    }else{
        $now = $_GET['page_id'];
    }

    $start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか

    $disp_data = array_slice($result, $start_no, MAX, true);



    foreach ($disp_data as $row) {
        echo "<strong>" . $row['user_name'] . "</strong>";
        echo "　　";  
        echo $row['updated_date'];

        if ($_SESSION['ADMIN'] === "1") {
            echo "　　";        
            echo '<a href=edit.php?id='.$row['id'].'>編集</a>'  ;
            echo "　";
            echo '<a href=delete.php?id='.$row['id'].'>削除</a>';
        } elseif  ($row['user_name'] === $_SESSION['USERNAME']) {   
            echo "　　";        
            echo '<a href=edit.php?id='.$row['id'].'>編集</a>'  ;
            echo "　";
            echo '<a href=delete.php?id='.$row['id'].'>削除</a>';
        }
        
        echo "<br>";
            // ハイパーリンクを埋め込むケース
            $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
            $replace = '<a href="$1" target="_blank">$1</a>';
            $row     = preg_replace( $pattern, $replace, $row );
        echo  nl2br($row['logs']);
        //echo  nl2br(htmlspecialchars($row['logs'], ENT_QUOTES, 'UTF-8'));
        
        echo "<br><br>";
        echo "<hr>";
    }
    

    echo '全件数'. $log_num. '件'. '　'; // 全データ数の表示です。

    for($i = 1; $i <= $max_page; $i++){ // 最大ページ数分リンクを作成
        if ($i == $now) {               // 現在表示中のページ数の場合はリンクを貼らない
            echo $now. '　'; 
        } else {   
            echo '<a href=http://oshko03.php.xdomain.jp/daily/index.php?page_id='. $i. ' >'. $i. '</a>'. '　';
        }
    }

    $dbh = null;
// }

?>
</div>









</body>


</head>




</html>