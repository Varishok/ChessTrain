<?php
session_start();?>
<main class="info-block">
    <? require_once("/../include/board.php");?>
    <div class="support">
        <div class="centered">
            <form id="addGame" class="formAdd" method="POST" action="/game/add/">
                <div id="turns"></div>
                <a id="input-add">Добавить ход</a>
                <a id="input-delete">Удалить ход</a>
                <div>
                    <input type="text" name="name" placeholder="Имя игры"/>
                    <input type="date" name="date"/>
                    <input type="text" name="description" placeholder="Описание игры"/>
                </div>
                <div>
                    <input type="text" name="id_game" placeholder="id игры"/>
                    <input type="submit" value="Сохранить"/>
                </div>
            </form>
        </div>
    </div>
</main>