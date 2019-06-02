<?php
session_start();
$chessman = $_SESSION['chessman'];?>
<main class="info-block">
    <? require_once("/../include/board.php");?>
    <div class="support">
        <div class="centered">
            <form id="checkPuzzle" method="POST" action="/puzzle/check/">
                <h3>Найдите лучший ход за <?=$_SESSION['side'] == '1' ? 'белых' : 'черных'?></h3>
                <table>
                    <thead>
                        <tr>
                            <td>№ хода</td>
                            <td>Начальная позиция</td>
                            <td>Конечная позиция</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?$turn_number = 1 + ($_SESSION['check_puzzle']->num_rows >> 1);?>
                    <?for($i = 0; $i < $turn_number; $i++):?>
                        <tr id="turn<?=$i?>">
                            <td><p><?=$i+1?> ход</p></td>
                            <td><input id="start_position<?=$i?>" name="start_position['<?=$i?>']"/></td>
                            <td><input id="ending_position<?=$i?>" name="ending_position['<?=$i?>']"/></td>
                        </tr>
                    <?endfor;?>
                    </tbody>
                </table>
                <input type="hidden" name="turn_number" value="<?=$turn_number?>">
                <input type="submit" value="Проверить"/>
            </form>
            <a href="/puzzle/">Вернуться назад</a>
        </div>
    </div>
</main>