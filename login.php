<?php
session_start();

// 以下暗号化なしパターン
//①エラーメッセージの初期状態を空に
$err_msg = "";
//②loginサブミットボタンが押されたときの処理
if (isset($_POST['login'])) {
  // var_dump($_POST);
  // exit;
  // ログイン時の入力内容を変数に代入
  $email = $_POST['email'];
  $password = $_POST['password'];
  // DB接続に必要な情報をセット
  $dsn = "mysql:dbname=EC-site;localhost;charaset=utf8";
  $user = "root";
  $pass = "";
  //③データが渡ってきた場合の処理
  try {
    $db = new PDO($dsn, $user , $pass );
    // echo "接続成功";
    // exit;
    $sql = 'SELECT * FROM users where email=? and password=?';
    $stmt = $db->prepare($sql);
    $stmt->execute(array($email,$password));
    $result = $stmt->fetchAll();
    // var_dump($result);
    // var_dump($result[0]['id']);
    // exit;
    $_SESSION['id'] = $result[0]['id'];
    $_SESSION['name'] = $result[0]['name'];
    // 以下DB認証
    // emailとpasswordどちらも入力されている場合
    if(!empty($_POST["email"]) && !empty($_POST["password"])) {
      // 照合成功の場合
      if($_POST["email"] == $result[0]["email"] && $_POST["password"] == $result[0]["password"] ) {
        header("Location: product_list.php");
        exit();
      // 照合失敗の場合
      } else {
        $error_message = "ID、もしくはパスワードが間違っています。もう一度入力して下さい。";
        echo $error_message;
        exit();
      }
    // emailとpasswordどちらか1つでも未入力の場合
    } else {
      $error_message = "未入力箇所があります。もう一度入力して下さい。";
      echo $error_message;
      exit();
    }
  }catch (PDOExeption $e) {
    echo $e->getMessage();
    exit;
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
<body>
<form action="" method="POST" align="center">
  <h1>ログインページ</h1>
  <br>
  <h3>Email:</h3>
  <input type="text" name="email" value="<?php if(!empty($_POST)){echo(htmlspecialchars($_POST['email'],ENT_QUOTES));} ?>" />
  <span style="color:red;">
  <?php
    // echo $errorMessage;
    if(!empty($error[1])) {
      echo $error[1];
    }
  ?>
  </span>
  <br>
  <br>
  <h3>Password:</h3>
  <input type="text" name="password" value="<?php if(!empty($_POST)){echo(htmlspecialchars($_POST['password'],ENT_QUOTES));} ?>" />
  <span style="color:red;">
  <?php
    if(!empty($error[2])) {
      echo $error[2];
    }
  ?>
  </span>
  <br>
  <br>
  <br>
  <input type="button" onclick="history.back();" value="戻る">
  <input type="submit" name="login" value="ログイン">
</form>
</body>
</html>