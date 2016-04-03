var path = window.location.pathname;
var page = path.substring(path.lastIndexOf('/') + 1);


$(document).ready(function(){


    if(page == 'forgottenPasswordPage.php') {

        $('#email_group:has(div[id=errors])').find('#email').keyup(function () {
            $('#email_group > #errors > #error_required').removeClass('error').addClass('hide');
        });

    }




});


