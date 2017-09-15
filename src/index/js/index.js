
$(document).ready(function(){
	$('#form-email').on('submit',function(event) {
		event.preventDefault();

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
					alertaEmailErro();

				} else if (result.success=='1'){
					console.log('sucesso!');
					alertaEmailRecebido();
				} 
		})
		.fail(function() {
		   	console.log("error");
			alertaEmailErro();

		})
		.always(function() {
		   console.log("complete");
		});
		return false;
	});

});

function alertaEmail(classe,textoTitulo,textoLongo){
	$('.textoTitulo').text(textoTitulo);
	$('.textoLongo').text(textoLongo);
	$('.alertaEmail')
	.removeClass('alert-warning')
	.removeClass('alert-success')
	.addClass(classe).show();
}

function alertaEmailRecebido(){
	alertaEmail('alert-success','Feito!',' Recebemos seus dados, entraremos em contato o quanto antes.')
}

function alertaEmailErro(){
	alertaEmail('alert-warning','Desculpe.',' Nosso servidor está em manutenção, por gentileza, nos envie um email para: faleconosco@informaticos.net.br')
}