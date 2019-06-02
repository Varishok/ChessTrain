<?session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title></title>
    <link rel="stylesheet" href="/Assets/css/main.css"/>
</head>
<body>
<header>
    <div class="header">
        <nav>
            <ul class="header__list">
                <li class="header__item logo-title"><a class="header__link" href="/">Шахматный&nbsp;тренажер</a></li>
                <li class="header__item header__nav"><a class="header__link" href="/game/" id="header_button">Игры</a></li>
                <li class="header__item header__nav"><a class="header__link" href="/debut/" id="header_button">Дебюты</a></li>
                <li class="header__item header__nav"><a class="header__link" href="/checkmate/" id="header_button">Шах&nbsp;и&nbsp;мат</a></li>
                <li class="header__item header__nav"><a class="header__link" href="/puzzle/" id="header_button">Головоломки</a></li>
                <li class="header__item header__nav"><a class="header__link" href="/turn/" id="header_button">Ходы&nbsp;фигурами</a></li>
                <li class="header__item header__nav"><a class="header__link" href="/literature/" id="header_button">Литература</a></li>
                <?if(empty($_SESSION['id']) && empty($_SESSION['login'])):?>
                <li class="header__item header__nav"><a class="header__link" href="/login/" id="header_button">Войти</a></li>
                <li class="header__item header__nav"><a class="header__link" href="/registered/" id="header_button">Зарегистрироваться</a></li>
                <?else:?>
                <li class="header__item header__nav"><a class="header__link" href="#" id="header_button"><?=$_SESSION['login'];?></a></li>
                <li class="header__item header__nav"><a class="header__link" href="/logout/" id="header_button">Выйти</a></li>
                <?endif?>
            </ul>
        </nav>
    </div>
</header>