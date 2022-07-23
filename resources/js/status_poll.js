
$(document).ready(function(){
    $(".statusPoll").click(function(){
        var id = $(this).data("id");
        var status = $(this).data("status")

        $(this).prop('disabled', true);
        
        $.ajax({
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).data('route'),
            data: {
            id: id
            },
            success: function (response) {
                var time = ".time"+id
                
                //$(remove).text('text')
                if(status == "on")
                {
                    $(time).text("-");
                }
                else
                {
                    $(time).text("Teraz");
                }

                item = '<div id="alert" class="scrap-alert-message success">Status został zmieniony</div>';
                $('#scrap-box-alert').append(item);
            
                setTimeout(function(){
                    $('#alert').remove();
                }, 3000);
            },
            error:function(data){
                item = '<div id="alert" class="scrap-alert-message error">Błąd podczas zmiany statusu! </div>';

                $('#scrap-box-alert').append(item);

                setTimeout(function(){
                    $('#alert').remove();
                }, 3000);

                alertNumber++;
            },
        });
    
    });
});