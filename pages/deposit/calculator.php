<?php
  $header = "World Bank - Калькулятор";
  require_once $_SERVER['DOCUMENT_ROOT']."/require/header.php"; 
?>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/blocks/header.html"; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT']."/blocks/menu.html"; ?>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/php/bread-crumbs.php"; ?>

<div class="col-8 deposit">
  <h1>Калькулятор</h1>
  <form method="POST" class="deposit-form">
    <label for="datepicker">Дата оформления вклада</label>
    <input type="text" id="datepicker" name="date" />
    <div class="error"></div>

    <label for="deposit">Сумма вклада</label>
    <input type="text" id="deposit" name="deposit" />

    <label for="deposit-time">Срок вклада</label>
    <select id="deposit-time" name="deposit-time">
      <option>1 год</option>
      <option>2 года</option>
      <option>3 года</option>
      <option>4 года</option>
      <option>5 лет</option>
    </select>

    <label>Пополнения вклада</label>
    <div>
    <label class="deposit-form__replenishment">
      <input type="radio" name="replenishment" data-select="no" value="no" checked /> Нет
    </label>
    <label class="deposit-form__replenishment">
      <input type="radio" name="replenishment" data-select="yes" value="yes" /> Да
    </label>
    </div>

    <label for="replenishment-deposit">Сумма пополнения вклада</label>
    <input type="text" id="replenishment-deposit" name="replenishment-deposit" disabled/>


    <input type="submit" value="Расчитать" />
    <div class="result"></div>
  </form>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT']."/blocks/footer.html"; ?>

<?php require_once $_SERVER['DOCUMENT_ROOT']."/require/footer.php"; ?>

