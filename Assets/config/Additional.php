<?php
function render($view = '/Views/Index/index.php'){
    include_once(ROOT."/Views/include/header.php");
    include_once(ROOT.$view);
    include_once(ROOT."/Views/include/footer.php");
}