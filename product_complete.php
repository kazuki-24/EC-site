<?php

session_start();

var_dump($_SESSION);
// exit;
require_once "function.php";
unlogined_session();

if (!empty($_SESSION["p_name"])) {
  $productName = $_SESSION["p_name"];
}
if (!empty($_SESSION["image"])) {
  $image = $_SESSION["image"];
}
if (!empty($_SESSION["introduction"])) {
  $introduction = $_SESSION["introduction"];
}
if (!empty($_SESSION["price"])) {
  $price = $_SESSION["price"];
}

require_once "pdo_contact.php";
$db = connection();

$sql = "INSERT INTO products(id, p_name, image, introduction, price)VALUES(NULL, '$productName', '$image', '$introduction', '$price')";

$stmt = $db->prepare($sql);
$stmt->bindParam(':productName', $productName, PDO::PARAM_STR);
$stmt->bindParam(':image', $image, PDO::PARAM_STR);
$stmt->bindParam(':introduction', $introduction, PDO::PARAM_STR);
$stmt->bindParam(':price', $price, PDO::PARAM_STR);

$stmt->execute();

?>

<!DOCTYPE html>
<html>
  <!-- <body align="center"> -->
  <form action="" method="post" align="center">
    <h1>商品登録(完了)</h1>
    <p>登録が完了しました！</p><br>
    <input type="button" onclick="location.href='product_list.php';" value="商品一覧へ">
  </body>
</html>