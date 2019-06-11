<main class="info-block">
    <?$puzzles = $_SESSION['puzzles'];?>
    <div class="list centered">
    <?while($puzzle = $puzzles->fetch_array()):?>
        <div class="puzzle element-list game" data-id="<?=$puzzle['id_puzzle']?>">
            <div class="puzzle-head"><?=$puzzle['name']?></div>
            <div class="puzzle-difficulty"><?=$puzzle['difficulty']?></div>
            <div class="puzzle-side"><?=$puzzle['id_side'] == '1' ? 'Белые' : 'Черные'?></div>
            <?if(!empty($_SESSION['id']) and in_array($puzzle['id_puzzle'],$_SESSION['view_puzzle'])):?>
                <div class="puzzle-view">Просмотрено</div>
            <?endif;?>
        </div>
    <?endwhile;?>
    </div>
</main>