<?session_start()?>
<div class="support">
    <div class="centered">
        <?if($_SESSION['add']):?>
        <table class="chess-board">
           <tbody>
            <tr>
                 <td class="white black-rook " id="a8"></td>
                 <td class="black black-knight" id="b8"></td>
                 <td class="white black-bishop" id="c8"></td>
                 <td class="black black-queen" id="d8"></td>
                 <td class="white black-king" id="e8"></td>
                 <td class="black black-bishop" id="f8"></td>
                 <td class="white black-knight" id="g8"></td>
                 <td class="black black-rook" id="h8"></td>
            </tr>
            <tr>
                 <td class="black black-pawn" id="a7"></td>
                 <td class="white black-pawn" id="b7"></td>
                 <td class="black black-pawn" id="c7"></td>
                 <td class="white black-pawn" id="d7"></td>
                 <td class="black black-pawn" id="e7"></td>
                 <td class="white black-pawn" id="f7"></td>
                 <td class="black black-pawn" id="g7"></td>
                 <td class="white black-pawn" id="h7"></td>
            </tr>
            <tr>
                 <td class="white white-pawn" id="a2"></td>
                 <td class="black white-pawn" id="b2"></td>
                 <td class="white white-pawn" id="c2"></td>
                 <td class="black white-pawn" id="d2"></td>
                 <td class="white white-pawn" id="e2"></td>
                 <td class="black white-pawn" id="f2"></td>
                 <td class="white white-pawn" id="g2"></td>
                 <td class="black white-pawn" id="h2"></td>
            </tr>
            <tr>
                 <td class="black white-rook" id="a1"></td>
                 <td class="white white-knight" id="b1"></td>
                 <td class="black white-bishop" id="c1"></td>
                 <td class="white white-queen" id="d1"></td>
                 <td class="black white-king" id="e1"></td>
                 <td class="white white-bishop" id="f1"></td>
                 <td class="black white-knight" id="g1"></td>
                 <td class="white white-rook" id="h1"></td>
            </tr>
           </tbody>
        </table>
        <form id="addBoard" method="POST" action="/turn/add/">
            <input type="submit" value="Сохранить"/>
        </form>
        <?endif;?>
    </div>
</div>