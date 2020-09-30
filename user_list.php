<?php

session_start();

var_dump($_POST);
require_once "function.php";

var_dump($_SESSION);

?>

<?php
$dsn = "mysql:dbname=EC-site;localhost;charaset=utf8";
$user = "root";
$password = "";

// 変数の初期化
$sql = null;
$row = null;
$db = null;

try{
  // DBへ接続
	$db = new PDO($dsn, $user, $password);
	echo "接続成功<br>";

  // SQL文を作成
  $sql = 'SELECT * FROM users' ;
  // クエリ実行（データを取得）
  $row = $db -> query($sql);
  // 上記SQLを実行すると$rowに取得したデータが格納される。
  // もしクエリの実行に成功したらPDOStatementオブジェクトが入り、失敗したらfalseが入る。

  $stmh = $db->prepare($sql);
  $stmh->execute();
  $image = $stmh->fetch();

	// //レコード件数取得
  $row_count = $row->rowCount();



  }catch (PDOException $e){
    echo "接続失敗:" .$e->getMessage(). "\n";
    exit();
  }

  // ログアウト機能
  if (isset($_POST['logout'])) {
    unset($_SESSION['id']);
    header("Location: login.php");
    exit();
  }

  if (isset($_SESSION['id'])) {//ログインしているとき
    $userName = $_SESSION['name'];
  }

  if(isset($_POST["detail"])) {
    // var_dump($_POST);
    // exit;
    if(isset($_POST)) {
      $_SESSION = $_POST;
      // var_dump($_SESSION);
      // exit;
      header("Location: product_detail.php");
      exit();
    }else{
      header("Location: product_list.php");
    }
  }

?>

<!DOCTYPE html>
<html>
  <body align="center">
  <br>
  <br>
  <form action="" method="post"><br>
    <h1>ユーザー一覧</h1>
    <table border="2" align="center" height="70">

    レコード件数：<?php echo $row_count; ?><br>
    <tr bgcolor="yellow">
      <th width="170" >名前</th>
      <th width="200">住所</th>
      <th width="280">メールアドレス</th>
      <th width="170">パスワード</th>
    </tr>
    <?php
    while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
    ?>
    <tr height="50">
        <th><?=htmlspecialchars($row['name'])?></th>
        <th><?=htmlspecialchars($row['address'])?></th>
        <th><?=htmlspecialchars($row['email'])?></th>
        <th><?=htmlspecialchars($row['password'])?></th>
        <td>
          <form action="delete_complete.php" method="post">
          <input type="submit" value="削除" onclick="return confirm('削除してよろしいですか？')">
          <input type="hidden" name="id" value="<?=$row['id']?>">
          </form>
        </td>
        <td>
          <form action="edit.php" method="post">
          <input type="submit" value="修正">
          <input type="hidden" name="id" value="<?=$row['id']?>">
          <input type="hidden" name="name" value="<?=$row['name']?>">
          <input type="hidden" name="email" value="<?=$row['email']?>">
          </form>
    </tr>
  <?php
    }
    // $pdo = null;
  ?>
    </table>
      <form action="" method="post">
        <br><br>
        <input type="submit" name="logout" value="ログアウト">
        <input type="button" onclick="location.href='product_register.php';" value="商品登録画面へ">
        <input type="button" onclick="location.href='product_list.php';" value="商品一覧画面へ">
      </form>
  </body>
</html>