var path = window.location.pathname;
var page = path.substring(path.lastIndexOf('/') + 1);


$(document).ready(function(){

    if(page == 'registrationPage.php' || page == 'updateRegDetailsPage.php'){
        $('#email_group:has(div[id=errors])').find('#email').keyup(function(){
            $('#email_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#email_group > #errors > #error_regex').removeClass('error').addClass('hide');
                $.ajax({
                    type: "post",
                    url: "scripts/checkIfEmailIsRegistered.php",
                    data: {email: input},
                    dataType: "text",
                    success: function (response) {
                        var result = parseInt(response);
                        if (result) {
                            $('#email_group > #errors > #error_unique').removeClass('hide').addClass('error');
                        }
                        else {
                            $('#email_group > #errors > #error_unique').removeClass('error').addClass('hide');
                            var confirmEmail = $('#confirm_email').val();
                            if (confirmEmail.length > 0) {
                                if (input != confirmEmail) {
                                    $('#confirm_email_group > #errors > #error_regex').removeClass('hide').addClass('error');
                                }
                                else {
                                    $('#confirm_email_group > #errors > #error_regex').removeClass('error').addClass('hide');
                                }
                            }
                        }
                    }
                });
            }
            else {
                $('#email_group > #errors > #error_unique').removeClass('error').addClass('hide');
                $('#email_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
        });

        $('#confirm_email_group:has(div[id=errors])').find('#confirm_email').keyup(function(){
            $('#confirm_email_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            if (input != $('#email').val()) {
                $('#confirm_email_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
            else {
                $('#confirm_email_group > #errors > #error_regex').removeClass('error').addClass('hide');
            }
        });
    }

    if(page == 'registrationPage.php' || page == 'updateRegDetailsPage.php'){
        $('#username_group:has(div[id=errors])').find('#username').keyup(function(){
            $('#username_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^[a-zA-Z0-9_-]{3,32}$/;
            var valid = pattern.test(input);
            if(valid){
                $('#username_group > #errors > #error_regex').removeClass('error').addClass('hide');
                $.ajax({
                    type: "post",
                    url: "scripts/checkUsernameAvailability.php",
                    data: {username: input},
                    dataType: "text",
                    success: function (response) {
                        var result = parseInt(response);
                        if (result) {
                            $('#username_group > #errors > #error_regex').removeClass('error').addClass('hide');
                            $('#username_group > #errors > #error_unique').removeClass('hide').addClass('error');
                        }
                        else {
                            $('#username_group > #errors > #error_unique').removeClass('error').addClass('hide');
                        }
                    }
                });
            }
            else {
                $('#username_group > #errors > #error_unique').removeClass('error').addClass('hide');
                $('#username_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }

        });
    }

    if(page == 'registrationPage.php' || page == 'updateRegDetailsPage.php' || page == 'updateRegDetailsPage.php') {
        $('#first_name_group:has(div[id=errors])').find('#first_name').keyup(function () {
            $('#first_name_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^[a-zA-Z]{2,32}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#first_name_group > #errors > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#first_name_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
        });

        $('#last_name_group:has(div[id=errors])').find('#last_name').keyup(function(){
            $('#last_name_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^[a-zA-Z'-]{2,32}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#last_name_group > #errors > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#last_name_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
        });
    }

    if(page == 'registrationPage.php'){
        $('#password_group:has(div[id=errors])').find('#password').keyup(function(){
            $('#password_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^[a-zA-Z0-9_-]{6,32}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#password_group > #errors > #error_regex').removeClass('error').addClass('hide');
                var confirmPassword = $('#confirm_password').val();
                if (confirmPassword.length > 0) {
                    if (input != confirmPassword) {
                        $('#confirm_password_group > #errors > #error_regex').removeClass('hide').addClass('error');
                    }
                    else {
                        $('#confirm_password_group > #errors > #error_regex').removeClass('error').addClass('hide');
                    }
                }
            }
            else {
                $('#password_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
        });

        $('#confirm_password_group:has(div[id=errors])').find('#confirm_password').keyup(function(){
            $('#confirm_password_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            if (input != $('#password').val()) {
                $('#confirm_password_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
            else {
                $('#confirm_password_group > #errors > #error_regex').removeClass('error').addClass('hide');
            }
        });
    }

    if(page == 'registrationPage.php' || page == 'updateRegDetailsPage.php') {
        $('#dob_group:has(div[id=errors])').find('#dob').change(function () {
            $('#dob_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var today = new Date();
            var dob = new Date(input);
            var age = today.getFullYear() - dob.getFullYear();
            var m = today.getMonth() - dob.getMonth();
            if (m < 0 || (m == 0 && today.getDate() < dob.getDate())) {
                age--;
            }
            if (age < 18) {
                $('#dob_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
            else {
                $('#dob_group > #errors > #error_regex').removeClass('error').addClass('hide');
            }
        });
    }
});