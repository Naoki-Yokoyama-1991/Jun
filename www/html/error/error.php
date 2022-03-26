<?php
//エスケープ処理を行う関数
function h($var)
{
    return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
}
//GET メソッドで渡された値を初期化（取得）
$subject = filter_input(INPUT_GET, 'subject');
$name = filter_input(INPUT_GET, 'name');
$tel = filter_input(INPUT_GET, 'tel');
$send = filter_input(INPUT_GET, 'send');
$email = filter_input(INPUT_GET, 'email');
$postCode = filter_input(INPUT_GET, 'postCode');
$address = filter_input(INPUT_GET, 'address');
$body = filter_input(INPUT_GET, 'body');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>送信エラー</title>
  <link rel="stylesheet" href="css/error.css" />
</head>

<body>
  <main id="main">
    <div class="container">
      <!-- <img class="logo" src="../image/logo.png" alt=""> -->
      <div class="inner">
        <h4>送信失敗</h4>
        <p>申し訳ございませんが、送信に失敗しました。</p>
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th>件名</th>
              <td><?php if ($subject) {
    echo h($subject);
} ?></td>
            </tr>
            <tr>
              <th>お名前</th>
              <td><?php if ($name) {
    echo h($name);
} ?></td>
            </tr>
            <tr>
              <th>お電話番号</th>
              <td><?php if ($tel) {
    echo h($tel);
} ?></td>
            </tr>
            <?php if ($send) {
    ?> <tr>
              <th>資料送付先</th>
              <td><?php echo h($send) ?></td>
            </tr>
            <?php
} ?>
            <tr>
              <th>メールアドレス</th>
              <td><?php if ($email) {
        echo h($email);
    } ?></td>
            </tr>
            <tr>
              <th>郵便番号</th>
              <td><?php if ($postCode) {
        echo h($postCode);
    } ?></td>
            </tr>
            <tr>
              <th>住所</th>
              <td><?php if ($address) {
        echo h($address);
    } ?></td>
            </tr>
            <tr>
              <th>お問い合せ内容</th>
              <td><?php if ($body) {
        echo h($body);
    } ?></td>
            </tr>
          </table>
          <?php
 
//ホスト名取得
$h = $_SERVER['HTTP_HOST'];
// リファラ値があれば、かつ外部サイトでなければaタグで戻るリンクを表示
if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'], $h) !== false)) {
    echo '<button><a href="' . $_SERVER['HTTP_REFERER'] . '">前に戻る</a></button>';
}
?>
        </div>
      </div>
    </div>
  </main>
</body>

</html>