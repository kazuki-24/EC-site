<?php
// var_dump($_POST);
session_start();

// require_once "function.php";
// unlogined_session();

var_dump($_SESSION);

if(!isset($_SESSION)) {
  header("Location: user_register.php");
  exit();
} else {
  $userName = $_SESSION["name"];
  $address = $_SESSION["address"];
  $email = $_SESSION["email"];
  $password = $_SESSION["password"];
}
?>

<!DOCTYPE html>
<html>
  <body align="center">
    <h1>ユーザー登録(確認)</h1>
    <form action="user_complete.php" method="post" align="center">
      <h3>氏名</h3>
      <?php echo (htmlspecialchars($_SESSION["name"], ENT_QUOTES, "UTF-8")); ?><br>
      <h3>住所</h3>
      <?php echo (htmlspecialchars($_SESSION["address"], ENT_QUOTES, "UTF-8")); ?><br>
      <h3>メールアドレス</h3>
      <?php echo (htmlspecialchars($_SESSION["email"], ENT_QUOTES, "UTF-8")); ?><br>
      <h3>password</h3>
      <?php echo (htmlspecialchars($_SESSION["password"], ENT_QUOTES, "UTF-8")); ?><br>
      <br>
      <input type="button" onclick="history.back();" value="戻る">
      <input type="submit" value="送信">
    </form>
  </body>
</html>