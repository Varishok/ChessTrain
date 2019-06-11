$(function(){


    function checkReadyToReg(){
        var email = $('.reg-block__email').val();
        var username = $('.reg-block__username').val();
        var pass = $('.reg-block__password').val();
        var pass2 = $('.reg-block__password2').val();

        var emailValid = false;
        var usernameValid = false;
        var passValid = false;
        var pass2Valid = false;

        if(validateEmail(email)){
            emailValid = true;
        }
        if(username.length > 3 && username.length < 50) {
            usernameValid = true;
        }
        if(pass.length  >= 6 && pass.length  < 32) {
            passValid = true;
        }
        if(pass === pass2) {
            pass2Valid = true;
        }

        if(emailValid && usernameValid && passValid && pass2Valid) {
            $('.reg-block__submit').removeAttr('disabled');
        } else {
            $('.reg-block__submit').attr('disabled', "true");
        }
    }
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    
    //Chess Board
    var board = $('.chess-board'), F = 0, activePawn = null, pawnH1 = null, pawnH2 = null, counter = 0;
    function NextTurn(){
        /*$(board).filter('.default').find('td').click(function(e) {
            if(F==0){
                var theClass = $(this).attr('class');
                var theClasses = theClass.match(/\w+|"[^"]+"/g);
                if(theClasses[2]){
                    $(this).toggleClass('active');
                    F = 1;
                    activePawn = theClasses[1] + '-' + theClasses[2];
                    pawnH1 = $(this);
                }
            }else{
                F = 0;
                var theClass = $(this).attr('class');
                var theClasses = theClass.match(/\w+|"[^"]+"/g);
                if(theClasses[2]){
                    $(this).toggleClass(theClasses[1] + '-' + theClasses[2]);
                }
                pawnH1.toggleClass('active');
                pawnH1.toggleClass(activePawn);
                $(this).toggleClass(activePawn);
                activePawn = null, pawnH1 = null;
            }
        });*/
    };
    $('.chess-board').filter('.support').find('td').click(function(e) {
        if(F==0){
            var theClass = $(this).attr('class');
            var theClasses = theClass.match(/\w+|"[^"]+"/g);
            if(theClasses[2]){
                $(this).toggleClass('active');
                F = 1;
                activePawn = theClasses[1] + '-' + theClasses[2];
                pawnH1 = $(this);
            }else{
                $(this).toggleClass('active');
            }
        }else{
            F = 0;
            pawnH1.toggleClass('active');
            pawnH1.toggleClass(activePawn);
            $(this).toggleClass(activePawn);
            activePawn = null, pawnH1 = null;
        }
    });
    $('.clear').click(function (e) {
        e.preventDefault();
        for(var i = 0; i <= 5; i++){
            document.getElementById("m"+i).innerHTML = "<br>";
        }
        K = "";
        N = 1;
    })
    $('.chess-board').filter('.turn').find('td').click(function(e) {
        var theClass = $(this).attr('class');
        var theClasses = theClass.match(/\w+|"[^"]+"/g);
        if(theClasses[2]){}
        else{
            $(this).toggleClass('active');
        }
    });
    //For turn
    $('#addBoard').submit(function(e) {
        e.preventDefault();
        var values = {};
        $(board[0]).find('td').each(function() { 
            values[$(this).attr('id')]=$(this).attr('class'); 
        });
        $.ajax({
            method: "POST",
            url: $(this).attr('action'),
            dataType: "json",
            data: values,
            success: function(msg){
                console.log(msg);
            },
        });
    });
    $('.check_turn').submit(function(e) {
        e.preventDefault();
        var values = {'move':[]};
        $(board[0]).find('.active').each(function() { 
            values.move.push($(this).attr('id')); 
        });
        $.ajax({
            method: "POST",
            url: $(this).attr('action'),
            dataType: "json",
            data: values,
            success: function(msg){
                $('table.answer').html(msg);
            },
        });
    });
    //For Puzzle
    $('#addPuzzle').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var values = {};
        var id_puzzle = $(this).find("input[name=id_puzzle]").val();
        if(id_puzzle !== ''){
            values['id_puzzle'] = id_puzzle;
            values['side'] = {};
            values['pawn'] = {};
            values['start_position'] = {};
            values['ending_position'] = {};
            values['turn_number'] = {};
            for(var i = 0;i < counter; i++){
                values['side'][i] = $(this).find("#side"+i).val();
                values['pawn'][i] = $(this).find("#pawn"+i).val();
                values['start_position'][i] = $(this).find("#start_position"+i).val();
                values['ending_position'][i] = $(this).find("#ending_position"+i).val();
                values['turn_number'][i] = $(this).find("#turn_number"+i).val();
            }
        }else{
            $(board[0]).find('td').each(function() {
                values[$(this).attr('id')]=$(this).attr('class');
            });
        }
        $.ajax({
            method: "POST",
            url: url,
            dataType: "json",
            data: values,
            success: function(msg){
                console.log(msg);
                $(this).find("input[name=id_puzzle]").val(msg[0]);
            },
        });
    });
    $('#input-add').click(function (e) {
        e.preventDefault();
        if(counter === 0){
            var header = '' +
                ''
        };
        var tpl = '<div id="turn'+ counter +'"> \
                <select id="side'+ counter +'" name=\"side['+ counter +']\"> \
                    <option value=\"white\">Белая фигура</option> \
                    <option value=\"black\">Черная фигура</option> \
                </select> \
                <select id="pawn'+ counter +'" name=\"pawn['+ counter +']\"> \
                    <option value=\"5\">Ладья</option> \
                    <option value=\"4\">Конь</option> \
                    <option value=\"3\">Слон</option> \
                    <option value=\"2\">Королева</option> \
                    <option value=\"1\">Король</option> \
                    <option value=\"6\">Пешка</option> \
                </select> \
                <input id="start_position'+ counter +'" name=\"start_position['+ counter +']\" /> \
                <input id="ending_position'+ counter +'" name=\"ending_position['+ counter +']\" /> \
                <input id="turn_number'+ counter +'" name=\"turn_number['+ counter +']\" /> \
            </div>';
        $('#turns').append(tpl);
        counter++;
    });
    $('#input-delete').click(function (e) {
        e.preventDefault();
        counter--;
        $('#turn'+ counter).remove();
    });

    $('.game').click(function () {
        var id = $(this).data('id');
        window.location.href = window.location.href + id + '/';
    });

    $('#checkPuzzle').submit(function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var turn_number = Number($(this).find('input[name=turn_number]').val());
        var values = {};
        values['start_position'] = {};
        values['ending_position'] = {};
        for(var i = 0;i < turn_number; i++){
            values['start_position'][i] = $(this).find("#start_position"+i).val();
            values['ending_position'][i] = $(this).find("#ending_position"+i).val();
        }
        $.ajax({
            method: "POST",
            url: url,
            dataType: "json",
            data: values,
            success: function(res){
                for(var i = 1; i<=turn_number; i++){
                    if(res[i][0] == 'success'){
                        $('#turn'+(i-1)).find('p').attr('class','check-success');
                    }else{
                        $('#turn'+(i-1)).find('p').attr('class','check-error');
                        break;
                    }
                }
            },
        });
    });

    //For Checkmate
    $('#addCheckmate').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var values = {};
        var id_checkmate = $(this).find("input[name=id_checkmate]").val();
        if(id_checkmate !== ''){
            values['id_checkmate'] = id_checkmate;
            values['side'] = {};
            values['pawn'] = {};
            values['start_position'] = {};
            values['ending_position'] = {};
            values['turn_number'] = {};
            for(var i = 0;i < counter; i++){
                values['side'][i] = $(this).find("#side"+i).val();
                values['pawn'][i] = $(this).find("#pawn"+i).val();
                values['start_position'][i] = $(this).find("#start_position"+i).val();
                values['ending_position'][i] = $(this).find("#ending_position"+i).val();
                values['turn_number'][i] = $(this).find("#turn_number"+i).val();
            }
        }else{
            $(board[0]).find('td').each(function() {
                values[$(this).attr('id')]=$(this).attr('class');
            });
        }
        $.ajax({
            method: "POST",
            url: url,
            dataType: "json",
            data: values,
            success: function(msg){
                console.log(msg);
                $(this).find("input[name=id_checkmate]").val(msg[0]);
            },
        });
    });

    $('#checkCheckmate').submit(function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var turn_number = Number($(this).find('input[name=turn_number]').val());
        var values = {};
        values['start_position'] = {};
        values['ending_position'] = {};
        for(var i = 0;i < turn_number; i++){
            values['start_position'][i] = $(this).find("#start_position"+i).val();
            values['ending_position'][i] = $(this).find("#ending_position"+i).val();
        }
        $.ajax({
            method: "POST",
            url: url,
            dataType: "json",
            data: values,
            success: function(res){
                for(var i = 1; i<=turn_number; i++){
                    if(res[i][0] == 'success'){
                        $('#turn'+(i-1)).find('p').attr('class','check-success');
                    }else{
                        $('#turn'+(i-1)).find('p').attr('class','check-error');
                        break;
                    }
                }
            },
        });
    });

    //For Game
    $('.formAdd').submit(function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var values = $(this).serializeArray();
        $.ajax({
            method: "POST",
            url: url,
            dataType: "json",
            data: values,
            success: function(res){
                console.log(res);
                $(this).find("input[name=id_checkmate]").val(res[0]);
            },
        });
    });

    function Move(pawnH1, pawnH2, action = null){
        var activePawn = null;
        var theClass = pawnH1.attr('class');
        var theClasses = theClass.match(/\w+|"[^"]+"/g);
        if(theClasses[2]){
            activePawn = theClasses[1] + '-' + theClasses[2];
        } else {
            return false;
        }
        theClass = pawnH2.attr('class');
        theClasses = theClass.match(/\w+|"[^"]+"/g);
        if(theClasses[2]){
            pawnH2.toggleClass(theClasses[1] + '-' + theClasses[2]);
            var values = {"save": true};
            var position = document.location.pathname;
            var split = position.split('/');
            var url = "/" + split[1] +"/board/";
            values['turn'] = $('input[name=turn]').val();
            values['id_side'] = $('input[name=id_side]').val();
            values['pawn'] = theClasses[1] + '-' + theClasses[2];
            $.ajax({
                method: "POST",
                url: url,
                dataType: "html",
                data: values,
                success: function(res){
                    console.log(res);
                },
            });
        }
        pawnH1.toggleClass(activePawn);
        pawnH2.toggleClass(activePawn);
        if(action == 'O-O'){
            var id = pawnH2.attr('id');
            var char = id.charAt(1);
            console.log(char);
            Move($('#h'+char),$('#f'+char));
        }else if(action == 'O-O-O'){
            var id = pawnH2.attr('id');
            var char = id.charAt(1);
            Move($('#a'+char),$('#d'+char));
        }
        return true;
    };

    function MovePrev(pawnH1, pawnH2, action = null, pawn = null){
        var activePawn = null;
        var theClass = pawnH1.attr('class');
        var theClasses = theClass.match(/\w+|"[^"]+"/g);
        if(theClasses[2]){
            activePawn = theClasses[1] + '-' + theClasses[2];
        } else {
            return false;
        }
        theClass = pawnH2.attr('class');
        theClasses = theClass.match(/\w+|"[^"]+"/g);
        if(theClasses[2]){
            pawnH2.toggleClass(theClasses[1] + '-' + theClasses[2]);
        }
        pawnH1.toggleClass(activePawn);
        pawnH2.toggleClass(activePawn);
        pawnH1.toggleClass(pawn);
        if(action == 'O-O'){
            var id = pawnH2.attr('id');
            var char = id.charAt(1);
            console.log(char);
            Move($('#f'+char),$('#h'+char));
        }else if(action == 'O-O-O'){
            var id = pawnH2.attr('id');
            var char = id.charAt(1);
            Move($('#d'+char),$('#a'+char));
        }
        return true;
    };

    $('.default-board').click(function (e) {
        e.preventDefault();
        var values = {"board": true};
        var position = document.location.pathname;
        var split = position.split('/');
        var url = "/" + split[1] +"/board/";
        $.ajax({
            method: "POST",
            url: url,
            dataType: "html",
            data: values,
            success: function(res){
                console.log(res);
                $('.box').html(res);
                $('input[name=turn]').val(1);
                $('input[name=id_side]').val(1);
            },
        });
    });

    $('.default-prev').click(function (e) {
        e.preventDefault();
        var values = {"prev": true};
        values['turn'] = $('input[name=turn]').val();
        values['id_side'] = $('input[name=id_side]').val();
        var position = document.location.pathname;
        var split = position.split('/');
        var url = "/" + split[1] +"/board/";
        $.ajax({
            method: "POST",
            url: url,
            dataType: "json",
            data: values,
            success: function(res){
                if(res['ending_position']!==null){
                    MovePrev($('#'+res['ending_position']),$('#'+res['starting_position']),res['action'],res['pawn']);
                    if($('input[name=id_side]').val() == 1){
                        $('input[name=id_side]').val(2);
                        var count = $('input[name=turn]').val();
                        $('input[name=turn]').val(--count);
                    }else{
                        $('input[name=id_side]').val(1);
                    };
                }else{
                    alert("Начало партии")
                }
            },
        });
    });

    $('.default-next').click(function (e) {
        e.preventDefault();
        var values = {"next": true};
        values['turn'] = $('input[name=turn]').val();
        values['id_side'] = $('input[name=id_side]').val();
        var position = document.location.pathname;
        var split = position.split('/');
        var url = "/" + split[1] +"/board/";
        $.ajax({
            method: "POST",
            url: url,
            dataType: "json",
            data: values,
            success: function(res){
                if(res!==null){
                    Move($('#'+res['starting_position']),$('#'+res['ending_position']),res['action']);
                    if($('input[name=id_side]').val() == 1){
                        $('input[name=id_side]').val(2);
                    }else{
                        $('input[name=id_side]').val(1);
                        var count = $('input[name=turn]').val();
                        $('input[name=turn]').val(++count);
                    };
                }else{
                    alert("Ходы закончились")
                }
            },
        });
    });

    //Literature
    $('.simbol').click(function (e) {
        e.preventDefault();
        var simbol = $(this).attr('class');
        var favorit = simbol.split(" ");
        var values = {"favorit":favorit[1]};
        var div = $(this).parent();
        values['id'] = div.data('id');
        $.ajax({
            method: "POST",
            url: "/literature/favorit/",
            dataType: "json",
            data: values,
            success: function(res){
                console.log(res);
                if(res!==null){
                    if(res[0] == 'favorit'){
                        alert("Добавлено в избранное");
                    }else{
                        alert("Удалено из избранного");
                    }
                }else{
                    alert("Ходы закончились")
                }
            },
        });
    });

    //Hint
    $('#hint').click(function (e) {
        e.preventDefault();
        $('.hint').show();
        return true;
    });
});
