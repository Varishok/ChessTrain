<?php
include_once(ROOT.'/Assets/Additional.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Log In | Soc Connections</title>
    <link rel="stylesheet" href="/Assets/css/main.css"/>
</head>
<body>
<header>
    <div class="header">
        <nav>
            <ul class="header__list">
                <li class="header__item logo-title"><a class="header__link" href="#">Social&nbsp;Connections</a></li>
                <li class="header__item header__nav"><a class="header__link" href="#">About</a></li>
                <li class="header__item header__nav"><a class="header__link" href="#" id="login_button">Log&nbsp;In</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="modal_login">
    <form class="modal-window modal-login">
        <div class="modal-login__caption">Log In</div>
        <input class="reg-block__input modal-login__input" type="text" placeholder="Enter login" name="login"/>
        <input class="reg-block__input modal-login__input" type="password" placeholder="Enter password" name="password"/>
        <input class="modal-login__input modal-login__submit" type="submit" value="Log In" name="undefined"/>
        <return> </return>
    </form>
</div>
<script src="/Assets/js/libs.min.js"></script>
</body>
</html>