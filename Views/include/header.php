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
                <li class="header__item logo-title"><a class="header__link" href="/">Chess Trainer</a></li>
                <li class="header__item header__nav"><a class="header__link" href="./settings" id="login_button"><?php echo $_SESSION['username']; ?></a></li>
                <li class="header__item header__nav"><a class="header__link" href="#" id="login_button">Log&nbsp;In</a></li>
            </ul>
        </nav>
    </div>
</header>