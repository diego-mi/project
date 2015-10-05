$(document).ready(function () {

    $.post("/notifications", function (data) {
        if (data.status == 1) {
            gosteiSuccess('1', btnGostei);
        }
        else if (data.status == 2)
        {
            gosteiCancel('2', btnGostei);
        }
    });

});/**
 * Created by diego.campos on 28/09/2015.
 */
