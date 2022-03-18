window.addEventListener('load', () => {
  if (window.matchMedia('(max-width: 400px)').matches) {
    let topImage = document.getElementsByClassName('j-width-right');
    topImage[0].remove();

    let logoClass = document.querySelector('.catchCopy');
    logoClass.insertAdjacentHTML(
      'afterend',
      '<div class="j-width-right"><img src="image/top.jpg"></div>'
    );
  }
});
