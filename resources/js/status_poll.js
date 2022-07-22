
$(document).ready(function(){
    $(".statusPoll").click(function(){
        var id = $(this).data("id");
        var status = $(this).data("status")

        console.log(status);
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
                    $(this).data("status", "off")
                }
                else
                {
                    $(time).text("Teraz");
                    $(this).data("status", "on")
                }
            }
        });
    
    });
});