<?php

session_start();

if (!empty($_SESSION["name"])) {
  $userName = $_SESSION["name"];
}
if (!empty($_SESSION["address"])) {
  $address = $_SESSION["address"];
}
if (!empty($_SESSION["email"])) {
  $email = $_SESSION["email"];
}
if (!empty($_SESSION["password"])) {
  $password = $_SESSION["password"];
}

require_once "pdo_contact.php";
$db = connection();

$sql = "INSERT INTO users(id, name, address, email, password)VALUES(NULL, '$userName', '$address', '$email', '$password')";

$stmt = $db->prepare($sql);
$stmt->bindParam(':userName', $userName, PDO::PARAM_STR);
$stmt->bindParam(':address', $address, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);

$stmt->execute();



?>

<!DOCTYPE html>
<html>
  <body align="center">
    <h1>ユーザー登録(完了)</h1>
    <p>登録が完了しました！</p><br>
    <input type="button" onclick="location.href='login.php';" value="ログイン画面へ">
  </body>
</html>