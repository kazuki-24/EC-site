<?php
session_start();

var_dump($_POST);

require_once "function.php";
$error = validation_2();
var_dump($error);
// // unlogined_session();

// require_once "pdo_contact.php";
// $db = connection_2();
?>

<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="form.php" />
<html>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./css/style.css">
  <style>
  h2{
    background-color:#000000;
    color:#FFF;
    padding:10px 0px 10px 10px;
  }
  h3 {
    color:#000;
    display: block;
    font-weight: bold;
}
  input{
    font-size: 20px;
    padding:10px 20px;
    margin: 20px 20px;
  }
</style>
<body align="center">
<form action="" method="POST">
  <h1>商品登録</h1>
  <br>
  <h3>商品名:</h3>
  <input type="text" name="p_name" value="<?php if(!empty($_POST)){echo(htmlspecialchars($_POST['p_name'],ENT_QUOTES));} ?>" />
  <span style="color:red;">
  <?php
    if(!empty($error[0])) {
      echo $error[0];
    }
  ?>
  </span>
  <h3>商品画像:</h3>
  <input type="text" name="image" value="<?php if(!empty($_POST)){echo(htmlspecialchars($_POST['image'],ENT_QUOTES));} ?>" />
  <span style="color:red;">
  <?php
    if(!empty($error[1])) {
      echo $error[1];
    }
  ?>
  </span>
  <h3>紹介文:</h3>
  <input type="text" name="introduction" value="<?php if(!empty($_POST)){echo(htmlspecialchars($_POST['introduction'],ENT_QUOTES));} ?>" />
  <span style="color:red;">
  <?php
    if(!empty($error[2])) {
      echo $error[2];
    }
  ?>
  </span>
  <h3>価格:</h3>
  <input type="text" name="price" value="<?php if(!empty($_POST)){echo(htmlspecialchars($_POST['price'],ENT_QUOTES));} ?>" />
  <span style="color:red;">
  <?php
    if(!empty($error[3])) {
      echo $error[3];
    }
  ?>
  </span>
  <br>
  <br>
  <input type="submit" name="sent" value="登録">
</form>
</body>
</html>