var path = window.location.pathname;
var page = path.substring(path.lastIndexOf('/') + 1);


$(document).ready(function(){


    if(page == 'updatePreferencesPage.php') {

        $('#tag_line_group:has(div[id=errors])').find('#tag_line').keyup(function () {
            $('#tag_line_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /[^<>]{2,256}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#tag_line_group > #errors > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#tag_line_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
        });

        $('#city_group:has(div[id=errors])').find('#city').keyup(function () {
            $('#city_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^[a-zA-Z]{2,32}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#city_group > #errors > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#city_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
        });


        $('#about_me_group:has(div[id=errors])').find('#about_me').keyup(function () {
            $('#about_me_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /[^<>]{2,256}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#about_me_group > #errors > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#about_me_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
        });


    }




});

