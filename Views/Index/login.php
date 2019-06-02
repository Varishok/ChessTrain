<div class="modal_login">
    <form class="modal-window modal-login" method="POST" action="/userlog/">
        <div class="modal-login__caption">Войти</div>
        <?if(!empty($_SESSION['error'])):?>
        <p class="error"><?=$_SESSION['error'];?></p>
        <?endif;?>
        <input class="reg-block__input modal-login__input" type="text" placeholder="Введите логин" name="login" autocomplete="off" required/>
        <input class="reg-block__input modal-login__input" type="password" placeholder="Введите пароль" name="password" autocomplete="off" required/>
        <input class="modal-login__input modal-login__submit" type="submit" value="Войти" name="log_in"/>
        <return> </return>
    </form>
</div>