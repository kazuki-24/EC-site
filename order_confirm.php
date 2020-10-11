<!-- 【注文確認画面】 -->

<?php
$delete_p_name = isset($_POST['delete_p_name'])? htmlspecialchars($_POST['delete_p_name'], ENT_QUOTES, 'utf-8') : '';

session_start();

if($delete_p_name != ''){
  unset($_SESSION['products'][$delete_p_name]);
}

// unset($_SESSION);
// var_dump($_POST);
var_dump($_SESSION['products']);
// exit;

require_once "function.php";
unlogined_session();

?>

<?php
// $dsn = "mysql:dbname=EC-site;localhost;charaset=utf8";
// $user = "root";
// $password = "";

// // 変数の初期化
// $sql = null;
// $row = null;
// $db = null;


  if (isset($_SESSION['id'])) {//ログインしているとき
    $userName = $_SESSION['name'];
    $address = $_SESSION['address'];
    // var_dump($_SESSION['address']);
    // var_dump($address);
  }

//  var_dump($_POST);

  // var_dump($address);
  // exit;

  if(isset($_POST["detail"])) {
    var_dump($_POST);

    // var_dump($_POST['id']);
    // exit;
    // $_SESSION = $_POST;
    // var_dump($_SESSION['p_id']);
    // exit;
    if(isset($_POST)) {
      // $_SESSION = $_POST;
      // var_dump($_SESSION);
      // exit;
      // header("Location: product_detail.php");
      // exit();
    }else{
      header("Location: product_list.php");
    }
  }

  if(isset($_POST['determine'])) {
    var_dump($_POST['determine']);
    var_dump($_POST['total']);
    var_dump($_POST['count']);
    var_dump($_POST['total_count']);
    echo "OK";
    // exit;

    $_SESSION['determine'] = $_POST['determine'];
    $_SESSION['total'] = $_POST['total'];
    $_SESSION['count'] = $_POST['count'];
    $_SESSION['total_count'] = $_POST['total_count'];
    // exit;
    header("Location: order_complete.php");
  }

  //合計[個数]の初期値を0とする
  $total_count = 0;
  //合計[金額]の初期値を0とする
  $total = 0;
  $products = isset($_SESSION['products'])? $_SESSION['products']:[];

?>

<!DOCTYPE html>
<html>
  <body align="center">
  <br>
  <br>
  <h3>ユーザー名</h3>
  <?php echo $userName; ?> さん
  <!-- <form action="" method="post"><br> -->
    <h1>注文確認画面</h1><br>
    <h3>以下の内容で注文を確定しますか？</h3>
    <table border="2" align="center" height="70">
    <!-- レコード件数：<?php echo $row_count; ?><br> -->
    <tr bgcolor="#FF77FF">
      <th width="170" >商品名</th>
      <th width="200">画像</th>
      <th width="280">紹介文</th>
      <th width="170">価格</th>
      <th width="170">数量</th>
      <th width="170">小計</th>
    </tr>
    <?php
      foreach($products as $p_name => $product):

              //各商品の個数を取得
              $count = $product['count'];
              //各商品の個数の合計を$total_countに足していく
              $total_count += $count;

              //各商品の小計を取得
              $subtotal = $product['price']*$product['count'];
              //各商品の小計を$totalに足していく
              $total += $subtotal;
    ?>
    <tr height="50">
    <td align="center"><?php echo $p_name; ?></td>
    <th ><img src="img/<?php echo $product['image']; ?>" width="100" height="100"></th>
    <td align="center"><?php echo $product['introduction']; ?></td>
    <td align="center">¥ <?php echo $product['price']; ?></td>
    <td align="center"><?php echo $product['count']; ?></td>
    <td align="center">¥ <?php echo $product['price']*$product['count']; ?></td>
    <br>
        </form>
      </td>
    </tr>
    <?php
      endforeach;
    ?>
    </table>
    <h3>カート全体 合計金額</h3>
    ￥ <?php echo $total; ?>
     (商品合計 <?php echo $total_count; ?> 個)
    <?php
    // $SESSION = $total;

    // var_dump($_SESSION);
    // var_dump($total);
    // var_dump($total);
    // exit;
    ?>
    <h3>住所（配送先）</h3>
    <?php echo $address; ?>
    <h3>支払い方法</h3>
    <?php echo "銀行振込"; ?>
      <form action="" method="post">
        <br><br>
        <input type="button" onclick="history.back();" value="戻る">
        <input type="submit" name="determine" value="確定する">
        <!-- <input type="button" onclick="location.href='order_complete.php';" value="確定する"> -->
        <input type="hidden" name="total" value=<?php echo $total; ?>>
        <input type="hidden" name="count" value=<?php echo $product['count']; ?>>
        <input type="hidden" name="total_count" value=<?php echo $total_count; ?>>
      </form>
  </body>
</html>