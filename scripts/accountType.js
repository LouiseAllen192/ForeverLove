var path = window.location.pathname;
var page = path.substring(path.lastIndexOf('/') + 1);


$(document).ready(function(){


    if(page == 'registerAccountTypePage.php') {
        $('#name_on_card_group').find('#name_on_card').keyup(function () {
            $('#name_on_card_group > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^[a-z ,.'-]+$/i;
            var valid = pattern.test(input);
            if (valid) {
                $('#name_on_card_group > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#name_on_card_group > #error_regex').removeClass('hide').addClass('error');
            }
        });

        $('#cardnum_group').find('#cardnum').keyup(function(){
            $('#cardnum_group > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            if($('#type').val() == 'Visa') var pattern = /^4[0-9]{12}(?:[0-9]{3})?$/;
            if($('#type').val() == 'MasterCard') var pattern = /^5[1-5][0-9]{14}$/;
            if($('#type').val() == 'Laser') var pattern = /^(6304|6706|6709|6771)[0-9]{12,15}$/;
            if($('#type').val() == 'Maestro') var pattern = /^(5018|5020|5038|6304|6759|6761|6763)[0-9]{8,15}$/;

            var valid = pattern.test(input);
            if (valid) {
                $('#cardnum_group > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#cardnum_group > #error_regex').removeClass('hide').addClass('error');
            }
        });
    }


    if(page == 'registerAccountTypePage.php'){

        $('#cvv_group').find('#cvv').keyup(function () {
            $('#cvv_group > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /[0-9]{3}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#cvv_group > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#cvv_group > #error_regex').removeClass('hide').addClass('error');
            }
        });


        $('#address_group').find('#address').keyup(function () {
            $('#address_group > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /A-Za-z0-9'\.\-\s\,/;
            var valid = pattern.test(input);
            if (valid) {
                $('#address_group > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#address_group > #error_regex').removeClass('hide').addClass('error');
            }
        });
    }



});