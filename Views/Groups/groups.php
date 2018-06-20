<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Document</title>
    <link rel="stylesheet" href="/Assets/css/main.css"/>
</head>
<body>
<header>
    <div class="header">
        <nav>
            <ul class="header__list">
                <li class="header__item logo-title"><a class="header__link" href="/">Social&nbsp;Connections</a></li>
                <li class="header__item header__nav"><a class="header__link" href="./settings.html" id="login_button"><?php echo $_SESSION['username']; ?></a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="group-cards">
    <div class="group-card" id="group-card_add"><span class="group-card__title">ADD +</span></div>
</div>
<div class="wrapper__add-block not-active">
  <div class="group-cards__add-block add-block">
    <form class="" action="" method="post">
      <input class="add-block__input" type="text" name="" value="" placeholder="Enter group name..">
      <input class="add-block__submit" id="add-block__add" type="submit" name="" value=" ADD ">
      <button class="add-block__submit" id="add-block__close" name="" value=" CLOSE ">CLOSE</button>
    </form>
  </div>
</div>
<script src="/Assets/js/libs.min.js"></script>
<script src="/Assets/js/main.js" charset="utf-8"></script>
</body>
</html>
