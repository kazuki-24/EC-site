product_detail

<?php

var_dump($_POST);
// exit;
session_start();
// var_dump($_POST);
// var_dump($_SESSION);
// exit;
require_once "function.php";
unlogined_session();
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
  $sql = 'SELECT * FROM products' ;
  // クエリ実行（データを取得）
  $row = $db -> query($sql);
  // 上記SQLを実行すると$rowに取得したデータが格納される。
  // もしクエリの実行に成功したらPDOStatementオブジェクトが入り、失敗したらfalseが入る。

  $stmh = $db->prepare($sql);
  $stmh->execute();
  $image = $stmh->fetch();

	// //レコード件数取得
  $row_count = $row->rowCount();
  var_dump($row);


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

  // if (isset($_SESSION['id'])) {//ログインしているとき
  //   $userName = $_SESSION['name'];
  // }

  // if(isset($_POST["cartin"])) {
  //   // var_dump($_POST);
  //   // exit;
  //   if(isset($_POST)) {
  //     var_dump($_POST);
  //     // exit;
  //     // $_SESSION = $_POST;
  //     // var_dump($_SESSION);
  //     // exit;
  //     header("Location: product_list.php");
  //     exit();
  //   }else{
  //     header("Location: product_detail.php");
  //   }
  // }

?>

<!DOCTYPE html>
<html>
  <body align="center">
  <form action="" method="post"><br>
    <h1>商品詳細</h1><br><br>
    <table border="2" align="center" height="70">
    <tr bgcolor="#049993">
      <th width="170" >商品名</th>
      <th width="200">画像</th>
      <th width="280">紹介文</th>
      <th width="170">価格</th>
    </tr>
    <tr height="50">
      <th ><?= $_SESSION['p_name'] ?></th>
      <th ><img src="img/<?php echo $_SESSION['image']; ?>" width="210" height="210"></th>
      <th ><?= $_SESSION['introduction'] ?></th>
      <th ><?= $_SESSION['price'] ?></th>
      <td>
        <form action="" method="post">
        <input type="submit" name="cartin" value="カートに入れる">
        <input type="hidden" name="p_id" value="<?=$row['p_id']?>">
        <input type="hidden" name="p_name" value="<?=$row['p_name']?>">
        <input type="hidden" name="image" value="<?=$row['image']?>">
        <input type="hidden" name="introduction" value="<?=$row['introduction']?>">
        <input type="hidden" name="price" value="<?=$row['price']?>">
        <input type="button" onclick="history.back();" value="戻る">
        </form>
      </td>
    </tr>
    </table>
  </body>
</html>