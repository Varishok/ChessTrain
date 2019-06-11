<main class="info-block">
    <?$games = $_SESSION['games'];?>
    <div class="list centered">
    <?while($game = $games->fetch_array()):?>
        <div class="game element-list" data-id="<?=$game['id_game']?>">
            <div class="game-head"><?=$game['name']?></div>
            <div class="game-date"><?=date('d.m.Y', strtotime($game['date']))?></div>
            <?if(!empty($_SESSION['id']) and in_array($game['id_game'],$_SESSION['view_game'])):?>
                <div class="game-view">Просмотрено</div>
            <?endif;?>
        </div>
    <?endwhile;?>
    </div>
</main>