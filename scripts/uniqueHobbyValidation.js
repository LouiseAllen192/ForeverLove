var path = window.location.pathname;
var page = path.substring(path.lastIndexOf('/') + 1);


$(document).ready(function(){


    if(page == 'updateHobbiesPage.php') {

        $('#unique_hobby_group:has(div[id=errors])').find('#unique_hobby').keyup(function () {
            $('#unique_hobby_group > #errors > #error_required').removeClass('error').addClass('hide');
            var input = $(this).val();
            var pattern = /^[a-zA-Z ]{2,256}$/;
            var valid = pattern.test(input);
            if (valid) {
                $('#unique_hobby_group > #errors > #error_regex').removeClass('error').addClass('hide');
            }
            else {
                $('#unique_hobby_group > #errors > #error_regex').removeClass('hide').addClass('error');
            }
        });

    }




});


