<?php
session_start();
$add = true;?>
<main class="info-block">
    <? require_once("/../include/board.php");?>
    <div class="support">
        <div class="centered">
            <? include_once("/../include/pawn.php");?>
            <form id="addPuzzle" method="POST" action="/puzzle/add/">
                <div id="turns"></div>
                <a id="input-add">Добавить ход</a>
                <a id="input-delete">Удалить ход</a>
                <div>
                    <input type="text" name="id_puzzle" placeholder="id головоломки"/>
                    <input type="submit" value="Сохранить"/>
                </div>
            </form>
        </div>
    </div>
</main>