<?php

session_start();

var_dump($_SESSION['name']);
var_dump($_SESSION['id']);

// $_SESSION["name"] = $_POST["name"]

// require_once "function.php";
// unlogined_session();

// if (!empty($_SESSION["name"])) {
//   $name = $_SESSION["name"];
// }
// if (!empty($_SESSION["email"])) {
//   $email = $_SESSION["email"];
// }
// if (!empty($_SESSION["password"])) {
//   $password = $_SESSION["password"];
// }

// if(!isset($_SESSION)) {
//   header("Location: admin_register.php");
//   exit();
// }

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
  $sql = 'SELECT * FROM products';
  // クエリ実行（データを取得）
  $row = $db -> query($sql);
  // 上記SQLを実行すると$rowに取得したデータが格納される。
  // もしクエリの実行に成功したらPDOStatementオブジェクトが入り、失敗したらfalseが入る。

  $stmh = $db->prepare($sql);
  $stmh->execute();
	// //レコード件数取得
  $row_count = $row->rowCount();
  var_dump($row);
  // 取得したデータを出力
  // foreach( $row as $r ) {
  //   // var_dump($r);
  //   echo "$r[1]<br>";
  //   echo "$r[2]<br>";
  // }
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
?>

<!DOCTYPE html>
<html>
  <body align="center">
  <br>
  <br>
  <h3>ユーザー名</h3>
  <?php echo $userName; ?> さん
  <form action="" method="post"><br>
    <input type="submit" name="logout" value="ログアウト">
    <input type="button" name="confirm" value="カートの中身を確認する" onclick="location.href='cart.php';"><br><br><br>


    <h1>登録商品一覧</h1>
    <table border="2" align="center" height="70">

    レコード件数：<?php echo $row_count; ?><br>
    <tr bgcolor="yellow">
      <th width="170" >商品名</th>
      <th width="200">画像</th>
      <th width="280">紹介文</th>
      <th width="170">価格</th>
    </tr>
    <?php
    while($row = $stmh->fetch(PDO::FETCH_ASSOC)){
    ?>
    <tr height="50">
      <th ><?=htmlspecialchars($row['p_name'])?></th>
      <th ><?=htmlspecialchars($row['image'])?></th>
      <th ><?=htmlspecialchars($row['introduction'])?></th>
      <th ><?=htmlspecialchars($row['price'])?></th>
      <td>
        <form action="product_detail.php" method="post">
        <input type="submit" value="詳細">
        <input type="hidden" name="id" value="<?=$row['id']?>">
        </form>
      </td>
    </tr>
  <?php
    }
    // $pdo = null;
  ?>
    </table>
  </body>
</html>