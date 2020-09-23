<?php

function validation() {

  $error = array();

  if(!empty($_POST)){
    if(empty($_POST['name'])) {
      $error[0] = "名前を入力してください";
      echo $error[0];
    }
    if(empty($_POST['address'])) {
      $error[1] = "住所を入力してください";
      echo $error[1];
    }
    if(empty($_POST['email'])) {
      $error[2] = "メールアドレスを入力してください";
      echo $error[2];
    }
    if(empty($_POST['password'])) {
      $error[3] = "パスワードを入力してください";
      echo $error[3];
    }
    if(empty($error)) {
      $_SESSION = $_POST;
      header("Location: user_confirm.php");
      exit();
    }
  }
  return $error;
}

function validation_2() {

  $error = array();

  if(!empty($_POST)){
    if(empty($_POST['p_name'])) {
      $error[0] = "商品名を入力してください";
      echo $error[0];
    }
    if(empty($_POST['image'])) {
      $error[1] = "画像を選択してください";
      echo $error[1];
    }
    if(empty($_POST['introduction'])) {
      $error[2] = "紹介文を入力してください";
      echo $error[2];
    }
    if(empty($_POST['price'])) {
      $error[3] = "価格を入力してください";
      echo $error[3];
    }
    if(empty($error)) {
      $_SESSION = $_POST;
      header("Location: product_confirm.php");
      exit();
    }
  }
  return $error;
}





// function validation_2() {

//   $error = array();

//   if(!empty($_POST)){
//     if(empty($_POST['name'])) {
//       $error[0] = "名前を入力してください";
//       echo $error[0];
//     }
//     if(empty($_POST['email'])) {
//       $error[1] = "メールアドレスを入力してください";
//       echo $error[1];
//     }
//     if(empty($_POST['password'])) {
//       $error[2] = "パスワードを入力してください";
//       echo $error[2];
//     }
//     if(empty($error)) {
//       $_SESSION = $_POST;
//       header("Location: list.php");
//       exit();
//     }
//   }
//   return $error;
// }


// function validation_3() {

//   $error = array();

//   if(!empty($_POST)){
//     if(empty($_POST['email'])) {
//       $error[1] = "メールアドレスを入力してください";
//       echo $error[1];
//     }
//     if(empty($_POST['password'])) {
//       $error[2] = "パスワードを入力してください";
//       echo $error[2];
//     }
//     if(empty($error)) {
//       $_SESSION = $_POST;
//       header("Location: list.php");
//       exit();
//     }
//   }
//   return $error;
// }





// $name = htmlspecialchars($_POST['name']);
// $email = htmlspecialchars($_POST['email']);
// $content = htmlspecialchars($_POST['content']);

// validation();

//  echo date("Y.m.d")."<br/>";

// 関数を定義　3文字のテキスト形式　Mon～Sun
// function the_day_of_the_week(){
//   echo date('D')."<br/>\n";
//  }
//  関数を呼び出す
//  the_day_of_the_week();


//  関数を定義　3文字のテキスト形式　Mon～Sun
// function day_of_the_specified_date($specifiedDate){
//   echo date('D', strtotime($specifiedDate))."<br/>\n";
//  }
//  関数を呼び出す
//  day_of_the_specified_date('19850611');



// function logined_session() {
//     // ログインしていればadmin_list.phpに遷移
//     if (isset($_SESSION['id'])) {
//         header("Location: admin_list.php");
//         exit;
//     }
// }

function unlogined_session() {
    // ログインしていなければlogin.phpに遷移
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit;
    }
}



?>