window.addEventListener('load', () => {
  let request = new XMLHttpRequest();

  request.open('GET', 'js/json.json');
  request.send();

  request.onreadystatechange = () => {
    if (request.readyState == 4 && request.status == 200) {
      let json = JSON.parse(request.responseText);
      let coHtml = '';
      let foHtml = '';
      let voHtml = '';
      let inHtml = '';

      for (let i = 0; i < json[0].concept.length; i++) {
        let htmlParts =
          '<div class="j-co-list" >' +
          ' <h3 class="j-co-title">' +
          json[0].concept[i].title +
          '</h3>' +
          '</div>' +
          '<p>' +
          json[0].concept[i].text +
          '</p>';

        coHtml += htmlParts;
      }

      for (let i = 0; i < json[0].flow.length; i++) {
        if (json[0].flow[i].title == '火葬場へ') {
          var htmlParts =
            '<div class="j-fl-list" >' +
            '<div class="j-fl-left">' +
            ' <h3>' +
            '<span></span>' +
            json[0].flow[i].title +
            '<span></span> ' +
            '</h3>' +
            '<p>' +
            json[0].flow[i].text +
            '</p>' +
            '</div>' +
            '<div class="j-fl-right">' +
            '<img src="' +
            json[0].flow[i].image +
            '">' +
            '</div>' +
            '</div>';
        } else {
          htmlParts =
            '<div class="j-fl-list" >' +
            '<div class="j-triangle"></div>' +
            '<div class="j-fl-left">' +
            ' <h3>' +
            '<span></span>' +
            json[0].flow[i].title +
            '<span></span> ' +
            '</h3>' +
            '<p>' +
            json[0].flow[i].text +
            '</p>' +
            '</div>' +
            '<div class="j-fl-right">' +
            '<img src="' +
            json[0].flow[i].image +
            '">' +
            '</div>' +
            '</div>';
        }

        foHtml += htmlParts;
      }

      for (let i = 0; i < json[0].voice.length; i++) {
        let htmlParts =
          '<div class="j-vo-list" >' +
          '<div class="j-vo-left">' +
          '<span class="j-vo-item" ></span>' +
          ' <h3>' +
          ' <span>' +
          json[0].voice[i].number +
          '</span>' +
          json[0].voice[i].title +
          '</h3>' +
          '<p>' +
          json[0].voice[i].text +
          '</p>' +
          '</div>' +
          '<div class="j-vo-right">' +
          '<img src="' +
          json[0].voice[i].image +
          '">' +
          '</div>' +
          '</div>';

        voHtml += htmlParts;
      }

      for (let i = 0; i < json[0].inquiry.length; i++) {
        let htmlParts =
          '<div class="j-in-list" >' +
          '<div  class="j-in-top" >' +
          ' <p class="inquiry-text">' +
          '<span>Q ）</span>' +
          json[0].inquiry[i].inquiry +
          '</p>' +
          '<div class="section"><i class="op_plus plus"></i></div>' +
          '</div>' +
          '<div class="j-answer j-anDis">' +
          '<p class="answer-text">' +
          json[0].inquiry[i].answer +
          '</p>' +
          '</div>' +
          '</div>';

        inHtml += htmlParts;
      }

      document.getElementById('concept').innerHTML = coHtml;
      document.getElementById('flow').innerHTML = foHtml;
      document.getElementById('voice').innerHTML = voHtml;
      document.getElementById('inquiry').innerHTML = inHtml;
    }
  };
});
