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

  $daysPrevMonth = (int) date("d", mktime(0, 0, 0, $date[0], 1, $date[2]) - 1);


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

  $depositMonth = (int) $data["deposit-year"] * 12;
  $prevResult = 0;
  $result = 0;

  $iYear = 1;
  $monthInYear = 12;
  // summn = summn-1 + (summn-1 + summadd)daysn(percent / daysy)
  for ($i = 0; $i < $depositMonth; $i++) {

    $date[0] = (int) $date[0] + $i;
    $daysCurrentMonth = (int) date("d", mktime(0, 0, 0, $date[0]+1, 1, $date[2]) - 1);
    $daysPrevMonth = (int) date("d", mktime(0, 0, 0, $date[0], 1, $date[2]) - 1);

    if ($data["replenishment"] === "yes") {
      $prevResult = $deposit + $depositAdd * ( $daysYear * (1 + $percent / $daysCurrentMonth) );
      $result += $prevResult + ($prevResult + $depositAdd) * ( $daysYear * (1 + $percent / $daysCurrentMonth) );
    } else {
      $prevResult = $deposit * ( $daysYear * (1 + $percent / $daysCurrentMonth) );
      $result += $prevResult * ( $daysYear * (1 + $percent / $daysCurrentMonth) );
    }
    

    if ($i === $monthInYear * 1 || $i === $monthInYear * 2 || $i === $monthInYear * 3 || $i === $monthInYear * 4 || $i === $monthInYear * 5) {
      $daysYear = 365 + (int) checkdate(2, 29, $date[2]+$iYear);
      $iYear++;
    }
  }

  echo round($result, 2);
?>