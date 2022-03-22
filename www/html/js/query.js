// よくある質問
window.addEventListener(
  'load',
  () => {
    var doc = document;
    // 要素取得
    var answer = doc.getElementsByClassName('j-answer');
    var plus = doc.getElementsByClassName('op_plus');

    //クリックイベント
    doc.addEventListener(
      'click',
      (e) => {
        var el = e.target;
        //配列作成
        elements = [].slice.call(plus);
        // 要素の順番を取得
        var i = elements.indexOf(el);
        if (el.matches('.op_plus')) {
          answer[i].classList.toggle('j-anDis');
          plus[i].classList.toggle('plus');
        }
      },
      false
    );
  },
  false
);
