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
  <title>完了画面</title>
</head>

<body>
  <div class="container">
    <h2 class="">完了画面</h2>
    <h4>送信完了いたしました。</h4>
    <p>この度は、お問い合わせ頂き誠にありがとうございます。</p>
    <p>以下の内容でお問い合わせを受け付けました。</p>
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
          <th>お問い合わせ内容</th>
          <td><?php if ($body) {
    echo h($body);
} ?></td>
        </tr>
      </table>
    </div>
  </div>
</body>

</html>