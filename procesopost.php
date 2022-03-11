<?php 
// Especificamos estas cabeceras
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("clickseguros.php");

$oClick = new Seguros();
@$proceso = $_POST["proceso"];

switch ($proceso){
    case "SOLICITUDVEHICULO_INSERT":
        print $oClick->solicitudvehiculo_insert(
            $_POST["fecha"],
            $_POST["nombre"],
            $_POST["apellidos"],
            $_POST["pais"],
            $_POST["codigopostal"],
            $_POST["celular"],
            $_POST["correo"],
            $_POST["codigoepisodio"],
            $_POST["tiposeguro"],
            $_POST["tipopersona"],
            $_POST["modelo"],
            $_POST["marca"],
            $_POST["version"],
            $_POST["transmision"],
            $_POST["descripcionversion"],
            $_POST["tipodecobertura"],
            $_FILES["archivo"]["name"],
            $_FILES["archivo"]["size"],
            $_FILES["archivo"]["tmp_name"],
            $_FILES["archivo"]["type"]
        );
        break;
    case "SOLICITUDVEHICULO_INSERTSINARCHIVOS":
        print $oClick->solicitudvehiculo_insertsinarchivos(
            $_POST["fecha"],
            $_POST["nombre"],
            $_POST["apellidos"],
            $_POST["pais"],
            $_POST["codigopostal"],
            $_POST["celular"],
            $_POST["correo"],
            $_POST["codigoepisodio"],
            $_POST["tiposeguro"],
            $_POST["tipopersona"],
            $_POST["modelo"],
            $_POST["marca"],
            $_POST["version"],
            $_POST["transmision"],
            $_POST["descripcionversion"],
            $_POST["tipodecobertura"],
        );
        break;
        case "SOLICITUDGASTOSMEDICOS_INSERT":
            print $oClick->solicitudgastosmedicos_insert(
                $_POST["fecha"],
                $_POST["nombre"],
                $_POST["apellidos"],
                $_POST["pais"],
                $_POST["codigopostal"],
                $_POST["celular"],
                $_POST["correo"],
                $_POST["codigoepisodio"],
                $_POST["asegurados"]
            );
            break;
}
?>