<?php
//エスケープ処理やデータチェックを行う関数のファイルの読み込み
require 'libs/functions.php';
require 'config/recaptcha_vars.php';
// reCAPTCHA サイトキー
$siteKey = V3_SITEKEY;
// reCAPTCHA シークレットキー
$secretKey = V3_SECRETKEY;
//お問い合わせ日時を日本時間に
date_default_timezone_set('Asia/Tokyo');



//POSTされたデータを変数に格納（値の初期化とデータの整形：前後にあるホワイトスペースを削除）
$subject = filter_input(INPUT_POST, 'subject');
$name = trim(filter_input(INPUT_POST, 'name'));
$tel = trim(filter_input(INPUT_POST, 'tel'));
// $subject = trim(filter_input(INPUT_POST, 'subject'));
$email = trim(filter_input(INPUT_POST, 'email'));
$postCode = trim(filter_input(INPUT_POST, 'postCode'));
$address = trim(filter_input(INPUT_POST, 'address'));
$body = trim(filter_input(INPUT_POST, 'body'));
$send = filter_input(INPUT_POST, 'send');
//送信ボタンが押された場合の処理if

//reCAPTCHA トークン
$token = filter_input(INPUT_POST, 'g-recaptcha-response');
//reCAPTCHA アクション名
$action = filter_input(INPUT_POST, 'action');

//reCAPTCHA の検証を通過したかどうかの真偽値
$result_status = false;

