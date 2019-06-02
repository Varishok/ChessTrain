<main class="info-block">
    <?$checkmates = $_SESSION['checkmates'];?>
    <div class="list centered">
    <?while($checkmate = $checkmates->fetch_array()):?>
        <div class="checkmate element-list" data-id="<?=$checkmate['id_checkmate']?>">
            <div class="checkmate-head"><?=$checkmate['name']?></div>
            <div class="checkmate-difficulty"><?=$checkmate['difficulty']?></div>
            <div class="checkmate-side"><?=$checkmate['id_side'] == '1' ? 'Белые' : 'Черные'?></div>
        </div>
    <?endwhile;?>
    </div>
</main>