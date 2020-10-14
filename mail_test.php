<?php

mb_language("Japanese");
mb_internal_encoding("UTF-8");

//ソースは全部読み込ませる
//パスは自分がPHPMailerをインストールした場所で
//PHPMailerの各種ファイルを読み込む(mail_test.phpから見た相対パスを記載)
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';
require './PHPMailer-master/src/POP3.php';
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/OAuth.php';
require './PHPMailer-master/language/phpMailer.lang-ja.php';

// PHPMailerの使用宣言
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// SMTPの設定
$mailer = new PHPMailer();//インスタンス生成
$mailer->IsSMTP();//SMTPを生成
$mailer->Host = 'smtp.gmail.com';//Gmailを使う場合の設定
$mailer->Charset = 'utf-8';
$mailer->SMTPAuth = TRUE;
$mailer->Username = 'skill.e.k24@gmail.com';//Gmailのユーザー名
$mailer->Password = 'se.0901.st';//Gmailのパスワード
$mailer->IsHTML(false);
$mailer->SMTPSecure = 'tls';//SSLも使用可
$mailer->Port = 587;//tlsは587でOK
$mailer->SMTPDebug = 2;//2は詳細デバッグ1は簡易デバッグ本番はコメントアウト

//メール本体(メール内容の記述)
$to = "sample@sample.co.jp";//送信先
$mailer->From ='skill.e.k24@gmail.com';//差出人の設定
$mailer->SetFrom('skill.e.k24@gmail.com');
$mailer->FromName = mb_convert_encoding("-shop","UTF-8","AUTO");//差し出し人名
$mailer->Subject  = mb_convert_encoding("Order completed","UTF-8","AUTO");//メールのタイトル
$mailer->Body     = mb_convert_encoding("注文が完了しました!","UTF-8","AUTO");//メール本文
$mailer->AddAddress($to);//To宛先

//送信する(メール送信メソッド実行)
if($mailer->Send()){
  echo "送信に成功しました！";
}else{
  echo "送信に失敗しました" . $mailer->ErrorInfo;
}



if( !empty($_POST['determine']) ) {

	$page_flag = 1;

	// 変数とタイムゾーンを初期化
	$auto_reply_subject = null;
	$auto_reply_text = null;
	date_default_timezone_set('Asia/Tokyo');

	// 件名を設定
	$auto_reply_subject = 'お問い合わせありがとうございます。';

	// 本文を設定
	$auto_reply_text = "この度は、お問い合わせ頂き誠にありがとうございます。
下記の内容でお問い合わせを受け付けました。\n\n";
	$auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
	$auto_reply_text .= "氏名：" . $_POST['your_name'] . "\n";
	$auto_reply_text .= "メールアドレス：" . $_POST['email'] . "\n\n";
	$auto_reply_text .= "GRAYCODE 事務局";

	// メール送信
	mb_send_mail( $_POST['email'], $auto_reply_subject, $auto_reply_text);
}

?>