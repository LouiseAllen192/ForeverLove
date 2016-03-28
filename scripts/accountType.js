var path = window.location.pathname;
var page = path.substring(path.lastIndexOf('/') + 1);


$(document).ready(function(){


    if(page == 'registerAccountTypePage.php') {

        $('#fullname_group').find('#fullname').keyup(function () {
            $('#fullname_group > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^[a-z ,.'-]+$/i;
            var valid = pattern.test(input);
            if (valid) {
                $('#fullname_group > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#fullname_group > #error_regex').removeClass('hide').addClass('error');
            }
        });

        $('#ccNumber_group').find('#ccNumber').keyup(function(){
            $('#ccNumber_group > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^\d{16}$/;

            var valid = pattern.test(input);
            if (valid) {
                $('#ccNumber_group > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#ccNumber_group > #error_regex').removeClass('hide').addClass('error');
            }
        });
    }

    if(page == 'registerAccountTypePage.php'){

        $('#month_group').find('#month').keyup(function () {
            $('#month_group > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^(0[1-9]|1[0-2])$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#month_group > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#month_group > #error_regex').removeClass('hide').addClass('error');
            }
        });

        $('#year_group').find('#year').keyup(function () {
            $('#year_group > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^\d{2}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#year_group > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#year_group > #error_regex').removeClass('hide').addClass('error');
            }

            var today = new Date();
            var currentMonth = today.getMonth();
            currentMonth = currentMonth++;
            var currentYear = today.getYear();
            currentYear  = currentYear .substring(2);


            var month = $('#month').val();
            var year = $(this).val();

            var success = true;
            if(currentYear > year){ success = false;}
            if(currentYear == year && month <currentMonth) {success = false;}

            if (success) {
                $('#dob_group > #error_valid_date').removeClass('hide').addClass('error');
            }
            else {
                $('#dob_group > #error_valid_date').removeClass('error').addClass('hide');
            }
        });


    }

    if(page == 'registerAccountTypePage.php'){

        $('#security_group').find('#security').keyup(function () {
            $('#security_group > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^\d{3}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#security_group > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#security_group > #error_regex').removeClass('hide').addClass('error');
            }
        });


    }



});