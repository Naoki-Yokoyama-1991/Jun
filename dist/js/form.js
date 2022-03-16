window.addEventListener(
  'DOMContentLoaded',
  () => {
    var doc = document;

    //バリデーションパターン
    const emailExp =
      /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/;
    const telExp = /^(0[5-9]0[0-9]{8}|0[1-9][1-9][0-9]{7})$/;
    const postalExp = /^[0-9]{3}[0-9]{4}$/;

    //error message
    const name_error_message = doc.getElementById('name-error-message');
    const email_error_message = doc.getElementById('email-error-message');
    const tel_error_message = doc.getElementById('tel-error-message');
    const postalCode_error_message = doc.getElementById(
      'postal-code-error-message'
    );
    const address_error_message = doc.getElementById('address-error-message');
    const textarea_error_message = doc.getElementById('textarea-error-message');

    //form
    var form = doc.getElementById('form');

    //form element
    var name = doc.getElementById('name');
    var email = doc.getElementById('email');
    var tel = doc.getElementById('tel');
    var postalCode = doc.getElementById('postal-code');
    var address = doc.getElementById('address');
    var textarea = doc.getElementById('textarea');
    var send = doc.getElementById('send');
    var radioAdressName = doc.getElementById('laAdress-button');
    var radioEmailName = doc.getElementById('laEmail-button');

    var radio = form.elements['send'];
    let val = '';

    //ハイフンカット
    tel.value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi, '');
    postalCode.value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi, '');

    //button
    var btn = doc.getElementById('btn');

    //初期状態
    btn.disabled = true;

    //span 必須 追加
    var must_element_1 = doc.createElement('span');
    must_element_1.classList.add('j-tel');
    must_element_1.textContent = '必 須';
    // email
    var must_element_2 = doc.createElement('span');
    must_element_2.classList.add('j-email');
    must_element_2.textContent = '必 須';
    // adress
    var must_element_3 = doc.createElement('span');
    must_element_3.classList.add('j-adress');
    must_element_3.textContent = '必 須';
    // name
    var must_element_4 = doc.createElement('span');
    must_element_4.classList.add('j-name');
    must_element_4.textContent = '必 須';
    // textarea
    var must_element_5 = doc.createElement('span');
    must_element_5.classList.add('j-textarea');
    must_element_5.textContent = '必 須';

    // トップお問合わせ・資料請求切替
    var buttonTop = doc.getElementsByClassName('j-button');

    //読み込み時
    if (buttonTop[0].innerText == 'お問合せ') {
      buttonTop[0].classList.add('j-bu-success');
      email.before(must_element_2);
      name.before(must_element_4);
      textarea.before(must_element_5);
    }

    if (buttonTop[0].className.match(/j-bu-success/)) {
      send.style.display = 'none';
    }

    // 関数
    var funcCrea = (name, name_error) => {
      setTimeout(() => {
        name.setAttribute('class', 'success');
        name_error.textContent = '';
        name_error.classList.remove('errorMe');
      }, 2000);
    };

    var funcTrue = (name, name_error) => {
      name.setAttribute('class', 'success');
      name_error.classList.remove('errorMe');
      name_error.textContent = '';
    };

    var funcError = (name, name_error, text) => {
      name.setAttribute('class', 'error');
      name_error.setAttribute('class', 'errorMe');
      name_error.textContent = text;
    };

    var funcCheck = (name) => {
      console.log(name.getAttribute('class'.includes('success')));
      checkSuccess();
    };

    var funcReset = () => {
      form.reset();
      btn.disabled = true;
      btn.setAttribute('class', 'btnEr');
    };

    var funcSubmit = (value_1, value_2) => {
      if (name.value && value_1.value && value_2.value) {
        if (
          name.getAttribute('class').includes('success') &&
          value_1.getAttribute('class').includes('success') &&
          value_2.getAttribute('class').includes('success')
        )
          btn.setAttribute('class', 'btnSu');
        btn.disabled = false;
      } else {
        btn.disabled = true;
        btn.setAttribute('class', 'btnEr');
      }
    };

    //お問い合わせ クリック
    buttonTop[0].addEventListener('click', (e) => {
      e.preventDefault();

      //クラス切替
      buttonTop[0].classList.add('j-bu-success');
      buttonTop[1].classList.remove('j-bu-success');

      // j-bu-success名がついていたら
      if (buttonTop[0].className.match(/j-bu-success/)) {
        //radio 表示
        send.style.display = 'none';
        //tel 必須 削除
        const telSp = doc.getElementsByClassName('j-tel');
        if (telSp[0]) {
          telSp[0].remove();
        }
        //textarea span 追加
        textarea.before(must_element_5);
        email.before(must_element_2);
        doc.getElementById('j-text').innerText = 'お問合せ内容';
      }
      funcReset();
    });

    //資料請求 クリック
    buttonTop[1].addEventListener('click', (e) => {
      e.preventDefault();

      //クラス切替
      buttonTop[1].classList.add('j-bu-success');
      buttonTop[0].classList.remove('j-bu-success');

      // j-bu-success名がついていたら
      if (buttonTop[1].className.match(/j-bu-success/)) {
        //radio 表示
        send.style.display = 'block';

        tel.before(must_element_1);
        email.before(must_element_2);
        const textareaSp = doc.getElementsByClassName('j-textarea');
        textareaSp[0].remove();
        doc.getElementById('j-text').innerText = '備考欄';
      }

      funcReset();
    });

    //radio クリック
    // adress
    radio[0].addEventListener('click', (e) => {
      address.before(must_element_3);

      if (radioEmailName.className.match(/j-la-active/)) {
        radioEmailName.classList.remove('j-la-active');
        radioAdressName.classList.add('j-la-active');
      }

      const emailSp = doc.getElementsByClassName('j-email');
      if (emailSp[0] != undefined) {
        emailSp[0].remove();
      }

      for (let i = 0; i < radio.length; i++) {
        if (radio[i].checked) {
          val = radio[i].value;
        }
      }

      if (!address.value) {
        btn.disabled = true;
        btn.setAttribute('class', 'btnEr');
      }
    });

    // email
    radio[1].addEventListener('click', (e) => {
      email.before(must_element_2);
      if (radioAdressName.className.match(/j-la-active/)) {
        radioAdressName.classList.remove('j-la-active');
        radioEmailName.classList.add('j-la-active');
      }
      const adressSp = doc.getElementsByClassName('j-adress');

      if (adressSp[0] != undefined) {
        adressSp[0].remove();
      }

      for (let i = 0; i < radio.length; i++) {
        if (radio[i].checked) {
          val = radio[i].value;
        }
      }

      if (!email.value) {
        btn.disabled = true;
        btn.setAttribute('class', 'btnEr');
      }
    });

    //入力時アクション
    //name
    name.addEventListener('keyup', (e) => {
      if (name.value) {
        funcTrue(name, name_error_message);
      } else {
        funcError(name, name_error_message, 'お名前は必須です。');
        funcCrea(name, name_error_message);
      }
      funcCheck(name);
    });

    //tel
    tel.addEventListener('keyup', (e) => {
      if (buttonTop[0].className.match(/j-bu-success/)) {
        if (telExp.test(tel.value)) {
          funcTrue(tel, tel_error_message);
        } else {
          funcError(tel, tel_error_message, '電話番号が入力されていません。');
          funcCrea(tel, tel_error_message);
        }
        funcCheck(tel);
      } else if (buttonTop[1].className.match(/j-bu-success/)) {
        if (telExp.test(tel.value)) {
          funcTrue(tel, tel_error_message);
        } else if (!tel.value) {
          funcError(tel, tel_error_message, '電話番号は必須です。');
          funcCrea(tel, tel_error_message);
        } else {
          funcError(tel, tel_error_message, '電話番号が入力されていません。');
          funcCrea(tel, tel_error_message);
        }
        funcCheck(tel);
      }
    });

    //email
    email.addEventListener('keyup', (e) => {
      if (buttonTop[0].className.match(/j-bu-success/)) {
        if (!email.value) {
          funcError(email, email_error_message, 'メールアドレスは必須です。');
          funcCrea(email, email_error_message);
        } else if (emailExp.test(email.value)) {
          funcTrue(email, email_error_message);
        } else {
          funcError(
            email,
            email_error_message,
            'メールアドレスが正しく入力されていません。'
          );
          funcCrea(email, email_error_message);
        }
        funcCheck(email);
      } else if (
        buttonTop[1].className.match(/j-bu-success/) &&
        radioEmailName.className.match(/j-la-active/)
      ) {
        if (!email.value) {
          funcError(email, email_error_message, 'メールアドレスは必須です。');
          funcCrea(email, email_error_message);
        } else if (emailExp.test(email.value)) {
          funcTrue(email, email_error_message);
        } else {
          funcError(
            email,
            email_error_message,
            'メールアドレスが正しく入力されていません。'
          );
          funcCrea(email, email_error_message);
        }
        funcCheck(email);
      } else if (
        buttonTop[1].className.match(/j-bu-success/) &&
        radioAdressName.className.match(/j-la-active/)
      ) {
        if (email.value) {
          funcTrue(email, email_error_message);
        } else {
          funcError(
            email,
            email_error_message,
            'メールアドレスが正しく入力されていません。'
          );
          funcCrea(email, email_error_message);
        }
        funcCheck(email);
      }
    });

    //postal-code
    postalCode.addEventListener('keyup', (e) => {
      if (postalExp.test(postalCode.value)) {
        funcTrue(postalCode, postalCode_error_message);
      } else {
        funcError(
          postalCode,
          postalCode_error_message,
          '郵便番号が入力されていません。'
        );
        funcCrea(postalCode, postalCode_error_message);
      }
      funcCheck(postalCode);
    });

    //address
    address.addEventListener('keyup', (e) => {
      if (buttonTop[0].className.match(/j-bu-success/)) {
        if (address.value) {
          funcTrue(address, address_error_message);
        } else {
          funcError(
            address,
            address_error_message,
            '住所が入力されていません。'
          );
          funcCrea(address, address_error_message);
        }
        funcCheck(address);
      }
      if (
        buttonTop[1].className.match(/j-bu-success/) &&
        radioAdressName.className.match(/j-la-active/)
      ) {
        if (address.value) {
          funcTrue(address, address_error_message);
        } else {
          funcError(address, address_error_message, '住所は必須です。');
          funcCrea(address, address_error_message);
        }
        funcCheck(address);
      } else if (
        buttonTop[1].className.match(/j-bu-success/) &&
        radioEmailName.className.match(/j-la-active/)
      ) {
        if (address.value) {
          funcTrue(address, address_error_message);
        } else {
          funcError(
            address,
            address_error_message,
            '住所が入力されていません。'
          );
          funcCrea(address, address_error_message);
        }
        funcCheck(address);
      }
    });

    //textarea
    textarea.addEventListener('keyup', (e) => {
      if (buttonTop[0].className.match(/j-bu-success/)) {
        if (textarea.value) {
          funcTrue(textarea, textarea_error_message);
        } else {
          funcError(
            textarea,
            textarea_error_message,
            'お問合せ内容は必須です。'
          );
          funcCrea(textarea, textarea_error_message);
        }
        console.log(textarea.getAttribute('class'.includes('success')));
        checkSuccess();
      } else if (buttonTop[1].className.match(/j-bu-success/)) {
        if (textarea.value) {
          funcTrue(textarea, textarea_error_message);
        } else {
          funcError(
            textarea,
            textarea_error_message,
            '備考欄が入力されていません。'
          );
          funcCrea(textarea, textarea_error_message);
        }
        funcCheck(textarea);
      }
    });

    for (let i = 0; i < radio.length; i++) {
      if (radio[i].checked) {
        val = radio[i].value;
      }
    }

    //ボタンのdisabled制御
    var checkSuccess = () => {
      //お問い合わせ内容が正しければ
      if (buttonTop[0].className.match(/j-bu-success/)) {
        funcSubmit(email, textarea);
      } else if (
        buttonTop[1].className.match(/j-bu-success/) &&
        val == 'Eメール'
      ) {
        //資料請求内容が正しければ（Eメール）
        funcSubmit(tel, email);
        //資料請求内容が正しければ（ご自宅）
      } else if (
        buttonTop[1].className.match(/j-bu-success/) &&
        val == 'ご自宅'
      ) {
        funcSubmit(tel, address);
      }
    };

    //submit
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      // form.method = 'post';
      form.action = ''; //← PHPファイル
      form.submit();
    });
  },

  false
);
