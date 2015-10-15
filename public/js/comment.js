$(document).ready(function () {

    $('.input-comment').on('keypress', function (event) {
        var inputComment = $(this);
        if ((event.which == 13) && (event.shiftKey)) {
            $(this).height($(this).height() + 24);
        } else if (event.which == 13) {
            var postId = $(this).attr('data-postid');
            var content = $(this).val();

            inputComment.attr("disabled", "disabled");
            openContainerComments(postId);
            $.post("/add-comment", {postid: postId, content: content}, function (data) {
                $('.comment-container-' + postId).html(data.status);
                $('.comment-link-getcomments-count-' + postId).html(data.count);
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
        if ($(containerComments).hasClass('opened')) {
            closeContainerComments(postId);
            addSpinnerContainerComments(postId);
        } else {
            openContainerComments(postId);
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
            closeContainerComments(postId);
            addSpinnerContainerComments(postId);
        } else {
            openContainerComments(postId);
            $.post("/get-comments", {postid: postId}, function (data) {
                $(containerComments).html(data.status);
            });
        }
    });


    function openContainerComments(postId) {
        $('.comment-container-' + postId).slideDown().addClass('opened');
        $('.comment-link-getcomments-' + postId).removeClass('open').addClass('opened');
    }

    function closeContainerComments(postId) {
        $('.comment-container-' + postId).removeClass('opened').slideUp();
        $('.comment-link-getcomments-' + postId).removeClass('opened').addClass('open');
    }

    function toggleContainerComments(postId) {
        $('.comment-container-' + postId).hasClass('opened')
            ? openContainerComments(postId)
            : closeContainerComments(postId);
    }

    function addSpinnerContainerComments(postId) {
        $('.comment-container-' + postId).html('<!-- social-comment --><div class="social-comment"><div class="sk-spinner sk-spinner-cube-grid"><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div><div class="sk-cube"></div></div></div><!-- end social-comment -->');
    }

});

