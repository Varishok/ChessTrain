<main class="info-block">
    <?$puzzles = $_SESSION['puzzles'];?>
    <div class="list centered">
    <?while($puzzle = $puzzles->fetch_array()):?>
        <div class="puzzle element-list" data-id="<?=$puzzle['id_puzzle']?>">
            <div class="puzzle-head"><?=$puzzle['name']?></div>
            <div class="puzzle-difficulty"><?=$puzzle['difficulty']?></div>
            <div class="puzzle-side"><?=$puzzle['id_side'] == '1' ? 'Белые' : 'Черные'?></div>
        </div>
    <?endwhile;?>
    </div>
</main>