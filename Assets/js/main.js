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
    var board = $('.chess-board'), F = 0, activePawn = null, pawnH1 = null, pawnH2 = null;
    $('td').click(function(e) {
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
                alert( "Data Saved: " + msg );
            },
        });
    });
});
