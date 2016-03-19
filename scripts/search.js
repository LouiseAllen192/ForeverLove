$(document).ready(function(){
    $('#input_search').keyup(function () {
        $('#search_result').removeClass('hide');
        var input = $(this).val();
        input = $.trim(input);
        if (input != '') {
            $.ajax({
                type: "post",
                url: "scripts/search.php",
                data: {searchTerm: input},
                cache: false,
                success: function(response){
                    $('#search_result').html(response).show();
                }
            });
        }
    });

    $('#input_search').blur(function(){
        $('#search_result').addClass('hide');
    });
});