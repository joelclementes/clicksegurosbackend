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
            $_POST["cosaasegurada"],
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
            $_POST["cosaasegurada"],
            $_POST["tipopersona"],
            $_POST["modelo"],
            $_POST["marca"],
            $_POST["version"],
            $_POST["transmision"],
            $_POST["descripcionversion"],
            $_POST["tipodecobertura"]
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
            $_POST["tiposeguro"],
            $_POST["cosaasegurada"],
            $_POST["asegurados"],
            $_FILES["archivo"]["name"],
            $_FILES["archivo"]["size"],
            $_FILES["archivo"]["tmp_name"],
            $_FILES["archivo"]["type"]
        );
        break;
        
    case "SOLICITUDGASTOSMEDICOS_INSERTSINARCHIVOS":
        print $oClick->solicitudgastosmedicos_insertsinarchivos(
            $_POST["fecha"],
            $_POST["nombre"],
            $_POST["apellidos"],
            $_POST["pais"],
            $_POST["codigopostal"],
            $_POST["celular"],
            $_POST["correo"],
            $_POST["codigoepisodio"],
            $_POST["tiposeguro"],
            $_POST["cosaasegurada"],
            $_POST["asegurados"]
        );
        break;
    case "SOLICITUDVIDAAHORRO_INSERT":
        print $oClick->solicitudvidaahorro_insert(
            $_POST["fecha"],
            $_POST["nombre"],
            $_POST["apellidos"],
            $_POST["pais"],
            $_POST["codigopostal"],
            $_POST["celular"],
            $_POST["correo"],
            $_POST["codigoepisodio"],
            $_POST["tiposeguro"],
            $_POST["cosaasegurada"],
            $_POST["nombrecontratante"],
            $_POST["generocontratante"],
            $_POST["fechanacimientocontratante"],
            $_POST["ocupacioncontratante"],
            $_POST["conyugeproteccion"],
            $_POST["conyugefechadenacimiento"],
            $_POST["conyugeedad"],
            $_POST["conyugegenero"],
            $_POST["retornoinversionbaja"],
            $_POST["retornoinversionmedia"],
            $_POST["retornoinversionalta"],
            $_FILES["archivo"]["name"],
            $_FILES["archivo"]["size"],
            $_FILES["archivo"]["tmp_name"],
            $_FILES["archivo"]["type"]
        );
        break;
    case "SOLICITUDVIDAAHORRO_INSERTSINARCHIVOS":
        print $oClick->solicitudvidaahorro_insertsinarchivos(
            $_POST["fecha"],
            $_POST["nombre"],
            $_POST["apellidos"],
            $_POST["pais"],
            $_POST["codigopostal"],
            $_POST["celular"],
            $_POST["correo"],
            $_POST["codigoepisodio"],
            $_POST["tiposeguro"],
            $_POST["cosaasegurada"],
            $_POST["nombrecontratante"],
            $_POST["generocontratante"],
            $_POST["fechanacimientocontratante"],
            $_POST["ocupacioncontratante"],
            $_POST["conyugeproteccion"],
            $_POST["conyugefechadenacimiento"],
            $_POST["conyugeedad"],
            $_POST["conyugegenero"],
            $_POST["retornoinversionbaja"],
            $_POST["retornoinversionmedia"],
            $_POST["retornoinversionalta"]
        );
        break;
        case "SOLICITUDOTRO_INSERT":
            print $oClick->solicitudotro_insert(
                $_POST["fecha"],
                $_POST["nombre"],
                $_POST["apellidos"],
                $_POST["pais"],
                $_POST["codigopostal"],
                $_POST["celular"],
                $_POST["correo"],
                $_POST["codigoepisodio"],
                $_POST["tiposeguro"],
                $_POST["cosaasegurada"],
                $_POST["descripcionotro"],
                $_FILES["archivo"]["name"],
                $_FILES["archivo"]["size"],
                $_FILES["archivo"]["tmp_name"],
                $_FILES["archivo"]["type"]
            );
            break;
        case "SOLICITUDOTRO_INSERTSINARCHIVOS":
            print $oClick->solicitudotro_insertsinarchivos(
                $_POST["fecha"],
                $_POST["nombre"],
                $_POST["apellidos"],
                $_POST["pais"],
                $_POST["codigopostal"],
                $_POST["celular"],
                $_POST["correo"],
                $_POST["codigoepisodio"],
                $_POST["tiposeguro"],
                $_POST["cosaasegurada"],
                $_POST["descripcionotro"]
            );
            break;
        case "LOGINICIO_INSERT":
            print $oClick->loginicio_insert($_POST["usuario"]);
            break;
        }
?>