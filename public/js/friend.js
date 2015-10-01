$(document).ready(function () {

    $('.friend-div-btns').on('click', '.friend-btn-add', function () {
        var friendId = $(this).attr('data-friendid');
        var btnFriend = $(this);

        $.post("/friend", {friendid: friendId}, function (data) {
            if (data.status == 1) {
                friendAdd('1', btnFriend);
            }
            else if (data.status == 2) {
                friendRemove('2', btnFriend);
            }
        });
    });

    function friendAdd(status, btnFriend) {
        btnFriend
            .removeClass('btn-primary btn-white')
            .addClass('btn-primary');
        btnFriend
            .find(' > .friend-i-seguir')
            .removeClass('fa-check fa-plus')
            .addClass('fa-check');
        btnFriend
            .find(' > .friend-span-seguir')
            .html(' Seguindo ');
    }

    function friendRemove(status, btnFriend) {
        btnFriend
            .removeClass('btn-primary btn-white')
            .addClass('btn-white');
        btnFriend
            .find(' > .friend-i-seguir')
            .removeClass('fa-check fa-plus')
            .addClass('fa-plus');
        btnFriend
            .find(' > .friend-span-seguir')
            .html(' Seguir ');
    }

});