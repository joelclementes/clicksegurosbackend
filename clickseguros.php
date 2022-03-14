<?php
include_once 'procesosBD.php';

class jsonUsu{
	public $usuDatos="";
    public $usuPermisos="";
    public $opcDisponibles="";
}

class Seguros{

    const SERVER = "localhost";
    const USER = "root";
    const PWD = "";
    const DB = "clickseguros";

    const FILESPATH = "documentosAdjuntos/";
    const FILESPATHSTORE = "documentosAdjuntos";

    //******************** */ CATÁLOGO DE TIPOS DE SEGURO *************************/
    public function cattiposeguro_select_all(){
        $ProcesosBD = new ProcesosBD(self::SERVER,self::USER,self::PWD,self::DB);
        $consulta = "SELECT * FROM cattiposeguro";
        return $ProcesosBD->tabla($consulta);        
    }

    //********************** C R U D *******************/
    public function solicitudvehiculo_insert($fecha,$nombre,$apellidos,$pais,$codigopostal,$celular,$correo,$codigoepisodio,$tiposeguro,$tipopersona,$modelo,$marca,$version,$transmision,$descripcionversion,$tipodecobertura,$nameArchivo,$sizeArchivo,$tmpArchivo,$typeArchivo){
        $target_dir = self::FILESPATHSTORE;
        if (!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}
        $archivo = $celular.'_'.basename($nameArchivo);
        $tarjet_file = $target_dir.'/'.$archivo;
        if(move_uploaded_file($tmpArchivo,$tarjet_file)){
            $ProcesosBD = new ProcesosBD(self::SERVER,self::USER,self::PWD,self::DB);
            $sentencia1 = "INSERT INTO solicitud (fecha,nombre,apellidos,pais,codigopostal,celular,correo,codigoepisodio,tiposeguro,archivo) VALUES ('$fecha','$nombre','$apellidos','$pais','$codigopostal','$celular','$correo','$codigoepisodio','$tiposeguro','$archivo')";
            $ultimoIdSolicitud = $ProcesosBD->inserta($sentencia1);
            $sentencia2 = "INSERT INTO solicitudsegurovehiculo (idSolicitud,tipopersona,modelo,marca,version,transmision,descripcionversion,tipodecobertura) VALUES ($ultimoIdSolicitud,'$tipopersona','$modelo','$marca','$version','$transmision','$descripcionversion','$tipodecobertura')";
            return $ProcesosBD->ejecutaSentencia($sentencia2);
        }
    }

    public function solicitudvehiculo_insertsinarchivos($fecha,$nombre,$apellidos,$pais,$codigopostal,$celular,$correo,$codigoepisodio,$tiposeguro,$tipopersona,$modelo,$marca,$version,$transmision,$descripcionversion,$tipodecobertura){
        $ProcesosBD = new ProcesosBD(self::SERVER,self::USER,self::PWD,self::DB);
        $sentencia1 = "INSERT INTO solicitud (fecha,nombre,apellidos,pais,codigopostal,celular,correo,codigoepisodio,tiposeguro) VALUES ('$fecha','$nombre','$apellidos','$pais','$codigopostal','$celular','$correo','$codigoepisodio','$tiposeguro')";
        $ultimoIdSolicitud = $ProcesosBD->inserta($sentencia1);
        $sentencia2 = "INSERT INTO solicitudsegurovehiculo (idSolicitud,tipopersona,modelo,marca,version,transmision,descripcionversion,tipodecobertura) VALUES ($ultimoIdSolicitud,'$tipopersona','$modelo','$marca','$version','$transmision','$descripcionversion','$tipodecobertura')";
        return $ProcesosBD->ejecutaSentencia($sentencia2);
    }

    public function solicitudgastosmedicos_insertsinarchivos($fecha,$nombre,$apellidos,$pais,$codigopostal,$celular,$correo,$codigoepisodio,$asegurados){
        $ProcesosBD = new ProcesosBD(self::SERVER,self::USER,self::PWD,self::DB);
        $sentencia1 = "INSERT INTO solicitud (fecha,nombre,apellidos,pais,codigopostal,celular,correo,codigoepisodio,tiposeguro) VALUES ('$fecha','$nombre','$apellidos','$pais','$codigopostal','$celular','$correo','$codigoepisodio','$tiposeguro')";
        $ultimoIdSolicitud = $ProcesosBD->inserta($sentencia1);
        
        $sentencia2 = "INSERT INTO solicitudsegurovehiculo (idSolicitud,tipopersona,modelo,marca,version,transmision,descripcionversion,tipodecobertura) VALUES ($ultimoIdSolicitud,'$tipopersona','$modelo','$marca','$version','$transmision','$descripcionversion','$tipodecobertura')";
        return $ProcesosBD->ejecutaSentencia($sentencia2);
        return $asegurados;
    }
}