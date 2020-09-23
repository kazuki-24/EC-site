<?php

function connection() {
  // 1. 接続に必要な3点セットを用意
  $dsn = "mysql:dbname=EC-site;localhost;charaset=utf8";
  $user = "root";
  $password = "";

  // 2.接続できるかチェックする流れ
  try {
      $db = new PDO($dsn, $user, $password);
  // 3-1.接続できたら、"接続成功"と表示する
    echo "接続成功";
  }  catch (PDOException $e) {
  //  3-2.接続失敗したら、"接続失敗"と表示する
    echo "接続失敗:" .$e->getMessage(). "\n";
    exit();
  }

  // 存在しないテーブル名やカラム名をSQL文に持つプリペアドステートメントを発行したとき、エミュレーションOFFの場合はすぐにエラーが発生する
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  // SQLでエラーが起こった際、例外をスローします。
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  return $db;
}


function connection_2() {
  // $_POST['email'] = $email;
  // $_POST['password'] = $password;

  // 1. 接続に必要な3点セットを用意
  $dsn = "mysql:dbname=test;localhost;charaset=utf8";
  $user = "root";
  $password = "";



  // 2.接続できるかチェックする流れ
  try {
      $pass = $_POST['password'];
      $hash =  password_hash($pass, PASSWORD_DEFAULT);

      $db = new PDO($dsn, "$user", "$password");
      $stmt = $db->prepare("INSERT INTO admin (email, hash) VALUES (:email, :hash)");
      $stmt->execute([ ':email'=>$_POST['email'], ':hash'=>$hash ]);
      // $stmt->execute(array(':email' => $_POST['email'],':password' => password_hash($_POST['password'], PASSWORD_DEFAULT)));
      // if(password_verify($_POST['email'], $_POST['password'])){
      //   print '認証成功';
      // }else{
      //   print '認証失敗';
      // }
  //  3-1.接続できたら、"接続成功"と表示する
    echo "接続成功";
  }  catch (PDOException $e) {
  //  3-2.接続失敗したら、"接続失敗"と表示する
    echo "接続失敗:" .$e->getMessage(). "\n";
    exit();
  }

  // 存在しないテーブル名やカラム名をSQL文に持つプリペアドステートメントを発行したとき、エミュレーションOFFの場合はすぐにエラーが発生する
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  // SQLでエラーが起こった際、例外をスローします。
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  return $db;
}


function connection_3() {
  // 1. 接続に必要な3点セットを用意
  $dsn = "mysql:dbname=test;localhost;charaset=utf8";
  $user = "root";
  $password = "";

  $db['host'] = "localhost";  // DBサーバのURL
  $db['user'] = "hogeUser";  // ユーザー名
  $db['pass'] = "hogehoge";  // ユーザー名のパスワード
  $db['dbname'] = "test";  // データベース名

  // エラーメッセージの初期化
  $errorMessage = "";

  // ログインボタンが押された場合
  if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["email"])) {
      $errorMessage = 'Emailが未入力です。';
    } else if (empty($_POST["password"])) {
      $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
      // 入力したユーザIDを格納
      $email = $_POST["email"];

      // 2. Emailとパスワードが入力されていたら認証する
      $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);


        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare('SELECT * FROM userData WHERE name = ?');
            $stmt->execute(array($userid));

            $password = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['id'];
                    $sql = "SELECT * FROM userData WHERE id = $id";  //入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['name'];  // ユーザー名
                    }
                    $_SESSION["NAME"] = $row['name'];
                    header("Location: Main.php");  // メイン画面へ遷移
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }
    }
  }


  // 2.接続できるかチェックする流れ
  // try {
  //     $db = new PDO($dsn, "$user", "$password");

  //     $stmt = $db->prepare('SELECT * FROM admin WHERE email = :email');
  //     $stmt->execute(array(':email' => $_POST['email']));
  //     $result = $stmt->fetch(PDO::FETCH_ASSOC);

  //     ログイン認証
      // if(password_verify($_POST['password'], $result['password'])){
      //   echo "ログイン認証に成功しました";
      // }else{
      //   echo "ログイン認証に失敗しました";
      // }
      // if(password_verify($_POST['email'], $_POST['password'])){
      //   print '認証成功';
      // }else{
      //   print '認証失敗';
      // }

  //  3-1.接続できたら、"接続成功"と表示する
    // echo "接続成功";
  // }  catch (PDOException $e) {
  // //  3-2.接続失敗したら、"接続失敗"と表示する
  //   echo "接続失敗:" .$e->getMessage(). "\n";
  //   exit();
  // }

  // // 存在しないテーブル名やカラム名をSQL文に持つプリペアドステートメントを発行したとき、エミュレーションOFFの場合はすぐにエラーが発生する
  // $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  // // SQLでエラーが起こった際、例外をスローします。
  // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // return $db;
}

?>







