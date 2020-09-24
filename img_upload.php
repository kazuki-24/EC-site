<?php
  if(isset($_POST["send"])) {
    $tempfile = $_FILES['image']['tmp_name'];
    //アップロード画像の移動先
    $filemove = '/Applications/XAMPP/xamppfiles/htdocs/upload_test/img/' . $_FILES['image']['name'];
    // var_dump($_FILES);exit;
    //move_uploaded_file関数を使って、アップロードした画像を指定した場所に移動させる
    move_uploaded_file($tempfile , $filemove );
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  <h1>画像アップロード</h1>
  <form action="" method="post" enctype="multipart/form-data">
    画像<br>
   <input type="file" name="image"><br><br>
   <input type="submit" value="画像アップロード" name="send">
  </form>
</body>
</html>