<main class="info-block">
    <?$chessman = $_SESSION['chess_turn'];?>
    <?include("/../include/board.php");?>
    <?$res = $_SESSION['res'];
    $values = array();
    while($row = $res->fetch_array()){
        $values[] = $row['ending_position'];
    }
    $_SESSION['turn_check'] = $values;?>
    <div class="check_answer">
        <table class="answer">
        </table>
        <form class="check_turn" method="POST" action="/turn/check/"> 
            <button>Проверить</button>
        </form>
    <div>
</main>