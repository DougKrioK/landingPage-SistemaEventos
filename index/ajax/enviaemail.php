<?php
header("Cache-Control: no-cache, must-revalidate");


require_once '../user/email.php';
$nome = $_POST['nome'];
$emailContato = $_POST['email'];
$assunto = $_POST['assunto'];
$ReceberNoticias = $_POST['ReceberNoticias'];


$textoEmail = utf8_decode("
<html>

	<body>
		<div align='center'>
			<table cellspacing='5' cellpadding='5' border='0' width='600' style='background: none repeat scroll 0% 0% rgb(244 , 244 , 244) ; border: 1px solid rgb(102 , 102 , 102)'>
			    <tbody>
			        <tr>
			            <th style='background-color: rgb(204 , 204 , 204)'>Novidades.</th>
			        </tr>
			        <tr>
			            <td valign='top' style='text-align: left'>Oi,<br>
				            <br>
				            Alguém preencheu nosso formulário de contato.<br>
				            <br>
				            Nome: <strong>{$nome}</strong><br>
				            Email: <strong>{$emailContato}</strong><br>
				            Assunto: <strong>{$assunto}</strong><br>
				            ReceberNoticias: <strong>{$ReceberNoticias}</strong><br>
				            <hr>
			            </td>
			        </tr>
			        <tr>
			            <td style='text-align: left'>
			            	<em>Obrigado,<br>
			            	Informáticos Sistemas<br>
			            	</em>
			            </td>
			        </tr>
			    </tbody>
			</table>
		</div>
	</body>
</html>
");
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../../vendor/autoload.php';

	$mail = new PHPMailer(true);
	try {
	    //Server settings
	    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = $hostServidor;  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = $emailCliente;                 // SMTP username
	    $mail->Password = $senhaEmailCliente;                           // SMTP password
	    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 587;                                    // TCP port to connect to

	    //Recipients
	    $mail->setFrom($emailEmpresa, 'Mailer');
	    $mail->addAddress($douglasEmail);     // Add a recipient
	    $mail->addAddress($gustavoEmail);               // Name is optional

	    //Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    //Content
	    //$mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Dados de contato na landing page';
	    //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
	    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	    $mail->msgHTML($textoEmail);

	    $mail->send();
	    	$resultado = array(
	        	"success" => '1',
	        );

	} catch (Exception $e) {
    	$resultado = array(
        	"success" => '0',
        	'Mailer Error' => $mail->ErrorInfo
        );
	}




echo json_encode($resultado); 