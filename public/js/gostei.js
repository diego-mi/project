$(document).ready(function () {

    $('.post-btn-actions').on('click', '.btn-gostei', function() {
        var postId = $(this).attr('data-postid');

        $.post( "/gostei",{postid : postId} , function( data ) {
            console.log(data);
        });
    });

});