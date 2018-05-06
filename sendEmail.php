<?php

require 'Mail.php';

if(!isset($_POST['name']) || !isset($_POST['email']) ){
	die('Access Denied');
}else{
	$Nome		= $_POST["name"];
	$Email		= $_POST["email"];
	$Mensagem	= $_POST["message"];
}

$mailer = new Mail();

$mensagem = "Nome: $Nome\n\nE-mail: $Email\n\nMensagem: $Mensagem\n";

if ($mailer->send('jcramone@gmail.com', 'contato@juliocmartins.com.br', 'Julio', 'Assunto do Email', $mensagem)) {
	
	echo json_encode(['status' => true]);
}else{
	$error = $mailer->error;
}



if (!empty($error)) echo json_encode(['status' => false, 'message' => $error]);