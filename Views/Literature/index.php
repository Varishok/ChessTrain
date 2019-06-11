<main class="info-block">
    <?$literatures = $_SESSION['literatures'];?>
    <div class="list centered">
    <?foreach($literatures as $literature):?>
        <div class="literature element-list" data-id="<?=$literature->Id?>">
            <div class="checkmate-head"><?=$literature->Name?></div>
            <div class="checkmate-author"><?=$literature->Author?></div>
            <div class="checkmate-level"><?=$literature->PrefferedLevel?></div>
            <?if(!is_null($literature->Favorit)):?>
                <?if($literature->Favorit):?>
                    <div class="simbol favorit" title="Удалить из избранного"></div>
                <?else:?>
                    <div class="simbol not-favorit" title="Добавить в избранное"></div>
                <?endif;?>
            <?endif;?>
        </div>
    <?endforeach;?>
    </div>
</main>