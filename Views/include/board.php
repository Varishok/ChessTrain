<div class="box">
    <div class="centered">
        <?if(empty($add) && empty($chessman)):?>
        <table class="chess-board default">
           <tbody>
            <tr>
                 <th></th>
                 <th>a</th>
                 <th>b</th>
                 <th>c</th>
                 <th>d</th>
                 <th>e</th>
                 <th>f</th>
                 <th>g</th>
                 <th>h</th>
            </tr>
            <tr>
                 <th>8</th>
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
                 <th>7</th>
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
                 <th>6</th>
                 <td class="white" id="a6"></td>
                 <td class="black" id="b6"></td>
                 <td class="white" id="c6"></td>
                 <td class="black" id="d6"></td>
                 <td class="white" id="e6"></td>
                 <td class="black" id="f6"></td>
                 <td class="white" id="g6"></td>
                 <td class="black" id="h6"></td>
            </tr>
            <tr>
                 <th>5</th>
                 <td class="black" id="a5"></td>
                 <td class="white" id="b5"></td>
                 <td class="black" id="c5"></td>
                 <td class="white" id="d5"></td>
                 <td class="black" id="e5"></td>
                 <td class="white" id="f5"></td>
                 <td class="black" id="g5"></td>
                 <td class="white" id="h5"></td>
            </tr>
            <tr>
                 <th>4</th>
                 <td class="white" id="a4"></td>
                 <td class="black" id="b4"></td>
                 <td class="white" id="c4"></td>
                 <td class="black" id="d4"></td>
                 <td class="white" id="e4"></td>
                 <td class="black" id="f4"></td>
                 <td class="white" id="g4"></td>
                 <td class="black" id="h4"></td>
            </tr>
            <tr>
                 <th>3</th>
                 <td class="black" id="a3"></td>
                 <td class="white" id="b3"></td>
                 <td class="black" id="c3"></td>
                 <td class="white" id="d3"></td>
                 <td class="black" id="e3"></td>
                 <td class="white" id="f3"></td>
                 <td class="black" id="g3"></td>
                 <td class="white" id="h3"></td>
            </tr>
            <tr>
                 <th>2</th>
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
                 <th>1</th>
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
        <?elseif($add):?>
        <table class="chess-board support">
           <tbody>
            <tr>
                 <th></th>
                 <th>a</th>
                 <th>b</th>
                 <th>c</th>
                 <th>d</th>
                 <th>e</th>
                 <th>f</th>
                 <th>g</th>
                 <th>h</th>
            </tr>
            <tr>
                 <th>8</th>
                 <td class="white" id="a8"></td>
                 <td class="black" id="b8"></td>
                 <td class="white" id="c8"></td>
                 <td class="black" id="d8"></td>
                 <td class="white" id="e8"></td>
                 <td class="black" id="f8"></td>
                 <td class="white" id="g8"></td>
                 <td class="black" id="h8"></td>
            </tr>
            <tr>
                 <th>7</th>
                 <td class="black" id="a7"></td>
                 <td class="white" id="b7"></td>
                 <td class="black" id="c7"></td>
                 <td class="white" id="d7"></td>
                 <td class="black" id="e7"></td>
                 <td class="white" id="f7"></td>
                 <td class="black" id="g7"></td>
                 <td class="white" id="h7"></td>
            </tr>
            <tr>
                 <th>6</th>
                 <td class="white" id="a6"></td>
                 <td class="black" id="b6"></td>
                 <td class="white" id="c6"></td>
                 <td class="black" id="d6"></td>
                 <td class="white" id="e6"></td>
                 <td class="black" id="f6"></td>
                 <td class="white" id="g6"></td>
                 <td class="black" id="h6"></td>
            </tr>
            <tr>
                 <th>5</th>
                 <td class="black" id="a5"></td>
                 <td class="white" id="b5"></td>
                 <td class="black" id="c5"></td>
                 <td class="white" id="d5"></td>
                 <td class="black" id="e5"></td>
                 <td class="white" id="f5"></td>
                 <td class="black" id="g5"></td>
                 <td class="white" id="h5"></td>
            </tr>
            <tr>
                 <th>4</th>
                 <td class="white" id="a4"></td>
                 <td class="black" id="b4"></td>
                 <td class="white" id="c4"></td>
                 <td class="black" id="d4"></td>
                 <td class="white" id="e4"></td>
                 <td class="black" id="f4"></td>
                 <td class="white" id="g4"></td>
                 <td class="black" id="h4"></td>
            </tr>
            <tr>
                 <th>3</th>
                 <td class="black" id="a3"></td>
                 <td class="white" id="b3"></td>
                 <td class="black" id="c3"></td>
                 <td class="white" id="d3"></td>
                 <td class="black" id="e3"></td>
                 <td class="white" id="f3"></td>
                 <td class="black" id="g3"></td>
                 <td class="white" id="h3"></td>
            </tr>
            <tr>
                 <th>2</th>
                 <td class="white" id="a2"></td>
                 <td class="black" id="b2"></td>
                 <td class="white" id="c2"></td>
                 <td class="black" id="d2"></td>
                 <td class="white" id="e2"></td>
                 <td class="black" id="f2"></td>
                 <td class="white" id="g2"></td>
                 <td class="black" id="h2"></td>
            </tr>
            <tr>
                 <th>1</th>
                 <td class="black" id="a1"></td>
                 <td class="white" id="b1"></td>
                 <td class="black" id="c1"></td>
                 <td class="white" id="d1"></td>
                 <td class="black" id="e1"></td>
                 <td class="white" id="f1"></td>
                 <td class="black" id="g1"></td>
                 <td class="white" id="h1"></td>
            </tr>
           </tbody>
        </table>
        <?else:?>
        <table class="chess-board turn">
            <tbody>
            <tr>
                 <th></th>
                 <th>a</th>
                 <th>b</th>
                 <th>c</th>
                 <th>d</th>
                 <th>e</th>
                 <th>f</th>
                 <th>g</th>
                 <th>h</th>
            </tr>
            <tr>
                 <th>8</th>
                 <td class="white" id="a8"></td>
                 <td class="black" id="b8"></td>
                 <td class="white" id="c8"></td>
                 <td class="black" id="d8"></td>
                 <td class="white" id="e8"></td>
                 <td class="black" id="f8"></td>
                 <td class="white" id="g8"></td>
                 <td class="black" id="h8"></td>
            </tr>
            <tr>
                 <th>7</th>
                 <td class="black" id="a7"></td>
                 <td class="white" id="b7"></td>
                 <td class="black" id="c7"></td>
                 <td class="white" id="d7"></td>
                 <td class="black" id="e7"></td>
                 <td class="white" id="f7"></td>
                 <td class="black" id="g7"></td>
                 <td class="white" id="h7"></td>
            </tr>
            <tr>
                 <th>6</th>
                 <td class="white" id="a6"></td>
                 <td class="black" id="b6"></td>
                 <td class="white" id="c6"></td>
                 <td class="black" id="d6"></td>
                 <td class="white" id="e6"></td>
                 <td class="black" id="f6"></td>
                 <td class="white" id="g6"></td>
                 <td class="black" id="h6"></td>
            </tr>
            <tr>
                 <th>5</th>
                 <td class="black" id="a5"></td>
                 <td class="white" id="b5"></td>
                 <td class="black" id="c5"></td>
                 <td class="white" id="d5"></td>
                 <td class="black" id="e5"></td>
                 <td class="white" id="f5"></td>
                 <td class="black" id="g5"></td>
                 <td class="white" id="h5"></td>
            </tr>
            <tr>
                 <th>4</th>
                 <td class="white" id="a4"></td>
                 <td class="black" id="b4"></td>
                 <td class="white" id="c4"></td>
                 <td class="black" id="d4"></td>
                 <td class="white" id="e4"></td>
                 <td class="black" id="f4"></td>
                 <td class="white" id="g4"></td>
                 <td class="black" id="h4"></td>
            </tr>
            <tr>
                 <th>3</th>
                 <td class="black" id="a3"></td>
                 <td class="white" id="b3"></td>
                 <td class="black" id="c3"></td>
                 <td class="white" id="d3"></td>
                 <td class="black" id="e3"></td>
                 <td class="white" id="f3"></td>
                 <td class="black" id="g3"></td>
                 <td class="white" id="h3"></td>
            </tr>
            <tr>
                 <th>2</th>
                 <td class="white" id="a2"></td>
                 <td class="black" id="b2"></td>
                 <td class="white" id="c2"></td>
                 <td class="black" id="d2"></td>
                 <td class="white" id="e2"></td>
                 <td class="black" id="f2"></td>
                 <td class="white" id="g2"></td>
                 <td class="black" id="h2"></td>
            </tr>
            <tr>
                 <th>1</th>
                 <td class="black" id="a1"></td>
                 <td class="white" id="b1"></td>
                 <td class="black" id="c1"></td>
                 <td class="white" id="d1"></td>
                 <td class="black" id="e1"></td>
                 <td class="white" id="f1"></td>
                 <td class="black" id="g1"></td>
                 <td class="white" id="h1"></td>
            </tr>
           </tbody>
        </table>
        <script>
            var d;
            <?if(is_array($chessman)):?>
                <?foreach ($chessman as $pawn):?>
                    d = document.getElementById("<?=$pawn->Position;?>");
                    d.className += " <?=$pawn->Side;?>-<?=$pawn->Name;?>";
                <?endforeach;?>
            <?else:?>
                d = document.getElementById("<?=$chessman->Position;?>");
                d.className += " <?=$chessman->Side;?>-<?=$chessman->Name;?>";
            <?endif;?>
        </script>
        <?endif;?>
    </div>
</div>