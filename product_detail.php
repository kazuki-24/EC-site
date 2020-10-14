<?php

session_start();
// var_dump($_POST['p_id']);
// exit;
var_dump($_SESSION['p_id']);
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
    unset($_SESSION['products']);
    header("Location: login.php");
    exit();
  }


  // $p_id = $_SESSION['id'];
  // $_SESSION['cart'][$p_id] = array('p_id'=>$_POST['p_id'],'number'=>$_POST['num']);


  // var_dump($_SESSION['cart']);
  // exit;

  // if (isset($_SESSION['id'])) {//ログインしているとき
  //   $userName = $_SESSION['name'];
  // }
  $product_id = isset($_POST['p_id'])? htmlspecialchars($_POST['p_id'], ENT_QUOTES, 'utf-8') : '';
  $p_name = isset($_POST['p_name'])? htmlspecialchars($_POST['p_name'], ENT_QUOTES, 'utf-8') : '';
  $image = isset($_POST['image'])? htmlspecialchars($_POST['image'], ENT_QUOTES, 'utf-8') : '';
  $introduction = isset($_POST['introduction'])? htmlspecialchars($_POST['introduction'], ENT_QUOTES, 'utf-8') : '';
  $price = isset($_POST['price'])? htmlspecialchars($_POST['price'], ENT_QUOTES, 'utf-8') : '';
  $count = isset($_POST['count'])? htmlspecialchars($_POST['count'], ENT_QUOTES, 'utf-8') : '';

  // var_dump($product_id);
  // var_dump($p_name);
  // var_dump($image);
  // var_dump($introduction);
  // var_dump($price);
  // var_dump($count);
  // exit;

  // if(isset($_POST["cartin"])) {
    // var_dump($_POST);
    // exit;
    // if(isset($_POST)) {
      // var_dump($_POST);
      // exit;
      // $_SESSION = $_POST;
      // var_dump($_SESSION);
      // exit;
      // header("Location: product_detail.php");
      // exit();

    if(isset($_SESSION['products'])){
      $products = $_SESSION['products'];
      foreach($products as $key => $product){
        if($key == $p_name){
          $count = (int)$count + (int)$product['count'];
        }
      }
    }

    // カートの状態を確認（入っているか入っていないか）
    if($p_name != '' && $image != '' && $introduction != '' && $price != '' && $count != ''){
      $_SESSION['products'][$p_name]=[
                'product_id' => $product_id,
                'image' => $image,
                'introduction' => $introduction,
                'price' => $price,
                'count' => $count
      ];
      echo "カートに商品が入りました！";
    }else{
      echo "まだカートに商品が入っていません";
      // header("Location: product_detail.php");
    }
  // }

  $products = isset($_SESSION['products'])? $_SESSION['products']:[];

  // var_dump($products);
  // exit;


  // if(isset($products)){
  //   foreach($products as $key => $product){
  //     echo $key;      //商品名
  //     echo "<br>";
  //     echo $product['count'];  //商品の個数
  //     echo "<br>";
  //     echo $product['price']; //商品の金額
  //     echo "<br>";
  //   }
  // }

?>

<!DOCTYPE html>
<html>
  <body align="center">
  <form action="" method="post"><br>
    <h1>商品詳細</h1><br><br>
    <table border="2" align="center" height="70">
    <tr bgcolor="greenyellow">
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
      <form action="" method="POST" >
      <!-- <input type="hidden" name="p_name" value="バナナ">
        <input type="hidden" name="price" value="500">
        <input type="text" value="1" name="count"> -->
        <input type="hidden" name="p_id" value="<?=$_SESSION['p_id']?>">
        <input type="hidden" name="p_name" value="<?=$_SESSION['p_name']?>">
        <input type="hidden" name="image" value="<?=$_SESSION['image']?>">
        <input type="hidden" name="introduction" value="<?=$_SESSION['introduction']?>">
        <input type="hidden" name="price" value="<?=$_SESSION['price']?>">
        <input type="text" name="count" value="">
        <button type="submit" class="btn-sm btn-blue">カートに入れる</button>
      </form>
      <input type="button" onclick="location.href='product_list.php';" value="商品一覧へ">
        <!-- <form action="" method="post"> -->
          <!-- <input type="hidden" name="p_id" value="<?=$row['p_id']?>">
          <input type="hidden" name="p_name" value="<?=$row['p_name']?>">
          <input type="hidden" name="image" value="<?=$row['image']?>">
          <input type="hidden" name="introduction" value="<?=$row['introduction']?>">
          <input type="hidden" name="price" value="<?=$row['price']?>"> -->
          <!-- <input type="submit" name="cartin" value="カートに入れる" width="210"> -->
        <!-- </form> -->
      </td>
    </tr>
    </table>
  </body>
</html>