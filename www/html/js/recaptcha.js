window.addEventListener('DOMContentLoaded', () => {
  var rc_form = document.getElementById('form');
  //フォーム要素にイベントハンドラを設定
  rc_form.onsubmit = function (event) {
    //デフォルトの動作（送信）を停止
    event.preventDefault();
    //トークンを取得
  };
});
