function supprimerPoisson(id){
	$.ajax({
		type: "POST",
		data:{crousti_id_poisson:id},
		url: './function/supprimerPoisson.php',      
		success:function(html){  
			window.location.assign('./index.php');     	
			console.log(html);
		}      
	});
}

$(document).ready(function() {
	$('.toscroll').on('click', function(event) {

		// Make sure this.hash has a value before overriding default behavior
		if ($(this).attr('href') !== "") {
			// Prevent default anchor click behavior
			event.preventDefault();

			// Store hash
			var href = $(this).attr('href');

			// Using jQuery's animate() method to add smooth page scroll
			// The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
			$('html, body').animate({
				scrollTop: $(href).offset().top
			}, 800, function(){
				
			});
		} // End if
	});
});