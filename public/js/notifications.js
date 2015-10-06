$(document).ready(function () {

    $.post("/get-notifications", function (data) {
        $(".notifications-layout").html(data.status);
    });

});/**
 * Created by diego.campos on 28/09/2015.
 */
