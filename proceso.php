<?php 
// Especificamos estas cabeceras
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("clickseguros.php");

$oClick = new Seguros();
@$proceso = $_GET["proceso"];

switch ($proceso){
    case "USUARIO_SELECT":
        print $oClick->usuario_select($_GET["clave"]);
        break;
    case "CATTIPOSEGURO_SELECT_ALL":
        print $oClick->cattiposeguro_select_all();
        break;
    case "CATTIPOSEGURO_SELECT_DISTINCT":
        print $oClick->cattiposeguro_select_distinct();
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
    case "SOLICITUD_SELECT":
        print $oClick->solicitud_select();
        break;
}
?>