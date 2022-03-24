<?php
//エスケープ処理やデータチェックを行う関数のファイルの読み込み
require 'libs/functions.php';

//POSTされたデータを変数に格納（値の初期化とデータの整形：前後にあるホワイトスペースを削除）
$name = trim(filter_input(INPUT_POST, 'name'));
$tel = trim(filter_input(INPUT_POST, 'tel'));
// $subject = trim(filter_input(INPUT_POST, 'subject'));
$email = trim(filter_input(INPUT_POST, 'email'));
$postCode = trim(filter_input(INPUT_POST, 'postCode'));
$address = trim(filter_input(INPUT_POST, 'address'));
$body = trim(filter_input(INPUT_POST, 'body'));
$subject = filter_input(INPUT_POST, 'subject');
?>

<?php
//送信ボタンが押された場合の処理if
if (isset($_POST['submitted'])) {

    //POSTされたデータをチェック
    $_POST = checkInput($_POST);

    //エラーメッセージを保存する配列の初期化
    $error = array();
    //値の検証
    if ($name == '') {
        $error['name'] = '*お名前は必須項目です。';
    //制御文字でないことと文字数をチェック
    } elseif (preg_match('/\A[[:^cntrl:]]{1,30}\z/u', $name) == 0) {
        $error['name'] = '*お名前は30文字以内でお願いします。';
    }
    if ($email == '') {
        $error['email'] = '*メールアドレスは必須です。';
    } else { //メールアドレスを正規表現でチェック
        $pattern = '/\A([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}\z/uiD';
        if (!preg_match($pattern, $email)) {
            $error['email'] = '*メールアドレスの形式が正しくありません。';
        }
    }
    if ($tel != '' && preg_match('/\A\(?\d{2,5}\)?[-(\.\s]{0,2}\d{1,4}[-)\.\s]{0,2}\d{3,4}\z/u', $tel) == 0) {
        $error['tel'] = '*電話番号の形式が正しくありません。';
    }
    if ($subject == '') {
        $error['subject'] = '*件名は必須項目です。';
    //制御文字でないことと文字数をチェック
    } elseif (preg_match('/\A[[:^cntrl:]]{1,50}\z/u', $subject) == 0) {
        $error['subject'] = '*件名は50文字以内でお願いします。';
    }
    if ($body == '') {
        $error['body'] = '*内容は必須項目です。';
    //制御文字（タブ、復帰、改行を除く）でないことと文字数をチェック
    } elseif (preg_match('/\A[\r\n\t[:^cntrl:]]{1,300}\z/u', $body) == 0) {
        $error['body'] = '*内容は300文字以内でお願いします。';
    }


    //エラーがなく且つ POST でのリクエストの場合
    if (empty($error) && $_SERVER['REQUEST_METHOD']==='POST') {
        //メールアドレス等を記述したファイルの読み込み
        require 'libs/mailvars.php';


        //メール本文の組み立て
        $mail_body .=  "件名： " .h($subject) . "\n";
        $mail_body .=  "お名前： " .h($name) . "\n";
        $mail_body .=  "お電話番号： " . h($tel) . "\n\n" ;
        $mail_body .=  "メールアドレス： " . h($email) . "\n"  ;
        $mail_body .=  "郵便番号： " . h($postCode) . "\n"  ;
        $mail_body .=  "住所： " . h($address) . "\n"  ;
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
?>