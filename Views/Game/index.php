<main class="info-block">
    <?$games = $_SESSION['games'];?>
    <div class="list centered">
    <?while($game = $games->fetch_array()):?>
        <div class="game element-list" data-id="<?=$game['id_game']?>">
            <div class="checkmate-head"><?=$game['name']?></div>
            <div class="checkmate-date"><?=date('d.m.Y', strtotime($game['date']))?></div>
        </div>
    <?endwhile;?>
    </div>
</main>