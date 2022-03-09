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
    case "CATTIPOSEGURO_SELECT_ALL":
        print $oClick->cattiposeguro_select_all();
        break;
    case "CONTENIDOTEXTUAL_SELECT_ALL":
        print $oClick->contenidotextual_select_all();
        break;
    case "CONTENIDOTEXTUAL_SELECT":
        print $oClick->contenidotextual_select($_GET["cont"],$_GET["lim"]);
        break;
    case "CONTENIDOTEXTUAL_SAVE":
        print $oClick->contenidotextual_save(
            $_GET["id"],
            $_GET["idContenidoTextual"],
            $_GET["titulo"],
            $_GET["subtitulo"],
            $_GET["texto"],
            $_GET["por"],
            $_FILES["imagen"]["name"],
            $_FILES["imagen"]["size"],
            $_FILES["imagen"]["tmp_name"],
            $_FILES["imagen"]["type"]
        );
        break;
    case "CONTENIDOTEXTUAL_SAVE_SIN_ARCHIVO":
        print $oClick->contenidotextual_save_sin_archivo(
            $_GET["id"],
            $_GET["idContenidoTextual"],
            $_GET["titulo"],
            $_GET["subtitulo"],
            $_GET["texto"],
            $_GET["por"]
        );
        break;
    case "CONTENIDOTEXTUAL_DELETE":
        print $oClick->contenidotextual_delete($_GET["id"]);
        break;
}
?>