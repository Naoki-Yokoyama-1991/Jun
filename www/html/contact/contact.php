<?php
//エスケープ処理やデータチェックを行う関数のファイルの読み込み
require 'functions.php';

//POSTされたデータを変数に格納（値の初期化とデータの整形：前後にあるホワイトスペースを削除）
$name = trim(filter_input(INPUT_POST, 'name'));
$tel = trim(filter_input(INPUT_POST, 'tel'));
// $subject = trim(filter_input(INPUT_POST, 'subject'));
$email = trim(filter_input(INPUT_POST, 'email'));
$postCode = trim(filter_input(INPUT_POST, 'postCode'));
$address = trim(filter_input(INPUT_POST, 'address'));
$body = trim(filter_input(INPUT_POST, 'body'));

$subject = 1111;

?>

<?php
//送信ボタンが押された場合の処理if
if (isset($_POST['submitted'])) {



    //POSTされたデータをチェック
    $_POST = checkInput($_POST);
    //エラーメッセージを保存する配列の初期化
    $error = array();

    //エラーがなく且つ POST でのリクエストの場合
    if (empty($error) && $_SERVER['REQUEST_METHOD']==='POST') {
        //メールアドレス等を記述したファイルの読み込み
        require 'mailvars.php';


        //メール本文の組み立て
        $mail_body .=  "お名前： " .h($name) . "\n";
        $mail_body .=  "Email： " . h($email) . "\n"  ;
        $mail_body .=  "お電話番号： " . h($tel) . "\n\n" ;
        $mail_body .=  "＜お問い合わせ内容＞" . "\n" . h($body);


        //--------sendmail------------


        //メールの宛先（名前<メールアドレス> の形式）。値は mailvars.php に記載
        $mailTo = mb_encode_mimeheader(MAIL_TO_NAME) . "<" . MAIL_TO. ">";

        //Return-Pathに指定するメールアドレス
        $returnMail = MAIL_RETURN_PATH;
        
        //mbstringの日本語設定
        mb_language("Ja");
        mb_internal_encoding("UTF-8");

        // 送信者情報（From ヘッダー）の設定
        $header = "From" . mb_encode_mimeheader($name) . "<" . $email. ">\n";
        $header .= "Cc: " . mb_encode_mimeheader(MAIL_CC_NAME) ."<" . MAIL_CC.">\n";
        $header .= "Bcc: <" . MAIL_BCC.">";
        $result = mb_send_mail($mailTo, $subject, $mail_body, $header);

        //メールの送信
        //メールの送信結果を変数に代入
        if (ini_get('safe_mode')) {
            //セーフモードがOnの場合は第5引数が使えない
            $result = mb_send_mail($mailTo, $subject, $mail_body, $header);
        } else {
            $result = mb_send_mail($mailTo, $subject, $mail_body, $header, '-f' . $returnMail);
        }

        //メール送信の結果判定
        if ($result) {
            $_POST = array(); ////空の配列を代入し、すべてのPOST変数を消去
            //変数の値も初期化
            $name = '';
            $email = '';
            $tel = '';
            $subject = '';
            $body = '';

            //再読み込みによる二重送信の防止
            $params = '?result='. $result;
            //サーバー変数 $_SERVER['HTTPS'] が取得出来ない環境用
            if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) and $_SERVER['HTTP_X_FORWARDED_PROTO'] === "https") {
                $_SERVER['HTTPS'] = 'on';
            }
            $url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
            header('Location:' . $url . $params);
            exit;
        }
    }
}