
$(document).ready(function(){
	$('#form-email').on('submit',function(event) {
		event.preventDefault();
		/* Act on the event */

		$.ajax({
		   url: 'index/ajax/enviaemail.php',
		   type: 'POST',
		   dataType: 'json',
		   data: $(this).serialize(),
		})
		.done(function(result) {
				console.log(result);
				if (result.success=='0'){
					console.log('erro ao enviar email');
					$('.alert-erro').show();


				} else if (result.success=='1'){
					console.log('sucesso!');
					$('.alert-emailRecebido').show();
				} 
		})
		.fail(function() {
		   console.log("error");
			$('.alert-erro').show();
		   

		})
		.always(function() {
		   console.log("complete");
		});
		return false;
	});

});
