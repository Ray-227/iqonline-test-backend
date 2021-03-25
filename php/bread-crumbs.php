<div class="col-12">
  <div class="bread-crumbs">
  <?php

    function getLink($url) {
      switch($url){
        case "": 
          echo "<a href=\"/\" class=\"bread-crumbs__item\">Главная</a>";
        break;
        case "deposit.php": 
          echo "<div class=\"bread-crumbs__item\">Вклады</div>";
        break;
        case "deposit": 
          echo "<a href=\"/pages/deposit.php\" class=\"bread-crumbs__item\">Вклады</a>";
        break;
        case "calculator.php": 
          echo "<div class=\"bread-crumbs__item\">Калькулятор</div>";
        break;
      }
    }

    $cur_url = $_SERVER['REQUEST_URI'];
    $urls = explode('/', $cur_url);

    if (!empty($urls) && $cur_url != '/') {

      foreach ($urls as $url) {
        getLink($url);
      }

    }

  ?>
  </div>
</div>