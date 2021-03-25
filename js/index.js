if ( location.pathname.indexOf('/calculator') !== -1 ) {
  const replRadioBtn = document.querySelectorAll('.deposit-form__replenishment > input');
  const replDepositInput = document.querySelector('#replenishment-deposit');

  if (localStorage.getItem('replDepositInput')) {
    if (localStorage.getItem('replDepositInput') === 'disabled') {
      replDepositInput.setAttribute('disabled', 'disabled');
    } else if (localStorage.getItem('replDepositInput') === 'active') {
      replDepositInput.removeAttribute('disabled');
      replRadioBtn[0].removeAttribute('checked');
      replRadioBtn[1].setAttribute('checked', '');
    }
  }

  replRadioBtn.forEach( item => {
    item.onclick = (e) => {
      if(e.target.getAttribute('data-select') === 'no') {
        replDepositInput.setAttribute('disabled', 'disabled');
        localStorage.setItem('replDepositInput', 'disabled');
      } else if (e.target.getAttribute('data-select') === 'yes') {
        replDepositInput.removeAttribute('disabled');
        localStorage.setItem('replDepositInput', 'active');
      }
    }
  })

  const form = document.querySelector('.deposit-form');
  const resultForm = document.querySelector('.deposit-form > .result');
  const url = 'http://localhost/php/calc.php';

  form.onsubmit = async (e) => {
    e.preventDefault();

    const formTest = new FormData(form);

    const formRules = {
      "deposit": {
        min: 1000,
        max: 3000000
      }, 
      "replenishment-deposit": {
        min: 1000,
        max: 3000000
      }
    }

    const deposit = Number(formTest.get('deposit'));
    const replenishmentDeposit = Number(formTest.get('replenishment-deposit'));

    if (deposit < formRules["deposit"].min || deposit > formRules["deposit"].max) {
      document.querySelector('.error').innerHTML = 'Сумма вклада: ошибка допустимого диапазона. Введите число от 1 000 до 3 000 000!';
      return false;
    } else {
      document.querySelector('.error').innerHTML = '';
    }

    if ( (replenishmentDeposit < formRules["replenishment-deposit"].min || replenishmentDeposit > formRules["replenishment-deposit"].max) && formTest.get('replenishment-deposit') !== null) {
      document.querySelector('.error').innerHTML = 'Сумма пополнения вклада: ошибка допустимого диапазона. Введите число от 1 000 до 3 000 000!';
      return false;
    } else {
      document.querySelector('.error').innerHTML = '';
    }

    let response = await fetch(url, {
      method: 'POST',
      body: new FormData(form)
    });

    if (response.ok) {
      let result = await response.text();

      resultForm.innerHTML = result;
    }
  };
}