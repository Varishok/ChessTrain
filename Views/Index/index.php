<?php
include_once(ROOT.'/Assets/Additional.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Soc Connections</title>
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
<main class="info-block">
    <article class="about-block">
        <hgroup>
            <h1>Social Connections</h1>
            <h2>What is it?</h2>
        </hgroup>
        <p>
            It's an instrument to improve your social skills through stay in connection
            with people which important. And it helps you to follow people without "have-to"
            staying online in popular social networks.
        </p>
    </article>
    <form class="reg-block">
        <div class="reg-block__caption">Join us</div>
        <input class="reg-block__input " type="text" placeholder="Enter email" name="login"/>
        <input class="reg-block__input " type="text" placeholder="Enter username" name="username"/>
        <input class="reg-block__input " type="password" placeholder="Enter password" name="password"/>
        <input class="reg-block__input " type="password" placeholder="Again, password" name="password_confirm"/>
        <input class="reg-block__input reg-block__submit" type="submit" value="Register" name="undefined"/>
        <return> </return>
    </form>
</main>
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