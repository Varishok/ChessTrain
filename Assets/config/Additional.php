<?php
function render($view = '/Views/Index/index.php'){
    include(ROOT."/Views/include/header.php");
    include(ROOT.$view);
    include(ROOT."/Views/include/footer.php");
}