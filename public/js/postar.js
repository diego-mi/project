$(document).ready(function () {

	$(".postar-textarea").on( "click", function() {
		console.log($(".postar").hasClass("active"));
		if (!$(".postar").hasClass("active")) {
			$(".postar").addClass("active");
			console.log("b");	
		}
	});

    $("#btn-postar-foto").on("click", function() {
        $('.postar-itens-tipo').hide();
        $('.postar-foto').show();
        $('#post-type').val('2');
        $('#post-foto').removeAttr('disabled');
    });

    $("#btn-postar-texto").on("click", function() {
        $('.postar-itens-tipo').hide();
        $('#post-type').val('1');
        $('#post-foto').attr('disabled', 'disabled');
    });
    
});