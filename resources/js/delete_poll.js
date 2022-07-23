
$(document).ready(function(){
    $(".deletePoll").click(function(){
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
                var remove = "#poll"+id;

                item = '<div id="alert" class="scrap-alert-message success">Ankieta została usunięta</div>';
                $('#scrap-box-alert').append(item);
            
                setTimeout(function(){
                    $('#alert').remove();
                }, 3000);

                $(remove).remove();
            },
            error:function(data){
                item = '<div id="alert" class="scrap-alert-message error">Błąd podczas usuwania ankiety! </div>';

                $('#scrap-box-alert').append(item);

                setTimeout(function(){
                    $('#alert').remove();
                }, 3000);

                alertNumber++;
            },
        });
    
    });
});