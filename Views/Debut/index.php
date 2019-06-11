<main class="info-block">
    <?$debuts = $_SESSION['debuts'];?>
    <div class="list centered">
    <?while($debut = $debuts->fetch_array()):?>
        <div class="game element-list" data-id="<?=$debut['id_debut']?>">
            <div class="debut-head"><?=$debut['name']?></div>
            <div class="debut-difficulty"><?=$debut['difficulty']?></div>
            <?if(!empty($_SESSION['id']) and in_array($debut['id_debut'],$_SESSION['view_debut'])):?>
                <div class="debut-view">Просмотрено</div>
            <?endif;?>
        </div>
    <?endwhile;?>
    </div>
</main>