//★トークン（$_POST['g-recaptcha-response']）が設定されていれば以下を実行
if (isset($_POST['g-recaptcha-response'])) {
    //POSTされたデータをチェック
    $_POST = checkInput($_POST);
    // トークンとアクション名が取得できれば
    if ($token && $action) {
        //cURL セッションを初期化（API のレスポンスの取得）
        $ch = curl_init();
        // curl_setopt() により転送時のオプションを設定
        //URL の指定
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        //HTTP POST メソッドを使う
        curl_setopt($ch, CURLOPT_POST, true);
        //API パラメータの指定
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
      'secret' => $secretKey,
      'response' => $token
    )));
        //curl_execの返り値を文字列にする
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //転送を実行してレスポンスを $api_response に格納
        $api_response = curl_exec($ch);
        //セッションを終了
        curl_close($ch);
        //レスポンスの $json（JSON形式）をデコード
        $rc_result = json_decode($api_response);
        //判定
        if ($rc_result->success && $rc_result->action === $action && $rc_result->score >= 0.5) {
            //success が true でアクション名が一致し、スコアが 0.5 以上の場合は合格
            $result_status = true;
        } else {
            // 上記以外の場合は 不合格
            $result_status = false;
        }
    }
    //エラーメッセージを保存する配列の初期化
    $error = array();
    //reCAPTCHA 検証（判定結果 $result_status が false ならエラーを表示）
    if (!$result_status) {
        $error['recaptcha'] = '検証が失敗しました。';
    }

    //値の検証
    //名前
    if ($name == '') {
        $error['name'] = '*お名前は必須項目です。';
    //制御文字でないことと文字数をチェック
    } elseif (preg_match('/\A[[:^cntrl:]]{1,30}\z/u', $name) == 0) {
        $error['name'] = '*お名前は30文字以内でお願いします。';
    }
    //email
    if ($subject == "お問い合せ" && $email == '') {
        $error['email'] = '*メールアドレスは必須です。';
    } elseif ($send == "Eメール" && $subject == "資料請求" && $email == '') {
        $error['email'] = '*メールアドレスは必須です。';
    } else { //メールアドレスを正規表現でチェック
        $pattern = '/\A([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}\z/uiD';
        if (!preg_match($pattern, $email)) {
            $error['email'] = '*メールアドレスの形式が正しくありません。';
        }
    }
    //郵便番号：
    if ($postCode) {
        if (!preg_match('/\A\d{3}\d{4}\z/', $postCode)) {
            $error['postCode'] = '*郵便番号の形式が正しくありません。';
        }
    }
    //住所
    if ($send == "ご自宅" && $subject == "資料請求" && $address == '') {
        $error['address'] = '*住所は必須です。';
    } elseif (preg_match('/\A[[:^cntrl:]]{1,50}\z/u', $subject) == 0) {
        $error['address'] = '*住所は50文字以内でお願いします。';
    }
    //電話番号
    if ($tel != '' && preg_match('/\A\(?\d{2,5}\)?[(\.\s]{0,2}\d{1,4}[)\.\s]{0,2}\d{3,4}\z/u', $tel) == 0) {
        $error['tel'] = '*電話番号の形式が正しくありません。';
    }
    //件名
    if ($subject == '') {
        $error['subject'] = '*件名は必須項目です。';
    //制御文字でないことと文字数をチェック
    } elseif (preg_match('/\A[[:^cntrl:]]{1,50}\z/u', $subject) == 0) {
        $error['subject'] = '*件名は50文字以内でお願いします。';
    }
    //お問い合せ
    if ($subject == "お問い合せ" && $body == '') {
        $error['body'] = '*内容は必須項目です。';
    //制御文字（タブ、復帰、改行を除く）でないことと文字数をチェック
    } elseif ($subject == "お問い合せ" && preg_match('/\A[\r\n\t[:^cntrl:]]{1,1050}\z/u', $body) == 0) {
        $error['body'] = '*内容は1000文字以内でお願いします。';
    }

    //エラーがなく且つ POST でのリクエストの場合
    if (empty($error) && $_SERVER['REQUEST_METHOD']==='POST') {
        //メールアドレス等を記述したファイルの読み込み
        require 'libs/mailvars.php';


        //メール本文の組み立て
        //本文
        $mail_body .= $name." 様よりお問い合せがありました。" . "\n\n";
        $mail_body .=  "件名： " .h($subject) . "\n";
        $mail_body .=  "お名前： " .h($name) . "\n";
        $mail_body .=  "お電話番号： " . h($tel) . "\n" ;
        if ($subject == "資料請求") {
            $mail_body .=  "資料送付先： " . h($send) . "\n" ;
        }
        $mail_body .=  "メールアドレス： " . h($email) . "\n"  ;
        $mail_body .=  "郵便番号： " . h($postCode) . "\n"  ;
        $mail_body .=  "住所： " . h($address) . "\n\n"  ;
        $mail_body .=  "＜お問い合せ内容＞" . "\n" . h($body);


        //--------sendmail------------


        //メールの宛先（名前<メールアドレス> の形式）。値は mailvars.php に記載
        $mailTo = mb_encode_mimeheader(MAIL_TO_NAME) . "<" . MAIL_TO. ">";

        //Return-Pathに指定するメールアドレス
        $returnMail = MAIL_RETURN_PATH;

        //mbstringの日本語設定
        mb_language("Ja");
        mb_internal_encoding("UTF-8");

        // 送信者情報（From ヘッダー）の設定
        $header = "From:" . mb_encode_mimeheader($name) . "<" . $email. ">\n";
        $header .= "Cc: " . mb_encode_mimeheader(MAIL_CC_NAME) ."<" . MAIL_CC.">\n";
        $header .= "Bcc: <" . MAIL_BCC.">";
        $header .= "Content-Type: text/plain \r\n";


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
            //自動返信メール
            //ヘッダー情報
            $ar_header = "MIME-Version: 1.0\n";
            // AUTO_REPLY_NAME や MAIL_TO は mailvars.php で定義
            $ar_header .= "From: " . mb_encode_mimeheader(AUTO_REPLY_NAME) . " <" . MAIL_TO . ">\n";
            $ar_header .= "Reply-To: " . mb_encode_mimeheader(AUTO_REPLY_NAME) . " <" . MAIL_TO . ">\n";
            //件名
            $ar_subject = $subject . '自動返信メール';
            //本文
            $ar_body = $name." 様\n\n";
            $ar_body .= "この度は、お問い合せ頂き誠にありがとうございます。" . "\n\n";
            $ar_body .= "下記の内容でお問い合せを受け付けました。\n\n";
            //日付
            // 'Y/m/d'曜日
            $w = date('w');
            $week = ['日', '月', '火', '水', '木', '金', '土'];

            $ar_body .= "件名：" . $subject . "\n";
            $ar_body .= "お問い合せ日時：" . date("Y年m月d日") ."(".$week[$w]."曜日".")".  date("H時i分") . "\n";
            $ar_body .= "お名前：" . $name . "\n";
            $ar_body .= "お電話番号： " . $tel . "\n" ;
            if ($subject == "資料請求") {
                $ar_body .=  "資料送付先： " . $send . "\n" ;
            }
            $ar_body .= "メールアドレス：" . $email . "\n";
            $ar_body .= "郵便番号： " . $postCode . "\n";
            $ar_body .= "住所： " . $address . "\n\n" ;
            $ar_body .="＜お問い合せ内容＞" . "\n" . $body;
  
            //自動返信メールを送信（送信結果を変数 $result2 に代入）
            if (ini_get('safe_mode')) {
                $result2 = mb_send_mail($email, $ar_subject, $ar_body, $ar_header);
            } else {
                $result2 = mb_send_mail($email, $ar_subject, $ar_body, $ar_header, '-f' . $returnMail);
            }


            $_POST = array(); ////空の配列を代入し、すべてのPOST変数を消去
            //リダイレクトの URL に付加するパラメータ用の変数
            $params = '?';
            $params .= '&subject='. h($subject);
            $params .= '&name='. h($name);
            $params .= '&tel='. h($tel);
            if ($subject == "資料請求") {
                $params .= '&send='. h($send);
            }
            $params .= '&email='. h($email);
            $params .= '&postCode='. h($postCode);
            $params .= '&address='. h($address);
            $params .= '&body='. h($body);


 
            //変数の値も初期化
            $subject = '';
            $name = '';
            $tel = '';
            $email = '';
            $postCode = '';
            $address = '';
            $body = '';

            //完了ページ（complete.php）へリダイレクト
            $url = 'complete/complete.php';
            header('Location:' . $url . $params);

            // //再読み込みによる二重送信の防止
            // $params = '?result='. $result .'&result2=' . $result2;
            // //サーバー変数 $_SERVER['HTTPS'] が取得出来ない環境用
            // if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) and $_SERVER['HTTP_X_FORWARDED_PROTO'] === "https") {
            //     $_SERVER['HTTPS'] = 'on';
            // }
            // //reCAPTCHA 検証結果確認用パラメータ
            // $params .= '&success=' . $rc_result->success  .'&action=' . $rc_result->action .'&score=' . $rc_result->score;
            // $url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
            // header('Location:' . $url . $params);
            // exit;
        }
    } else {
        $params = '?';
        $params .= '&subject='. h($error['subject']);
        $params .= '&name='. h($error['name']);
        $params .= '&tel='. h($error['tel']);
        if ($subject == "資料請求") {
            $params .= '&send='. h($error['send']);
        }
        $params .= '&recaptcha='. h($error['recaptcha']);
        $params .= '&email='. h($error['email']);
        $params .= '&postCode='. h($error['postCode']);
        $params .= '&address='. h($error['address']);
        $params .= '&body='. h($error['body']);

        $urlEr = 'error/error.php';
        header('Location:' . $urlEr . $params);
    }
}