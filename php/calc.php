<?php
  $keys = ["date", "deposit", "deposit-time", "replenishment", "replenishment-deposit"];
  $data = [];
  $min = 1000;
  $max = 3000000;

  foreach($keys as $key) {
    if ( isset($_POST[$key]) && !empty($_POST[$key]) ) {
      $data[$key] =  htmlspecialchars($_POST[$key]);
    }
  }

  if($data["date"] < $min || $data["date"] > $max) {
    echo "Ошибка"
  }

  if($data["replenishment-deposit"] < $min || $data["replenishment-deposit"] > $max) {
    echo "Ошибка"
  }

  // 4.5 Формула с капитализаций процентов по вкладу:
  // 4.5.1 summn = summn-1 + (summn-1 + summadd)daysn(percent / daysy)
  // 4.5.2 где summn – сумма на счете на месяц n (руб),
  // 4.5.3 summn-1 – сумма на счете на конец прошлого месяца
  // 4.5.4 summadd – сумма ежемесячного пополнения
  // 4.5.5 daysn – количество дней в данном месяце, на которые приходился вклад
  // 4.5.6 percent – процентная ставка банка - 10%
  // 4.5.7 daysy – количество дней в году.
  // 4.5.8 Если в поле «Пополнение вклада» стоит «нет», данные «summadd» не используются.

  echo "TEST";
?>