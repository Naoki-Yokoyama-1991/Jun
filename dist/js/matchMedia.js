window.addEventListener('load', () => {
  if (window.matchMedia('(max-width: 400px)').matches) {
    // top image
    let topImage = document.getElementsByClassName('j-width-right');
    topImage[0].remove();

    let logoClass = document.querySelector('.catchCopy');
    logoClass.insertAdjacentHTML(
      'afterend',
      '<div class="j-width-right"><img src="image/top.jpg"></div>'
    );

    // top image
    let btn = document.getElementById('btn');
    btn.remove();

    let jRow = document.querySelector('.j-row');
    jRow.insertAdjacentHTML(
      'afterend',
      '<div id="btn" class="j-btn"><a href="#jForm"><p>資料を見てみる</p></a><a href="tel:0120323099"><p>0120-323-099</p></a></div>'
    );
  }
});
