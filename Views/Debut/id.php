<?php
session_start();
$debut = $_SESSION['debut'];
$debut_turn = $_SESSION['debut_turn'];
?>
<main class="info-block">
    <? require_once("/../include/board.php");?>
    <div class="support">
        <div class="centered">
            <div class="game">
                <div class="game-head"><?=$debut['name']?></div>
                <div class="game-date"><?=$debut['difficulty']?></div>
                <div class="game-description"><?=$debut['description']?></div>
            </div>
            <div class="game-table-div">
                <table class="game-table">
                    <thead>
                        <tr>
                            <td>№ хода</td>
                            <td>Ход белых</td>
                            <td>Ход черных</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?for($i = 1; $i <= count($debut_turn); $i++):?>
                            <tr id="turn<?=$i?>">
                                <td><p><?=$i?> ход</p></td>
                                <td><p><?=$debut_turn[$i][1]['starting_position'] . " " . $debut_turn[$i][1]['ending_position'];?></p></td>
                                <td><p><?=$debut_turn[$i][2]['starting_position'] . " " . $debut_turn[$i][2]['ending_position'];?></p></td>
                            </tr>
                        <?endfor;?>
                    </tbody>
                </table>
            </div>
            <div class="game-div">
                <a class="default-board" href="" title="К началу партии">&laquo;</a>
                <a class="default-prev" href="" title="На ход назад">&lsaquo;</a>
                <a class="default-next" href="" title="На ход вперед">&rsaquo;</a>
                <input type="hidden" name="turn" value="1"/>
                <input type="hidden" name="id_side" value="1"/>
            </div>
            <a href="/debut/">Вернуться назад</a>
        </div>
    </div>
</main>