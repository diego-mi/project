$(document).ready(function () {

    $('.input-comment').on('keypress', function (event) {
        var inputComment = $(this);
        if ((event.which == 13) && (event.shiftKey)) {
            $(this).height($(this).height() + 24);
        } else if (event.which == 13) {
            var postId = $(this).attr('data-postid');
            var commentContainer = $('.comment-container-' + postId);
            var content = $(this).val();

            inputComment.attr("disabled", "disabled");
            $(".comment-container-" + postId).show();
            $.post("/add-comment", {postid: postId, content: content}, function (data) {
                $(commentContainer).html(data.status);
                $(inputComment)
                    .removeAttr('disabled')
                    .val('')
                    .height(34)
                    .setfocus();
            });
        }
    });

    $('.post-btn-actions').on('click', '.btn-comments', function () {
        var postId = $(this).attr('data-postid');
        var containerComments = $('.comment-container-' + postId);
        if ($(containerComments).hasClass('opened')) {
            $(containerComments)
                .removeClass('opened')
                .slideUp()
                .html('<!-- social-comment --><div class="social-comment"><div class="sk-spinner sk-spinner-cube-grid"><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div></div></div><!-- end social-comment -->');
        } else {
            $(containerComments).slideDown().addClass('opened');
            $.post("/get-comments", {postid: postId}, function (data) {
                $(containerComments).html(data.status);
            });
        }
    });


    $('.comment-infos').on('click', '.comment-link-getcomments', function (event) {
        event.preventDefault();
        var postId = $(this).attr('data-postid');
        var containerComments = $('.comment-container-' + postId);
        if ($(containerComments).hasClass('opened')) {
            $(this).removeClass('opened').addClass('open');
            $(containerComments)
                .removeClass('opened')
                .slideUp()
                .html('<!-- social-comment --><div class="social-comment"><div class="sk-spinner sk-spinner-cube-grid"><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div></div></div><!-- end social-comment -->');
        } else {
            $(containerComments).slideDown().addClass('opened');
            $.post("/get-comments", {postid: postId}, function (data) {
                $(containerComments).html(data.status);
            });
            $(this).removeClass('open').addClass('opened');
        }
    });


});

