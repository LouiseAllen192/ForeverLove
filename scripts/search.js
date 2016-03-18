$('#input_search').keyup(function(){
    var input = $(this).val();
    input = $.trim(input);
    if(input != ''){
        $.ajax({
            type: "post",
            url: "scripts/search.php",
            data: {searchTerm: input},
            cache: false,
            success: function(html){
                $('#div_result').html(html).show();
            }
        });
    }
});

$('#search_result').live("click", function(event){
    var clicked = $(event.target);
    var name = clicked.find('.name').html();
    $('#input_search').val($("<div/>").html(name).text());
});

$(document).live("click", function(event){
    var clicked = $(event.target);
    if(!clicked.hasClass('search')){
        $('#search_result').fadeOut();
    }
});

$('#input_search').click(function(){
   $('#search_result').fadeIn();
});