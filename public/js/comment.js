$(document).ready(function () {

    /*
     $('.post-btn-actions').on('click', '.btn-comment', function () {
     var postId = $(this).attr('data-postid');
     var btnComment = $(this);

     $.post("/Comment", {postid: postId}, function (data) {
     if (data.status == 1) {
     commentSuccess('1', btnComment);
     }
     else if (data.status == 2)
     {
     commentCancel('2', btnComment);
     }
     });
     });

     function commentSuccess(status, btnComment) {
     btnComment.addClass('btn-primary').removeClass('btn-white');
     }

     function commentCancel(status, btnComment) {
     btnComment.addClass('btn-white').removeClass('btn-primary');
     }
     */
    $('.input-comment').on('keypress', function (event) {
        console.log("as");
        if (event.which == 13) {
            console.log('b');
            var postId = $(this).attr('data-postid');
            var commentContainer = $('.comment-container-' + postId);
            var content = $(this).val();

            $.post("/comment", {postid: postId, content: content}, function (data) {
                $(commentContainer).html(data.status);
            });
        }
    });

});