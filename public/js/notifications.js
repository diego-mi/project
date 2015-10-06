$(document).ready(function () {

    $.post("/get-notifications", function (data) {
        $(".notifications-layout").html(data.status);
    });


    $(".notifications-layout").on( "mouseover", '.notification-item', function() {
        if ($(this).hasClass("notification-new")) {
            var notificationId = $(this).attr('data-notificationid');
            var notificationLi = $(this);
            $.post("/set-notification-to-old", {notificationId: notificationId}, function (data) {
                console.log(data.status);
                if (data.status) {
                    $(notificationLi).removeClass('notification-new');
                }
            });
        }
    });
});/**
 * Created by diego.campos on 28/09/2015.
 */
