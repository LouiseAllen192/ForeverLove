var path = window.location.pathname;
var page = path.substring(path.lastIndexOf('/') + 1);


$(document).ready(function(){


    if(page == 'updatePassword.php') {

        $('#old_password_group:has(div[id=errors])').find('#old_password').keyup(function(){
            $('#old_password_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^[a-zA-Z0-9_-]{6,32}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#old_password_group > #errors > #error_regex').removeClass('error').addClass('hide');
                var confirmPassword = $('#old_password_confirm').val();
                if (confirmPassword.length > 0) {
                    if (input != confirmPassword) {
                        $('#old_password_confirm_group > #errors > #error_regex').removeClass('hide').addClass('error');
                    }
                    else {
                        $('#old_password_confirm_group > #errors > #error_regex').removeClass('error').addClass('hide');
                    }
                }
            }
            else {
                $('#old_password_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
        });

        $('#old_password_confirm_group:has(div[id=errors])').find('#old_password_confirm').keyup(function(){
            $('#old_password_confirm__group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            if (input != $('#old_password').val()) {
                $('#old_password_confirm__group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
            else {
                $('#old_password_confirm__group > #errors > #error_regex').removeClass('error').addClass('hide');
            }
        });
    }

    if(page == 'updatePassword.php'){

        $('#new_password_group:has(div[id=errors])').find('#new_password').keyup(function(){
            $('#new_password_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^[a-zA-Z0-9_-]{6,32}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#new_password_group > #errors > #error_regex').removeClass('error').addClass('hide');
                var confirmPassword = $('#new_password_confirm_group').val();
                if (confirmPassword.length > 0) {
                    if (input != confirmPassword) {
                        $('#new_password_confirm_group > #errors > #error_regex').removeClass('hide').addClass('error');
                    }
                    else {
                        $('#new_password_confirm_group > #errors > #error_regex').removeClass('error').addClass('hide');
                    }
                }
            }
            else {
                $('#new_password_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
        });

        $('#new_password_confirm_group:has(div[id=errors])').find('#new_password_confirm').keyup(function(){
            $('#new_password_confirm_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            if (input != $('#new_password').val()) {
                $('#new_password_confirm_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
            else {
                $('#new_password_confirm_group > #errors > #error_regex').removeClass('error').addClass('hide');
            }
        });


    }




});
