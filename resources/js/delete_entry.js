
$(document).ready(function(){
    $(".deleteEntry").click(function(){
        var id = $(this).data("id");

        $.ajax({
            type: 'delete',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).data('route'),
            data: {
            id: id
            },
            success: function (response) {
                var remove = "#entry"+id;
                $(remove).remove();

                item = '<div id="alert" class="scrap-alert-message success">Wpis został usunięty</div>';
                $('#scrap-box-alert').append(item);
            
                setTimeout(function(){
                    $('#alert').remove();
                }, 3000);
            },
            error:function(data){
                item = '<div id="alert" class="scrap-alert-message error">Błąd podczas usuwania wpisu! </div>';

                $('#scrap-box-alert').append(item);

                setTimeout(function(){
                    $('#alert').remove();
                }, 3000);
            },
        });
    
    });
});