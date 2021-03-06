<?php
//エスケープ処理やデータチェックを行う関数のファイルの読み込み
require 'contact/contact.php';
?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>バスで旅するお葬式</title>
  <meta name="description" content="バスで旅するお葬式58万円より" />
  <meta name="format-detection" content="telephone=no" />

  <!-- favicon/webclipicon -->
  <link rel="icon" href="" />
  <link rel="icon" href="" type="image/svg+xml">
  <link rel="apple-touch-icon" href="" />

  <!-- ogp -->
  <meta property="og:site_name" content="巡輪偲" />
  <meta property="og:url" content="" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="バスで旅するお葬式" />
  <meta property="og:description" content="バスで旅するお葬式58万円より" />
  <meta property="og:image" content="" />
  <meta property="og:locale" content="ja_JP" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:description" content="バスで旅するお葬式58万円より" />
  <meta name="twitter:image:src" content="" />

  <!-- css -->
  <link rel="stylesheet" href="css/style.css" />

  <!-- js -->
  <script src="https://cdn.jsdelivr.net/npm/imagesloaded@4.1.4/imagesloaded.pkgd.min.js"></script>
  <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $siteKey; ?>"></script>

</head>

<body>
  <div class="j-wrapper">
    <!----- main ----->
    <main id="main">
      <!----- j-load ----->
      <div id="loading">
        <div id="loading-main"></div>
      </div>
      <!----- j-lead ----->
      <section class="j-lead">
        <div class="j-row">
          <div class="j-width-left">
            <img class="logo" src="image/logo.png" alt="">
            <h3 class="catchCopy">想い出に会い行こう</h3>
            <h1>バスで旅するお葬式<br />
              58万円より</h1>
            <div class="bus">
              <p>毎日新聞で紹介されました</p>
              <img src="image/bus.jpg" alt="">
              <span></span>
            </div>
            <div id="btn" class="j-btn">
              <a href="#jForm">
                <p>資料を見てみる</p>
              </a>
              <a href="tel:0120323099">
                <p>0120-323-099</p>
              </a>
            </div>
          </div>
          <div class="j-width-right"><img src="image/top.jpg"></div>
        </div>
      </section>

      <!----- j-message ----->
      <section class="j-message">
        <div class="j-row scr-target">
          <div class="j-width-left">
            <img src="image/message/me-1.jpg" alt="">
          </div>
          <div class="j-width-right-me">
            <p>行けなかったあの旅行<br />
              会いたかったあの人<br />
              楽しかった想い出の場所<br />
              元気になったら行こうね<br />
              そう約束していたけど<br />
              旅立ってしまった<br />
            </p>
          </div>
        </div>
        <div class="j-row-middle scr-target">
          <div class="j-width-left">
            <img src="image/message/me-2.jpg">
          </div>
          <div class="j-width-right-me">
            <p>守れなかった約束<br />
              叶えられなかった想い<br />
              ご家族の後悔<br />
              故人様の無念<br />
              なんとかできないか<br />
              なんとかしてあげたい<br />
            </p>
          </div>
        </div>
        <div class="j-me-right scr-target">
          <img src="image/message/me-3.jpg">
        </div>
        <div class="j-width-down scr-target">
          <div class="j-width-left">
            <p>そんな気持ちから<br />
              生まれた新しい<br />
              お葬式のカタチ<br />
              場所にとらわれない<br />
              自由なお葬式<br />
            </p>
          </div>
          <div class="j-width-right-me">
            <img src="image/message/me-4.jpg">
          </div>
        </div>
        <div class="j-me-main scr-target">
          <img src="image/message/me-5.jpg">
        </div>
        <div class="j-me-main-down scr-target">
          <div class="j-width-left">
            <img src="image/message/me-6.jpg">
          </div>
          <div class="j-width-right-me">
            <p>故人様と想い出の地を巡り<br />
              重ねてきた時の輪を偲ぶ<br />
              旅葬というお葬式の新しいかたち<br />
            </p>
          </div>
        </div>
        <div class="j-me-left scr-target">
          <img src="image/message/me-7.jpg">
        </div>
        <div class="j-me-btn">
          <a href="#jForm">
            <p>資料を見てみる</p>
          </a>
          <a href="tel:0120323099">
            <p>0120-323-099</p>
          </a>
        </div>
      </section>

      <!----- j-concept ----->
      <section class="j-concept">
        <div id="concept">
          <!----- app.js出力 ----->
        </div>
        <div class="j-co-three">
          <p>大切な家族</p>
          <p>大切な時間</p>
          <p>大切な想い出</p>
        </div>
        <p class="j-co-down">お葬式は、葬儀場から解き放たれます</p>
      </section>

      <!----- j-flow ----->
      <section class="j-flow">
        <h3 class="j-flow-title">旅葬 巡輪偲の流れ<span>（一例）</span></h3>
        <div id="flow">
          <!----- app.js出力 ----->
        </div>
      </section>

      <!----- j-voice ----->
      <section class="j-voice">
        <h3 class="j-voice-title">お客様の声</h3>
        <div id="voice">
          <!----- app.js出力 ----->
        </div>
      </section>

      <!----- j-youtube ----->
      <section class="j-youtube">
        <div id="player">
          <!----- app.js出力 ----->
        </div>
      </section>

      <!----- j-inquiry ----->
      <section class="j-inquiry">
        <h3 class="j-inquiry-title">よくある質問</h3>
        <div id="inquiry">
          <!----- app.js出力 ----->
        </div>
      </section>

      <!----- j-recommend ----->
      <section class="j-recommend">
        <h3 class="j-recommend-title">旅葬 巡輪偲はこんな方におすすめ</h3>
        <div id="recommend">
          <div class="j-re-item">
            <div class="j-re-image">
              <img src="image/recommend/re-1.png">
            </div>
            <p>宗教儀礼や地域の風習よりも<br />人の想いを大切にしたい</p>
          </div>
          <div class="j-re-item">
            <div class="j-re-image">
              <img src="image/recommend/re-2.png">
            </div>
            <p>故人をいつまでも<br />忘れない様に想い出を作りたい</p>
          </div>
          <div class="j-re-item">
            <div class="j-re-image">
              <img src="image/recommend/re-3.png">
            </div>
            <p>お葬式に来れない人にも<br />会わせてあげたい、会って欲しい</p>
          </div>
        </div>
      </section>

      <!----- j-recommend ----->
      <section class="j-form" id="jForm">
        <h3 class="j-form-title">お問い合せ・資料請求</h3>
        <form id="form">
          <div class="j-fo-top">
            <input type="radio" name="subject" value="お問い合せ" id="foContact" checked required>
            <label for="foContact" class="j-button j-bu-success">お問い合せ</label>
            <input type="radio" name="subject" value="資料請求" id="foDocument">
            <label for="foDocument" class="j-button">資料請求</label>
          </div>
          <!----- name ----->
          <div class=" j-formIn">
            <div class="j-inner">
              <label>お名前</label><input type="text" name="name" id="name" value="<?php echo h($name); ?>">
            </div>
            <p id="name-error-message"></p>
          </div>
          <!----- tel ----->
          <div class="j-formIn">
            <div class="j-inner">
              <label>お電話番号</label><input type="tel" name="tel" size="17" maxlength="17" id="tel" autocomplete="tel"
                placeholder="ハイフンなしでご入力ください" value="<?php echo h($tel); ?>">
            </div>
            <p id="tel-error-message"></p>
          </div>
          <!----- send ----->
          <div id="send">
            <label>資料送付先</label>
            <input type="radio" name="send" value="ご自宅" id="laHouse">
            <label for="laHouse" id="laAdress-button" class="j-label">ご自宅</label>
            <input type="radio" name="send" value="Eメール" id="laEmail" checked>
            <label for="laEmail" id="laEmail-button" class="j-label j-la-active">Eメール</label>
          </div>
          <!----- email ----->
          <div class="j-formIn">
            <div class="j-inner">
              <label>メールアドレス</label><input type="text" name="email" autocomplete="email" id="email"
                value="<?php echo h($email); ?>">
            </div>
            <p id="email-error-message"></p>
          </div>
          <!----- postal ----->
          <div class="j-formIn">
            <div class="j-inner">
              <label>郵便番号</label><input type="text" name="postCode" size="10" maxlength="10" id="postal-code"
                placeholder="ハイフンなしでご入力ください" autocomplete="postal-code" value="<?php echo h($postCode); ?>">
            </div>
            <p id="postal-code-error-message"></p>
          </div>
          <!----- address ----->
          <div class="j-formIn">
            <div class="j-inner">
              <label>ご住所</label><input type="text" name="address" id="address" value="<?php echo h($address); ?>">
            </div>
            <p id="address-error-message"></p>
          </div>
          <!----- textarea ----->
          <div class="j-formIn">
            <div class="j-inner">
              <label id="j-text">お問い合せ内容</label><textarea name="body" id="textarea" rows="6"
                cols="40"><?php echo h($body); ?></textarea>
            </div>
            <p id="textarea-error-message"></p>
          </div>
          <div class="j-formIn">
            <div class="j-inner">
              <button type="submit" name="submitted" id="foBtn">メールを送信</button>
            </div>
          </div>
        </form>

      </section>

    </main>
    <!----- footer ----->
    <footer>
      <div class="footer">
        <a href="#">
          <div>
            <img src="image/sns/twitter.jpg">
          </div>
        </a>
        <a href="#">
          <div>
            <img src="image/sns/facebook.jpg">
          </div>
        </a>
        <a href="#">
          <div>
            <img src="image/sns/instagram.jpg">
          </div>
        </a>
      </div>
      <div class="privacy">
        <a href="https://policies.google.com/privacy">Privacy Policy and</a>
        <a href="https://policies.google.com/terms"> Terms of Service apply.</a>
      </div>
    </footer>

  </div>
  <!-- js -->
  <script defer type="text/javascript" src="./js/app.js"></script>
  <script defer type="text/javascript" src="./js/youtube.js"></script>
  <script defer type="text/javascript" src="./js/query.js"></script>
  <script defer type="text/javascript" src="./js/animation.js"></script>
  <script defer type="text/javascript" src="./js/matchMedia.js"></script>
  <script defer type="text/javascript" src="./js/onLoad.js"></script>
  <script defer type="text/javascript" src="./js/form.js"></script>
</body>

</html>