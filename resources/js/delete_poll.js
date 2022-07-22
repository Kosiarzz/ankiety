
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
                console.log("USUNIĘTO");
            }
        });
    
    });
});