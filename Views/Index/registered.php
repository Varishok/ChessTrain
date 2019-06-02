<div class="modal_login">
    <form class="modal-window modal-login" method="POST" action="/userreg/">
        <div class="modal-login__caption">Зарегестрироваться</div>
        <input class="reg-block__input modal-login__input" type="text" placeholder="Введите логин" name="login" autocomplete="off" required/>
        <input class="reg-block__input modal-login__input" type="text" placeholder="Введите e-mail" name="email" autocomplete="off" required/>
        <input class="reg-block__input modal-login__input" type="password" placeholder="Введите пароль" name="password" autocomplete="off" required/>
        <input class="reg-block__input modal-login__input" type="password" placeholder="Подтвердите пароль" name="password_sec" autocomplete="off" required/>
        <input class="modal-login__input modal-login__submit" type="submit" value="Зарегестрироваться" name="log_in"/>
        <return> </return>
    </form>
</div>