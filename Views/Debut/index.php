<main class="info-block">
    <? echo '1'; ?>
    <?$debuts = $_SESSION['debuts'];?>
    <div class="list centered">
    <?while($debut = $debuts->fetch_array()):?>
        <div class="game element-list" data-id="<?=$debut['id_debut']?>">
            <div class="checkmate-head"><?=$debut['name']?></div>
            <div class="checkmate-date"><?=$debut['difficulty']?></div>
        </div>
    <?endwhile;?>
    </div>
</main>