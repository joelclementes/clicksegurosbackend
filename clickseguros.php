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

    public function solicitudgastosmedicos_insert($fecha,$nombre,$apellidos,$pais,$codigopostal,$celular,$correo,$codigoepisodio,$tiposeguro,$asegurados,$nameArchivo,$sizeArchivo,$tmpArchivo,$typeArchivo){
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
            $sentencia2 = "INSERT INTO solicitudsegurogastosmedicos (idSolicitud,nombre,genero,fechanacimiento,ocupacion,practicadeportespeligrosos,parentezco) VALUES " . $this->construyeInsertAsegurados($ultimoIdSolicitud,$asegurados);
            return $ProcesosBD->ejecutaSentencia($sentencia2);
        }
    }

    public function solicitudgastosmedicos_insertsinarchivos($fecha,$nombre,$apellidos,$pais,$codigopostal,$celular,$correo,$codigoepisodio,$tiposeguro,$asegurados){
        $ProcesosBD = new ProcesosBD(self::SERVER,self::USER,self::PWD,self::DB);
        $sentencia1 = "INSERT INTO solicitud (fecha,nombre,apellidos,pais,codigopostal,celular,correo,codigoepisodio,tiposeguro) VALUES ('$fecha','$nombre','$apellidos','$pais','$codigopostal','$celular','$correo','$codigoepisodio','$tiposeguro')";
        $ultimoIdSolicitud = $ProcesosBD->inserta($sentencia1);
        
        $sentencia2 = "INSERT INTO solicitudsegurogastosmedicos (idSolicitud,nombre,genero,fechanacimiento,ocupacion,practicadeportespeligrosos,parentezco) VALUES " . $this->construyeInsertAsegurados($ultimoIdSolicitud,$asegurados);
        return $ProcesosBD->ejecutaSentencia($sentencia2);
    }

    private function construyeInsertAsegurados($id,$asegurados){
        $arrDatos = json_decode($asegurados, true);
        $totRegs = count($arrDatos);
        $contador = 0;
        $cadena="";
        foreach($arrDatos as $d){
            $cadena .= "(".$id.",'".$d["nombre"]."','".$d["genero"]."','".$d["fechanacimiento"]."','".$d["ocupacion"]."','".$d["practicadeportespeligrosos"]."','".$d["parentezco"]."')";
            $contador += 1;
            if($contador<$totRegs){
                $cadena .= ",";
            }
        }
        return $cadena;
    }

    public function solicitudvidaahorro_insert($fecha,$nombre,$apellidos,$pais,$codigopostal,$celular,$correo,$codigoepisodio,$tiposeguro,$nombrecontratante,$generocontratante,$fechanacimientocontratante,$ocupacioncontratante,$conyugeproteccion,$conyugefechadenacimiento,$conyugeedad,$conyugegenero,$retornoinversionbaja,$retornoinversionmedia,$retornoinversionalta,$nameArchivo,$sizeArchivo,$tmpArchivo,$typeArchivo){
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
            $sentencia2 = "INSERT INTO solicitudsegurovidaahorro (idSolicitud,nombrecontratante,generocontratante,fechanacimientocontratante,ocupacioncontratante,conyugeproteccion,conyugefechadenacimiento,conyugeedad,conyugegenero,retornoinversionbaja,retornoinversionmedia,retornoinversionalta) VALUES ($ultimoIdSolicitud,'$nombrecontratante','$generocontratante','$fechanacimientocontratante','$ocupacioncontratante','$conyugeproteccion','$conyugefechadenacimiento','$conyugeedad','$conyugegenero','$retornoinversionbaja','$retornoinversionmedia','$retornoinversionalta')";
            return $ProcesosBD->ejecutaSentencia($sentencia2);
        }
    }

    public function solicitudvidaahorro_insertsinarchivos($fecha,$nombre,$apellidos,$pais,$codigopostal,$celular,$correo,$codigoepisodio,$tiposeguro,$nombrecontratante,$generocontratante,$fechanacimientocontratante,$ocupacioncontratante,$conyugeproteccion,$conyugefechadenacimiento,$conyugeedad,$conyugegenero,$retornoinversionbaja,$retornoinversionmedia,$retornoinversionalta){
        $ProcesosBD = new ProcesosBD(self::SERVER,self::USER,self::PWD,self::DB);
        $sentencia1 = "INSERT INTO solicitud (fecha,nombre,apellidos,pais,codigopostal,celular,correo,codigoepisodio,tiposeguro) VALUES ('$fecha','$nombre','$apellidos','$pais','$codigopostal','$celular','$correo','$codigoepisodio','$tiposeguro')";
        $ultimoIdSolicitud = $ProcesosBD->inserta($sentencia1);
        
        $sentencia2 = "INSERT INTO solicitudsegurovidaahorro (idSolicitud,nombrecontratante,generocontratante,fechanacimientocontratante,ocupacioncontratante,conyugeproteccion,conyugefechadenacimiento,conyugeedad,conyugegenero,retornoinversionbaja,retornoinversionmedia,retornoinversionalta) VALUES ($ultimoIdSolicitud,'$nombrecontratante','$generocontratante','$fechanacimientocontratante','$ocupacioncontratante','$conyugeproteccion','$conyugefechadenacimiento','$conyugeedad','$conyugegenero','$retornoinversionbaja','$retornoinversionmedia','$retornoinversionalta')";
        return $ProcesosBD->ejecutaSentencia($sentencia2);
    }

    public function solicitudotro_insert($fecha,$nombre,$apellidos,$pais,$codigopostal,$celular,$correo,$codigoepisodio,$tiposeguro,$descripcionotro,$nameArchivo,$sizeArchivo,$tmpArchivo,$typeArchivo){
        $target_dir = self::FILESPATHSTORE;
        if (!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}
        $archivo = $celular.'_'.basename($nameArchivo);
        $tarjet_file = $target_dir.'/'.$archivo;
        if(move_uploaded_file($tmpArchivo,$tarjet_file)){
            $ProcesosBD = new ProcesosBD(self::SERVER,self::USER,self::PWD,self::DB);
            $sentencia1 = "INSERT INTO solicitud (fecha,nombre,apellidos,pais,codigopostal,celular,correo,codigoepisodio,tiposeguro,descripcionotro,archivo) VALUES ('$fecha','$nombre','$apellidos','$pais','$codigopostal','$celular','$correo','$codigoepisodio','$tiposeguro','$descripcionotro','$archivo')";
            return $ProcesosBD->ejecutaSentencia($sentencia1);
        }
    }

    public function solicitudotro_insertsinarchivos($fecha,$nombre,$apellidos,$pais,$codigopostal,$celular,$correo,$codigoepisodio,$tiposeguro,$descripcionotro){
        $ProcesosBD = new ProcesosBD(self::SERVER,self::USER,self::PWD,self::DB);
        $sentencia1 = "INSERT INTO solicitud (fecha,nombre,apellidos,pais,codigopostal,celular,correo,codigoepisodio,tiposeguro,descripcionotro) VALUES ('$fecha','$nombre','$apellidos','$pais','$codigopostal','$celular','$correo','$codigoepisodio','$tiposeguro','$descripcionotro')";
        return $ProcesosBD->ejecutaSentencia($sentencia1);
    }
}