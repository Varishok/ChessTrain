<main class="info-block">
    <?$checkmates = $_SESSION['checkmates'];?>
    <div class="list centered">
    <?while($checkmate = $checkmates->fetch_array()):?>
        <div class="checkmate element-list game" data-id="<?=$checkmate['id_checkmate']?>">
            <div class="checkmate-head"><?=$checkmate['name']?></div>
            <div class="checkmate-difficulty"><?=$checkmate['difficulty']?></div>
            <div class="checkmate-side"><?=$checkmate['id_side'] == '1' ? 'Белые' : 'Черные'?></div>
            <?if(!empty($_SESSION['id']) and in_array($checkmate['id_checkmate'],$_SESSION['view_checkmate'])):?>
                <div class="checkmate-view">Просмотрено</div>
            <?endif;?>
        </div>
    <?endwhile;?>
    </div>
</main>