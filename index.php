<?php

$errores='';
$enviado='';

//Comprobar si el formulario a sido enviado
//se crea las variables para saber que se puso en los input con name="".
if(isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$mensaje = $_POST['mensaje'];

    //comprobamos si tiene algo de contenido 
    //(!empty($nombre)) si no esta vacia la variable
    if (!empty($nombre)) {
        $nombre=trim($nombre); //comprobamos con trim que no hayan espacio antes o despues en blanco
        $nombre=filter_var($nombre, FILTER_SANITIZE_STRING); //filter_nar sanear o validar info, en este caso sanear osea eliminar los caracteres a mayor 
        if ($nombre == "") {
			$errores.= 'Por favor ingresa un nombre.<br />';
		}
	} else {
		$errores.= 'Por favor ingresa un nombre.<br />';
	}

    if (!empty($correo)) {
		$correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
		// Comprobamos que sea un correo valido
		if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
			$errores.= "Por favor ingresa un correo valido.<br />";
		}
	} else {
		$errores.= 'Por favor ingresa un correo.<br />';
	}

    if (!empty($mensaje)) {
		// Podemos sanear la cadena de texto con filter_var, pero queremos que en el mensaje los signos se conviertan en entidades HTML
		$mensaje = htmlspecialchars($mensaje);
		$mensaje = trim($mensaje);
		$mensaje = stripslashes($mensaje);
	} else {
		$errores.= 'Por favor ingresa el mensaje.<br />';
	}
    
    // Comprobamos si hay errores, si no hay entonces enviamos.
	if (!$errores) {
		$enviar_a = 'carlos@falconmasters.com';
		$asunto = 'Correo enviado desde miPagina.com';
		$mensaje_preparado = "De: $nombre \n";
		$mensaje_preparado= "Correo: $correo \n";
		$mensaje_preparado= 'Mensaje: ' . $_POST['mensaje'];

		// mail($enviar_a, $asunto, $mensaje);
		$enviado = 'true';
	}
}
 require 'vista.view.php';



?>