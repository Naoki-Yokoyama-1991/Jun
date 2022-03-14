window.addEventListener(
  'DOMContentLoaded',
  () => {
    const formID = document.getElementById('formIn');
    const formClass = formID.className;

    let foHtml = '';

    // if (formID.className == 'formFirst') {
    //   foHtml += htmlPartsLeft; //formhtml.jsから呼び出し
    // }

    // formID.innerHTML = foHtml;

    //バリデーションパターン
    const emailExp =
      /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/;
    const telExp = /^(0[5-9]0[0-9]{8}|0[1-9][1-9][0-9]{7})$/;
    const postalExp = /^[0-9]{3}[0-9]{4}$/;

    //error message
    const name_error_message = document.getElementById('name-error-message');
    const email_error_message = document.getElementById('email-error-message');
    const tel_error_message = document.getElementById('tel-error-message');
    const postalCode_error_message = document.getElementById(
      'postal-code-error-message'
    );
    const address_error_message = document.getElementById(
      'address-error-message'
    );
    const textarea_error_message = document.getElementById(
      'textarea-error-message'
    );

    //form
    const form = document.getElementById('form');

    //form element
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const tel = document.getElementById('tel');
    const postalCode = document.getElementById('postal-code');
    const address = document.getElementById('address');
    const textarea = document.getElementById('textarea');

    //ハイフンカット
    tel.value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi, '');
    postalCode.value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi, '');

    //button
    const btn = document.getElementById('btn');

    //初期状態
    btn.disabled = true;

    //event

    //name
    name.addEventListener('keyup', (e) => {
      if (name.value) {
        name.setAttribute('class', 'success');
        name_error_message.textContent = '';
      } else {
        name.setAttribute('class', 'error');
        name_error_message.textContent = 'お名前は必須です。';
      }
      console.log(name.getAttribute('class'.includes('success')));
      checkSuccess();
    });

    //email
    email.addEventListener('keyup', (e) => {
      if (!email.value) {
        email.setAttribute('class', 'error');
        email_error_message.textContent = 'メールアドレスは必須です。';
      } else if (emailExp.test(email.value)) {
        email.setAttribute('class', 'success');
        email_error_message.textContent = '';
      } else {
        email.setAttribute('class', 'error');
        email_error_message.textContent =
          'メールアドレスが正しく入力されていません';
      }
      console.log(name.getAttribute('class'.includes('success')));
      checkSuccess();
    });

    //tel
    tel.addEventListener('keyup', (e) => {
      if (telExp.test(tel.value)) {
        tel.setAttribute('class', 'success');
        tel_error_message.textContent = '';
      } else if (name.value) {
        tel.setAttribute('class', 'error');
        tel_error_message.textContent = '電話番号が正しく入力されていません';
      } else {
      }
      console.log(tel.getAttribute('class'.includes('success')));
      checkSuccess();
    });

    //postal-code
    postalCode.addEventListener('keyup', (e) => {
      if (postalExp.test(postalCode.value)) {
        postalCode.setAttribute('class', 'success');
        postalCode_error_message.textContent = '';
      } else {
        postalCode.setAttribute('class', 'error');
        postalCode_error_message.textContent =
          '郵便番号が正しく入力されていません';
      }
      console.log(postalCode.getAttribute('class'.includes('success')));
      checkSuccess();
    });

    //address
    address.addEventListener('keyup', (e) => {
      if (address.value) {
        address.setAttribute('class', 'success');
        address_error_message.textContent = '';
      } else {
        address.setAttribute('class', 'error');
        address_error_message.textContent = '住所が入力されていません';
      }
      console.log(address.getAttribute('class'.includes('success')));
      checkSuccess();
    });

    //textarea
    textarea.addEventListener('keyup', (e) => {
      if (textarea.value) {
        textarea.setAttribute('class', 'success');
        textarea_error_message.textContent = '';
      } else {
        textarea.setAttribute('class', 'error');
        textarea_error_message.textContent = 'お問合せ内容は必須です。';
      }
      console.log(textarea.getAttribute('class'.includes('success')));
      checkSuccess();
    });

    //ボタンのdisabled制御
    const checkSuccess = () => {
      if (name.value && email.value && textarea.value) {
        if (
          name.getAttribute('class').includes('success') &&
          email.getAttribute('class').includes('success') &&
          textarea.getAttribute('class').includes('success')
        )
          btn.disabled = false;
      } else {
        btn.disabled = true;
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
