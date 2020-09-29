<?php

session_start();

// require_once "function.php";
// unlogined_session();

if(!isset($_SESSION)) {
  header("Location: product_register.php");
  exit();
// } else {
//   $productName = $_SESSION["p_name"];
//   $image = $_SESSION["image"];
//   $introduction = $_SESSION["introduction"];
//   $price = $_SESSION["price"];
}

?>

<!DOCTYPE html>
<html>
  <body align="center">
    <h1>商品登録(確認)</h1>
    <form action="product_complete.php" method="post" align="center">
      <h3>商品名</h3>
      <?php echo (htmlspecialchars($_SESSION['p_name'], ENT_QUOTES, "UTF-8")); ?><br>
      <h3>紹介文</h3>
      <?php echo (htmlspecialchars($_SESSION['introduction'], ENT_QUOTES, "UTF-8")); ?><br>
      <h3>価格</h3>
      <?php echo (htmlspecialchars($_SESSION['price'], ENT_QUOTES, "UTF-8")); ?><br>
      <h3>商品画像</h3>
      <?php echo (htmlspecialchars($_SESSION['image'], ENT_QUOTES, "UTF-8")); ?><br>
      <br>
      <input type="button" onclick="history.back();" value="戻る">
      <input type="submit" name="send" value="送信">
    </form>
  </body>
</html>