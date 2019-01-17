<?php
class RegularExpression {
//Email local  
public function valida_mail_local($valor, $dominio){
		$exp_reg = '/^[_A-z0-9-]+(\.[_A-z0-9-]+)*@'.$dominio.'/'; 
		if (preg_match($exp_reg, $valor)) {
			 return true;
		} else { 
			 return false;
		} 
	}
//Emal	
	public function valida_email($valor){
		$exp_reg = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		if (preg_match($exp_reg, $valor)) {
			 return true;
		} else { 
			 return false;
		} 
	}
//Decimales	
	public function valida_numero_decimales($valor){
		$exp_reg = "/^-?[0-9]+([,\.][0-9]*)?$/"; 
		if (preg_match($exp_reg, $valor)) {
			 return true;
		} else { 
			 return false;
		} 
	}
//Enteros
	public function valida_numero_entero($valor){
		$exp_reg = "/^[0-9]+$/"; 
		if (preg_match($exp_reg, $valor)) {
			 return true;
		} else { 
			 return false;
		} 
	}
//Estatura	
	public function valida_estatura($valor){
		$exp_reg = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/"; 
		if (preg_match($exp_reg, $valor)) {
			 return true;
		} else { 
			 return false;
		} 
	}
//Nombre sin caracteres especiales, números y mayor a 3 caracteres, menor a 25	
	public function valida_nombre($valor){
		$exp_reg = "/^[a-zA-Z_ñÑ -]{3,25}$/";
		if (preg_match($exp_reg, $valor)) {
			 return true;
		} else { 
			 return false;
		} 
	}
//Texto sin caracteres especiales, números y longitud variable
	public function valida_texto($valor,$min,$max){
		$exp_reg = "/^[a-zA-Z_ñÑ -]{".$min.",".$max."}$/";
		if (preg_match($exp_reg, $valor)) {
			 return true;
		} else { 
			 return false;
		} 
	}
//Fecha	
	public function valida_fecha($fecha){
	$sep = " [\/\-] ";
	$req = "/^(((0? [1-9] |1\d|2 [0-8] ){$sep}(0? [1-9] |1 [012] )|(29|30){$sep}(0? [13456789] |1 [012] )|31{$sep}(0? [13578] |1 [02] )){$sep}(19| [2-9] \d)\d{2}|29{$sep}0?2{$sep}((19| [2-9] \d)(0 [48] | [2468]  [048] | [13579]  [26] )|(( [2468]  [048] | [3579]  [26] )00)))$/";
	if (preg_match($req, $fecha)) {
			 return true;
		} else { 
			 return false;
		} 
	}
//Ip	
	public function valida_ip($ip)
	{
		$val_0_to_255 = "(25 [012345] |2 [01234] \d| [01] ?\d\d?)";
		$reg = "/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/";
		 if (preg_match($req, $ip)) {
			 return true;
		} else { 
			 return false;
		} 
	}
//Código postal
	public function valida_cp($cp)
	{
		$reg = "/^[0-9]{5,5}([- ]?[0-9]{4,4})?$/";
		 if (preg_match($req, $cp)) {
			 return true;
		} else { 
			 return false;
		} 
	}
//Direccion URL		
	public function valida_url($url){
		$reg="/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \?=.-]*)*\/?$/";
		if (preg_match($reg, $url)){
			return true;
		} else {
			return false;
		}
	}
//Imagen name
	public function valida_imagen_name($imagen){
		$reg="%\.(gif|jpe?g|png|jpg)$%i";
		if (preg_match($reg, $imagen)){
			return true;
		} else {
			return false;
		}
	}
//Imagen type image/jpeg
	public function valida_imagen_type($imagen){
		$reg="/^(image\/)+(gif|jpeg|png|jpg)/";
		if (preg_match($reg, $imagen)){
			return true;
		} else {
			return false;
		}
	}
//pdf name
	public function valida_pdf_name($imagen){
		$reg="%\.(pdf|PDF)$%i";
		if (preg_match($reg, $imagen)){
			return true;
		} else {
			return false;
		}
	}
//PDF type
	public function valida_pdf_type($pdf){
		$reg="/^(application\/pdf)/";
		if (preg_match($reg, $pdf)){
			return true;
		} else {
			return false;
		}
	}
//Clave
	public function valida_clave($valor){
		$exp_reg = "/^[0-9a-zA-Z_.-]{3,16}$/"; 
		if (preg_match($exp_reg, $valor)) {
			 return true;
		} else { 
			 return false;
		} 
	}
		
}
?> 