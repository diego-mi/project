$(document).ready(function () {

    $.post("/get-notifications", function (data) {
        $(".notifications-layout").html(data.html);
        if (data.count) {
            $('.notifications-label').html(data.count).show();
        } else {
            $('.notifications-label').html('').hide();
        }

    });


    $(".notifications-layout").on( "mouseover", '.notification-item', function() {
        if ($(this).hasClass("notification-new")) {
            var notificationId = $(this).attr('data-notificationid');
            var notificationLi = $(this);
            $.post("/set-notification-to-old", {notificationId: notificationId}, function (data) {
                if (data.status) {
                    $(notificationLi).removeClass('notification-new');
                }
            });
        }
    });
});/**
 * Created by diego.campos on 28/09/2015.
 */
