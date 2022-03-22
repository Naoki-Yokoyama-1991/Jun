window.addEventListener('load', function () {
  //クラス読み込み
  const target = document.querySelectorAll('.scr-target');
  // 要素を配列
  const targetArray = Array.prototype.slice.call(target);

  const options = {
    root: null,
    rootMargin: '0px 0px',
    threshold: 0.2,
  };

  /// 初期化
  const observer = new IntersectionObserver(callback, options);

  targetArray.forEach(function (tgt) {
    // 監視の開始
    observer.observe(tgt);
  });

  function callback(entries) {
    entries.forEach(function (entry) {
      // ターゲット要素
      const target = entry.target;
      // 交差していない
      if (entry.isIntersecting && !target.classList.contains('is-active')) {
        target.classList.add('is-active');
      }
    });
  }
});
