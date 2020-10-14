<?php
session_start();

// var_dump($_SESSION['products']);
// exit;

  // var_dump($_SESSION["id"]);
  // var_dump($_SESSION["name"]);
  // var_dump($_SESSION["address"]);
  // exit;

  if (!empty($_SESSION["id"])) {
    $user_id = $_SESSION["id"];
  }
  if (!empty($_SESSION["address"])) {
    $address = $_SESSION["address"];
  }
  if (!empty($_SESSION["total"])) {
    $total = $_SESSION["total"];
  }
  if (!empty($_SESSION["order_id"])) {
    $order_id = $_SESSION["order_id"];
  }
  if (!empty($_SESSION["p_id"])) {
    $product_id = $_SESSION["p_id"];
  }
  if (!empty($_SESSION["count"])) {
    $count = $_SESSION["count"];
  }

  if (!empty($_SESSION["products"])) {
    $products = $_SESSION["products"];
  }
  // if (!empty($_SESSION["total_count"])) {
  //   $total_count = $_SESSION["total_count"];
  // }
  // var_dump($products);
  // exit;

  // var_dump($_SESSION["total_count"]);
  // var_dump($total_count);
  // exit;





// --------------------------------------------------------------------------------------
  // require_once "pdo_contact.php";
  // $db = connection();

  // $sql = "INSERT INTO orders(id, user_id, address, total)VALUES(NULL, '3', 'D', 'G')";

  // $stmt = $db->prepare($sql);
  // $stmt->bindParam(':user_id', $productName, PDO::PARAM_STR);
  // $stmt->bindParam(':address', $image, PDO::PARAM_STR);
  // $stmt->bindParam(':total', $introduction, PDO::PARAM_STR);

  // $stmt->execute();
// --------------------------------------------------------------------------------------

  // DB接続
  require_once "pdo_contact.php";
  $db = connection();

  // 以下、トランザクション記述--------------------------------------------------------------
  try {
   // トランザクション開始
   $db->beginTransaction();
   //ordersテーブルへのinsert処理を記載
   $sql = "INSERT INTO orders(id, user_id, address, total)VALUES(NULL, '$user_id', '$address', '$total')";

   $stmt = $db->prepare($sql);
   $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
   $stmt->bindParam(':address', $address, PDO::PARAM_STR);
   $stmt->bindParam(':total', $total, PDO::PARAM_STR);

   $stmt->execute();

   //ordersのid取得(lastInsertIdの位置に注意 → $stmt->execute();の後かつcommitの前）
   $order_id = $db->lastInsertId('id');
  //  var_dump($order_id);
  //  exit;

   // コミット(処理成功)
   $db->commit();

  } catch(PDOException $e) {
   // ロールバック(処理失敗:一連の処理を取り消す)
   $db->rollBack();
   // エラーメッセージ出力
   echo $e->getMessage();
  }


  // 以下、トランザクション記述--------------------------------------------------------------
  try {
    // トランザクション開始
    $db->beginTransaction();
    //order_detailテーブルへのinsert処理を記載

    // foreach($array as $value){
    // $array = [NULL,'$order_id','$product_id','$count'];
    // $order_id = array("product_id"=> $product_id ,"count"=> $count );
    // $order_id = array(""=> "");
    // var_dump($products);
    // exit;
    // $products = array("product_id"=>"$product_id" ,"count"=>"$count");
    // var_dump($products);
    // exit;

      // foreach ($val as $values) {
    // foreach ($product_id as $val) {
      // var_dump($products);
      // unset($val);
      // var_dump($val);
      // var_dump($values);
      // echo $val;
      // exit;
      foreach ($products as $val) {
      // unset($values);
      $sql = "INSERT INTO order_detail(id, order_id, product_id, count)VALUES(NULL, '$order_id', '$val[product_id]', '$val[count]')";
      // $sql = "INSERT INTO order_detail(id, order_id, product_id, count)VALUES(NULL, '$order_id', '$product_id', '$count')";

      // $sql = "INSERT INTO order_detail(id, order_id, product_id, count)VALUES(NULL), ('$order_id'), ('$product_id'), ('$count')";
      // var_dump($products);
      // exit;

    // echo $value;
    // exit;
      // unset($val);
      // var_dump($products);
      // exit;
      // }

    // }
  // foreach ($products as $key => $val) {
  //     $order_id   = $product['order_id'];
  //     $product_id   = $product['product_id'];
  //     $count = $product['count'];
  //     $arrayValues[] = "(NULL, '{$order_id}', '{$product_id}', '{$count}')";
  // }
    // var_dump($products);
    // exit;


    $stmt = $db->prepare($sql);
    $stmt->bindParam(':order_id', $order_id, PDO::PARAM_STR);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
    $stmt->bindParam(':count', $count, PDO::PARAM_STR);

    // $order_id = array(''=>'');
    // $order_id = array("product_id"=>"$product_id" ,"count"=>"$count" );
    // $order_detail = array(''=>'');
    // var_dump($order_id);
    // var_dump($order_id);
    // exit;


    // foreachで挿入する値を1つずつループ処理
    // foreach ($product_id as $key => $val) {

      // $stmt->execute(array('$order_id' => $key, ':product_id' => $val));
      // $stmt->execute(array('$order_id' => $key, ':count' => $val));
      // $stmt->execute(array(':order_id' => $key, ':count' => $val));
    // var_dump($id);
    // exit;
    // var_dump($products);
    // exit;
    // ----------------------------------
    // foreach ($products as $val) {

    $stmt->execute();
    // $stmt->execute();
      // echo $val;
    // }
    // var_dump($products);
    // exit;
    // unset($val);
    // unset($products);

  }
    // -------------------------------------



    // // // foreachで挿入する値を1つずつループ処理
    // foreach ($p_name as $key => $val) {

    // // // 連想配列のキーを :order_id に、値を :count にセットし、executeでSQLを実行
    // $stmt->execute();

    // }

 
    // コミット(処理成功)
    $db->commit();
    // var_dump($products);
    // exit;



    unset($_SESSION['products']);

  } catch(PDOException $e) {
    // ロールバック(処理失敗:一連の処理を取り消す)
    $db->rollBack();
    // エラーメッセージ出力
    echo $e->getMessage();
   }

?>

<!DOCTYPE html>
<html>
  <body align="center">
    <h1>注文完了画面</h1><br>
    <p>ご購入ありがとうございました！</p><br>
    <input type="button" onclick="location.href='product_list.php';" value="商品一覧画面に戻る">
  </body>
</html>