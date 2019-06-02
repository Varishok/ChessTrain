<?php
session_start();
$add = true;?>
<main class="info-block">
    <? require_once("/../include/board.php");?>
    <div class="support">
        <div class="centered">
            <? include_once("/../include/pawn.php");?>
            <form id="addBoard" method="POST" action="/turn/add/">
                <input type="submit" value="Сохранить"/>
            </form>
        </div>
    </div>
</main>