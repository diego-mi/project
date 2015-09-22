$(document).ready(function () {

	$(".postar-textarea").on( "click", function() {
		console.log($(".postar").hasClass("active"));
		if (!$(".postar").hasClass("active")) {
			$(".postar").addClass("active");
			console.log("b");	
		}
	});

});