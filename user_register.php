<?php
session_start();

var_dump($_POST);

require_once "function.php";
$error = validation();
var_dump($error);

// // unlogined_session();

// if(isset($_POST['sent'])) {
//   header("Location: user_list.php");
//   exit();
// }



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
  <h1>管理者登録</h1>
  <br>
  <h3>氏名:</h3>
  <input type="text" name="name" value="<?php if(!empty($_POST)){echo(htmlspecialchars($_POST['name'],ENT_QUOTES));} ?>" />
  <span style="color:red;">
  <?php
    if(!empty($error[0])) {
      echo $error[0];
    }
  ?>
  </span>
  <h3>住所:</h3>
  <input type="text" name="address" value="<?php if(!empty($_POST)){echo(htmlspecialchars($_POST['address'],ENT_QUOTES));} ?>" />
  <span style="color:red;">
  <?php
    if(!empty($error[1])) {
      echo $error[1];
    }
  ?>
  </span>
  <h3>メールアドレス:</h3>
  <input type="text" name="email" value="<?php if(!empty($_POST)){echo(htmlspecialchars($_POST['email'],ENT_QUOTES));} ?>" />
  <span style="color:red;">
  <?php
    if(!empty($error[2])) {
      echo $error[2];
    }
  ?>
  </span>
  <h3>パスワード:</h3>
  <input type="text" name="password" value="<?php if(!empty($_POST)){echo(htmlspecialchars($_POST['password'],ENT_QUOTES));} ?>" />
  <span style="color:red;">
  <?php
    if(!empty($error[3])) {
      echo $error[3];
    }
  ?>
  </span>
  <br>
  <br>
  <input type="button" onclick="location.href='login.php';" value="ログインページへ">
  <input type="submit" name="sent" value="登録">
</form>
</body>
</html>