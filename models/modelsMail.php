<?php
class modelMail{
	public function sendMail($recipient,$subject,$message){

		// Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
		$message = wordwrap($message, 70, "\r\n");

		// Enviamos el email
		mail($recipient, $subject, Trim($message));
	}
}
?>