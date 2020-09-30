<?php
session_start();

var_dump($_SESSION);
// var_dump($_SESSION['id']);
var_dump($_POST);
var_dump($_FILES);
// exit;

require_once "function.php";
$error = validation_2();
unlogined_session();

if(isset($_POST["send"])) {
  // var_dump($_POST);
  // exit;
  // var_dump($_FILES['image']['name']);
  // exit;
  // var_dump($_FILES);exit;
  $tempfile = $_FILES['image']['tmp_name'];
  //アップロード画像の移動先
  $filemove = '/Applications/XAMPP/xamppfiles/htdocs/EC-site/img/' . $_FILES['image']['name'];
  // var_dump($_FILES);exit;
  // var_dump($filemove);

  //move_uploaded_file関数を使って、アップロードした画像を指定した場所に移動させる
  move_uploaded_file($tempfile , $filemove );

  // if(empty($error)) {
  if(empty($error) && $_FILES['image']['name'] !== "") {
    $_SESSION = $_POST;
    $_SESSION['image'] = $_FILES['image']['name'];
    header("Location: product_confirm.php");
    exit();
  }
}


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
<!-- <form action="" method="POST"> -->
<form action="" method="post" enctype="multipart/form-data">
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
  <h3>紹介文:</h3>
  <input type="text" name="introduction" value="<?php if(!empty($_POST)){echo(htmlspecialchars($_POST['introduction'],ENT_QUOTES));} ?>" />
  <span style="color:red;">
  <?php
    if(!empty($error[1])) {
      echo $error[1];
    }
  ?>
  </span>
  <h3>価格:</h3>
  <input type="text" name="price" value="<?php if(!empty($_POST)){echo(htmlspecialchars($_POST['price'],ENT_QUOTES));} ?>" />
  <span style="color:red;">
  <?php
    if(!empty($error[2])) {
      echo $error[2];
    }
  ?>
  </span>
  <h3>商品画像:</h3>
    <input type="file" name="image" accept="image/*" value="<?php if(!empty($_FILES)){echo(htmlspecialchars($_FILES['image'],ENT_QUOTES));} ?>"><br>
  <span style="color:red;">
  <?php
    if(!empty($error[3])) {
      echo $error[3];
    }
  ?>
  </span>
  <br>
  <br>
  <input type="button" onclick="history.back();" value="戻る">
  <input type="submit" name="send" value="登録">
  <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

  </form>
  </body>
  </html>