<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("vendor/autoload.php");

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

define('SMTP_USER', getenv('MAIL_USERNAME'));
define('SMTP_PASS', getenv('MAIL_PASSWORD'));
define('SMTP_HOST', getenv('MAIL_HOST'));
define('SMTP_PORT', getenv('MAIL_PORT'));

class Mail{

	public $error;

	function send($para, $de, $de_nome, $assunto, $corpo) {
		$mail = new PHPMailer();
		$mail->IsSMTP();			// Ativar SMTP
		$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
		$mail->SMTPAuth = true;		// Autenticação
		$mail->SMTPSecure = 'ssl';	// SSL Ou TSL
		$mail->Host = SMTP_HOST;	// SMTP utilizado
		$mail->Port = SMTP_PORT;  		// A porta deverá estar aberta em seu servidor
		$mail->Username = SMTP_USER;
		$mail->Password = SMTP_PASS;

		$mail->SetFrom($de, $de_nome);
		$mail->Subject = $assunto;
		$mail->Body = $corpo;
		$mail->AddAddress($para);
		
		if(!$mail->Send()) {
			$error = 'Mail error: '.$mail->ErrorInfo; 
			return false;
		} else {
			//$error = 'Mensagem enviada!';
			return true;
		}
	}

}