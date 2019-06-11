<?php
session_start();?>
<main class="info-block">
        <div class="centered">
            <form id="addLiterature" class="formAdd" method="POST" action="/literature/add/">
                <input type="text" name="name" placeholder="Имя книги"/>
                <input type="text" name="author" placeholder="Автор книги"/>
                <input type="text" name="level" placeholder="Предполагаемый уровень"/>
                <input type="submit" value="Сохранить"/>
            </form>
        </div>
</main>