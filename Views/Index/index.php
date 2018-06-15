<?php
include_once(ROOT.'/Assets/Additional.php');
include_once(ROOT.'/Assets/Repository/UserRepository.php');
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
    <?php
        if(isset($_POST['reg'])){
            $User = new User();
            $User->Login = $_POST['login'];
            $User->Name = $_POST['username'];
            $User->Password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            if($User->Password == $password_confirm){
                $res = UserRepository::addUser($User);
                if (is_numeric($res)) {
                    echo "<script>console.log(Success.)</script>";
                }
                else
                    echo "<script>console.log(Fail.)</script>";
            }
            else{
                echo "<script>console.log(Passwords are not equals.)</script>";
            }

            //if (isset($_GET['s']) && !empty($_GET['s']))
             //   echo 'Данные успешно обновлены';
        }

    ?>
    <form class="reg-block" method="POST" id="reg-block">
        <div class="reg-block__caption">Join us</div>
        <input class="reg-block__input " type="text" placeholder="Enter email" name="login" autocomplete="off" required/>
        <input class="reg-block__input " type="text" placeholder="Enter username" name="username" autocomplete="off" required/>
        <input class="reg-block__input " type="password" placeholder="Enter password" name="password" autocomplete="off" required/>
        <input class="reg-block__input " type="password" placeholder="Again, password" name="password_confirm" autocomplete="off" required/>
        <input class="reg-block__input reg-block__submit" type="submit" value="Register" name="reg"/>
    </form>
</main>
<script src="/Assets/js/libs.min.js"></script>
<script>
    $('#reg-block').on('submit', function(e){
        e.preventDefault();
    })
</script>
</body>
</html>