$(function(){

    $('.reg-block__email').on('change', function(){
        checkReadyToReg();
    });
    $('.reg-block__username').on('change', function(){
        checkReadyToReg();
    });
    $('.reg-block__password').on('change', function(){
        checkReadyToReg();
    });
    $('.reg-block__password2').on('change', function(){
        checkReadyToReg();
    });


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
});