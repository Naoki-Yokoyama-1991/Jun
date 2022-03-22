(function (win, doc) {
  var tag = doc.createElement('script'),
    firstScriptTag = doc.getElementsByTagName('script')[0];

  tag.src = 'https://www.youtube.com/iframe_api';
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  function onYouTubeIframeAPIReady() {
    new YT.Player('player', {
      width: 842, // 動画幅
      height: 474, // 動画高さ
      videoId: 'zMfANvDCrh0', // 動画ID
      events: {
        onReady: onPlayerReady,
        onStateChange: onPlayerStateChange,
      },
      playerVars: {
        rel: 0, // 関連動画非表示
        showinfo: 1, // 動画情報表示
        controls: 1, // コントローラー表示
        autoplay: 0,
      },
    });
  }

  function onPlayerReady(evt) {
    // 動画再生準備完了時イベント
    evt.target.playVideo(); // 動画再生
  }

  function onPlayerStateChange(evt) {
    // 動画再生状態変更時イベント
    if (evt.data === 0) {
      // 動画停止時
      evt.target.playVideo(); // 動画再生
    }
  }

  // export
  win.onYouTubeIframeAPIReady = onYouTubeIframeAPIReady;
})(this, document);
