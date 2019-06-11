<?php
session_start();?>
<main class="info-block">
        <div class="centered">
            <form id="addLiterature" class="formAdd" method="POST" action="/hint/add/">
                <input type="text" name="hint" placeholder="Подсказка"/>
                <input type="text" name="id_checkmate" placeholder="Ид шах и мата"/>
                <input type="text" name="id_puzzle" placeholder="Ид головоломки"/>
                <input type="submit" value="Сохранить"/>
            </form>
        </div>
</main>