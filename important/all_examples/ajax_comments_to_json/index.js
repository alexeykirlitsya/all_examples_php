$(document).ready(function(){
    $("form").on("submit", function(event){
        event.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url:$(this).attr('action'),
            data: new FormData(this),
            contentType:false,
            cache:false,
            processData: false,
            success: function (res) {
                alert(res);
            }
        });

        $('input').val('');
        $('textarea').val('');
    });
});