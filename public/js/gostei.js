$(document).ready(function () {

    $('.post-btn-actions').on('click', '.btn-gostei', function () {
        var postId = $(this).attr('data-postid');
        var btnGostei = $(this);

        $.post("/gostei", {postid: postId}, function (data) {
            if (data.status == 1) {
                gosteiSuccess('1', btnGostei);
            }
            else if (data.status == 2)
            {
                gosteiCancel('2', btnGostei);
            }
            gosteiCounter(postId, data.count);
        });
    });

    function gosteiSuccess(status, btnGostei) {
        btnGostei.addClass('btn-primary').removeClass('btn-white');
    }

    function gosteiCancel(status, btnGostei) {
        btnGostei.addClass('btn-white').removeClass('btn-primary');
    }

    function gosteiCounter(postId, count) {
        $(".btn-gostei-span-count-" + postId).html(count);
    }
});