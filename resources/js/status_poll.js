
$(document).ready(function(){
    $(".statusPoll").click(function(){
        var id = $(this).data("id");

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
                var remove = "#time"+id
                console.log(remove)
                $(remove).text('text')
                $(this).data("status", "ddd")
            }
        });
    
    });
});