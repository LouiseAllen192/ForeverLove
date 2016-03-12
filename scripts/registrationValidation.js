var path = window.location.pathname;
var page = path.substring(path.lastIndexOf('/') + 1);

if(page == 'registrationPage.php'){
    $(document).ready(function(){
        var check = {
            Email:false,
            ConfirmEmail:false,
            Username:false,
            FirstName:false,
            LastName:false,
            Password:false,
            ConfirmPassword:false
        };

        $('#Email').blur('input', function(){
            var input = $(this).val();
            var pattern = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
            var valid = pattern.test(input);
            if(valid){
                $('#Email_Group > #Error_1').addClass('hide');
                $.ajax({
                    type: "post",
                    url: "scripts/checkIfEmailIsRegistered.php",
                    data: input,
                    dataType: "text",
                    success:function(response){
                        var result = parseInt(response);
                        if(result){
                            $('#Email_Group > #Error_2').removeClass('hide');
                            check.Email = false;
                            check.ConfirmEmail = false;
                        }
                        else{
                            $('#Email_Group > #Error_2').addClass('hide');
                            check.Email = true;
                        }
                    }
                });
            }
            else{
                $('#Email_Group > #Error_2').addClass('hide');
                $('#Email_Group > #Error_1').removeClass('hide');
                check.Email = false;
                check.ConfirmEmail = false;
            }
        });

        $('#Confirm_Email_Group').find('#Confirm_Email').blur('input', function(){
            if(check.Email) {
                var input = $(this).val();
                if (input != $('#Email').val()) {
                    $('#Confirm_Email_Group > #Error_1').removeClass('hide');
                    check.ConfirmEmail = false;
                }
                else {
                    $('#Confirm_Email_Group > #Error_1').addClass('hide');
                    check.ConfirmEmail = true;
                }
            }
        });

        $('#Username_Group').find('#Username').blur('input', function(){
            var input = $(this).val();
            if(input.length > 2){
                $('#Username_Group > #Error_1').addClass('hide');
                var pattern = /^[a-zA-Z0-9_-]{3,32}$/;
                var valid = pattern.test(input);
                if(valid){
                    $('#Username_Group > #Error_2').addClass('hide');
                    $.ajax({
                        type: "post",
                        url: "scripts/checkUsernameAvailability.php",
                        data: input,
                        dataType: "text",
                        success:function(response){
                            var result = parseInt(response);
                            if(result){
                                $('#Username_Group > #Error_1').addClass('hide');
                                $('#Username_Group > #Error_2').addClass('hide');
                                $('#Username_Group > #Error_3').removeClass('hide');
                                check.Username = false;
                            }
                            else{
                                $('#Username_Group > #Error_3').addClass('hide');
                                check.Username = true;
                            }
                        }
                    });
                }
                else{
                    $('#Username_Group > #Error_3').addClass('hide');
                    $('#Username_Group > #Error_2').removeClass('hide');
                    check.Username = false;
                }
            }
            else{
                $('#Username_Group > #Error_2').addClass('hide');
                $('#Username_Group > #Error_3').addClass('hide');
                $('#Username_Group > #Error_1').removeClass('hide');
                check.Username = false;
            }
        });

        $('#First_Name_Group').find('#First_Name').blur('input', function(){
            var input = $(this).val();
            var pattern = /^[a-zA-Z]{2,32}$/;
            var valid = pattern.test(input);
            if(valid){
                $('#First_Name_Group > #Error_1').addClass('hide');
                check.FirstName = true;
            }
            else{
                $('#First_Name_Group > #Error_1').removeClass('hide');
                check.FirstName = false;
            }
        });

        $('#Last_Name_Group').find('#Last_Name').blur('input', function(){
            var input = $(this).val();
            var pattern = /^[a-zA-Z'-]{2,32}$/;
            var valid = pattern.test(input);
            if(valid){
                $('#Last_Name_Group > #Error_1').addClass('hide');
                check.LastName = true;
            }
            else{
                $('#Last_Name_Group > #Error_1').removeClass('hide');
                check.LastName = false;
            }
        });

        $('#Password_Group').find('#Password').blur('input', function(){
            var input = $(this).val();
            if(input.length > 5){
                $('#Password_Group > #Error_1').addClass('hide');
                var pattern = /^[a-zA-Z0-9_-]{6,32}$/;
                var valid = pattern.test(input);
                if(valid){
                    $('#Password_Group > #Error_2').addClass('hide');
                    check.Password = true;
                }
                else{
                    $('#Password_Group > #Error_2').removeClass('hide');
                    check.Password = false;
                }
            }
            else{
                $('#Password_Group > #Error_2').addClass('hide');
                $('#Password_Group > #Error_1').removeClass('hide');
                check.Password = false;
            }
        });

        $('#Confirm_Password_Group').find('#Confirm_Password').blur('input', function(){
            if(check.Password){
                var input = $(this).val();
                if(input != $('#Password').val()){
                    $('#Confirm_Password_Group > #Error_1').removeClass('hide');
                    check.ConfirmPassword = false;
                }
                else{
                    $('#Confirm_Password_Group > #Error_1').addClass('hide');
                    check.ConfirmPassword = true;
                }
            }
        });
    });
}