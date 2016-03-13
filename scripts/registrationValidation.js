var path = window.location.pathname;
var page = path.substring(path.lastIndexOf('/') + 1);


$(document).ready(function(){

    if(page == 'registrationPage.php'){
        $('#Email_Group').find('#Email').keyup(function(){
            var input = $(this).val();
            var pattern = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#Email_Group > #Error_Regex').removeClass('error').addClass('hide');
                $.ajax({
                    type: "post",
                    url: "scripts/checkIfEmailIsRegistered.php",
                    data: {Email: input},
                    dataType: "text",
                    success: function (response) {
                        var result = parseInt(response);
                        if (result) {
                            $('#Email_Group > #Error_Unique').removeClass('hide').addClass('error');
                        }
                        else {
                            $('#Email_Group > #Error_Unique').removeClass('error').addClass('hide');
                            var confirmEmail = $('#Confirm_Email').val();
                            if (confirmEmail.length > 0) {
                                if (input != confirmEmail) {
                                    $('#Confirm_Email_Group > #Error_Regex').removeClass('hide').addClass('error');
                                }
                                else {
                                    $('#Confirm_Email_Group > #Error_Regex').removeClass('error').addClass('hide');
                                }
                            }
                        }
                    }
                });
            }
            else {
                $('#Email_Group > #Error_Unique').removeClass('error').addClass('hide');
                $('#Email_Group > #Error_Regex').removeClass('hide').addClass('error');
            }
        });

        $('#Confirm_Email_Group').find('#Confirm_Email').keyup(function(){
            var input = $(this).val();
            if (input != $('#Email').val()) {
                $('#Confirm_Email_Group > #Error_Regex').removeClass('hide').addClass('error');
            }
            else {
                $('#Confirm_Email_Group > #Error_Regex').removeClass('error').addClass('hide');
            }
        });
    }

    if(page == 'registrationPage.php'){
        $('#Username_Group').find('#Username').keyup(function(){
            var input = $(this).val();
            var pattern = /^[a-zA-Z0-9_-]{3,32}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#Username_Group > #Error_Regex').removeClass('error').addClass('hide');
                $.ajax({
                    type: "post",
                    url: "scripts/checkUsernameAvailability.php",
                    data: {Username: input},
                    dataType: "text",
                    success: function (response) {
                        var result = parseInt(response);
                        if (result) {
                            $('#Username_Group > #Error_Regex').removeClass('error').addClass('hide');
                            $('#Username_Group > #Error_Unique').removeClass('hide').addClass('error');
                        }
                        else {
                            $('#Username_Group > #Error_Unique').removeClass('error').addClass('hide');
                        }
                    }
                });
            }
            else {
                $('#Username_Group > #Error_Unique').removeClass('error').addClass('hide');
                $('#Username_Group > #Error_Regex').removeClass('hide').addClass('error');
            }

        });
    }

    if(page == 'registrationPage.php') {
        $('#First_Name_Group').find('#First_Name').keyup(function () {
            var input = $(this).val();
            var pattern = /^[a-zA-Z]{2,32}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#First_Name_Group > #Error_Regex').removeClass('error').addClass('hide');
            }
            else {
                $('#First_Name_Group > #Error_Regex').removeClass('hide').addClass('error');
            }
        });

        $('#Last_Name_Group').find('#Last_Name').keyup(function(){
            var input = $(this).val();
            var pattern = /^[a-zA-Z'-]{2,32}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#Last_Name_Group > #Error_Regex').removeClass('error').addClass('hide');
            }
            else {
                $('#Last_Name_Group > #Error_Regex').removeClass('hide').addClass('error');
            }
        });
    }

    if(page == 'registrationPage.php') {
        $('#Password_Group').find('#Password').keyup(function(){
            var input = $(this).val();
            var pattern = /^[a-zA-Z0-9_-]{6,32}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#Password_Group > #Error_Regex').removeClass('error').addClass('hide');
                var confirmPassword = $('#Confirm_Password').val();
                if (confirmPassword.length > 0) {
                    if (input != confirmPassword) {
                        $('#Confirm_Password_Group > #Error_Regex').removeClass('hide').addClass('error');
                    }
                    else {
                        $('#Confirm_Password_Group > #Error_Regex').removeClass('error').addClass('hide');
                    }
                }
            }
            else {
                $('#Password_Group > #Error_Regex').removeClass('hide').addClass('error');
            }
        });

        $('#Confirm_Password_Group').find('#Confirm_Password').keyup(function(){
            var input = $(this).val();
            if (input != $('#Password').val()) {
                $('#Confirm_Password_Group > #Error_Regex').removeClass('hide').addClass('error');
            }
            else {
                $('#Confirm_Password_Group > #Error_Regex').removeClass('error').addClass('hide');
            }
        });
    }
});