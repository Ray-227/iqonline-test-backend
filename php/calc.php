<?php
  $keys = ["date", "deposit", "deposit-year", "replenishment", "replenishment-deposit"];
  $data = [];
  $min = 1000;
  $max = 3000000;

  foreach($keys as $key) {
    if ( isset($_POST[$key]) && !empty($_POST[$key]) ) {
      $data[$key] =  htmlspecialchars($_POST[$key]);
    }
  }

  if($data["deposit"] < $min || $data["deposit"] > $max) {
    echo "Ошибка";
  }

  if( ($data["replenishment"] === "yes" &&  isset($data["replenishment-deposit"])) && ($data["replenishment-deposit"] < $min || $data["replenishment-deposit"] > $max) ) {
    echo "Ошибка";
  }



  // [ОБРАБОТКА ДАТЫ]
  $date = explode("/", $data["date"]);

  // daysn – количество дней в данном месяце, на которые приходился вклад.
  $daysCurrentMonth = (int) date("d", mktime(0, 0, 0, $date[0]+1, 1, $date[2]) - 1);

  // daysy – количество дней в году.
  $daysYear = 365 + (int) checkdate(2, 29, $date[2]);


  // summn – сумма на счете на месяц n (руб).
  $deposit = $data["deposit"];

  if ($data["replenishment"] === "yes") {
    // summadd – сумма ежемесячного пополнения
    $depositAdd = $data["replenishment-deposit"];
  } else {
    $depositAdd = 0;
  }

  // percent – процентная ставка банка - 10%
  $percent = 10;

  $depositYear = (int) $data["deposit-year"];
  $result = 0;

  for ($i = 0; $i < $depositYear; $i++) {
    $daysYear = 365 + (int) checkdate(2, 29, $date[2]+$i);
    $result += ($deposit + $depositAdd) * ( $daysYear * (1+10/$daysCurrentMonth) );
  }

  echo round($result, 2);
?>