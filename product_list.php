<?php
session_start();

// unset($_SESSION);

// var_dump($_POST);
// var_dump($_SESSION);

require_once "function.php";
unlogined_session();


// unset($_SESSION['p_name']);
// unset($_SESSION['introduction']);
// unset($_SESSION['price']);
// unset($_SESSION['image']);

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
  // var_dump($row);


  }catch (PDOException $e){
    echo "接続失敗:" .$e->getMessage(). "\n";
    exit();
  }

  // ログアウト機能
  if (isset($_POST['logout'])) {
    unset($_SESSION['id']);
    unset($_SESSION['products']);
    header("Location: login.php");
    exit();
  }

  if (isset($_SESSION['id'])) {//ログインしているとき
    $userName = $_SESSION['name'];
  }

//  var_dump($_POST);

  // var_dump($p_id);
  // exit;

  if(isset($_POST["detail"])) {
    var_dump($_POST);

    $_SESSION['p_name'] = $_POST['p_name'];
    $_SESSION['introduction'] = $_POST['introduction'];
    $_SESSION['price'] = $_POST['price'];
    $_SESSION['image'] = $_POST['image'];

    // var_dump($_POST['id']);
    // exit;
    // $_SESSION = $_POST;
    // var_dump($_SESSION['p_id']);
    // exit;
    if(isset($_POST)) {
      // $_SESSION = $_POST;
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
      <th ><img src="img/<?php echo $row['image']; ?>" width="100" height="100"></th>
      <th ><?=htmlspecialchars($row['introduction'])?></th>
      <th ><?=htmlspecialchars($row['price'])?></th>
      <td>
        <form action="" method="post">
        <input type="submit" name="detail" value="詳細">
        <!-- <input type="hidden" name="p_id" value="<?=$row['p_id']?>"> -->
        <input type="hidden" name="p_name" value="<?=$row['p_name']?>">
        <input type="hidden" name="image" value="<?=$row['image']?>">
        <input type="hidden" name="introduction" value="<?=$row['introduction']?>">
        <input type="hidden" name="price" value="<?=$row['price']?>">
        </form>
      </td>
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
        <input type="button" onclick="location.href='user_list.php';" value="ユーザー一覧画面へ">
      </form>
  </body>
</html>