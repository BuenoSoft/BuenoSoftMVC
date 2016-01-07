<?php
namespace Lib;
class Upload 
{    
    private $folder;
    function __construct($xfolder) { 
        $this->folder = $xfolder;       
    }
    public function uploadImage($file){
        return $this->checkFile($file,  $this->getExtensionImage());
    }
    /*--colaboración de Jorge Fernando Zabala Rueda con checkImage, checkExtension, stringURLSafe y uniqueId--*/    
    private function checkFile($file,$extensiones){
        if ($file["error"] > 0){
            Session::set('msg', "ha ocurrido un error");
            return null;
        }
        else {
            if($this->checkExtension($file,$extensiones)){
                // Es mejor calcular el prefijo y ruta luego de la validacion siguiente por q si no cumple habrias hecho ese trabajo en vano   
                $limite_kb = 100;
                if ($file['size'] <= $limite_kb * 1024){
                    // Es mejor su tu mismo agregas la extension al archivo en vez de confiar en lo que 
                    // manda el usuario, existe muchos bypass a validaciones de extension usando null 
                    // bytes u otras tecnicas, por ejemplo imagen.jpg%00.php
                    // Generamos el prefijo
                    $prefijo = $this->uniqueId(6);
                    // Obtenemos la extension correcta para el archivo
                    $extension = $extensiones[array_search($file['type'], $extensiones)];
                    // Limpiamos el nombre del archivo de cualquier cosa rara
                    $nombre = $this->stringURLSafe($file['name']);
                    $archivo=$prefijo."-".$nombre.".".$extension;
                    // Y finalmente armamos la ruta final
                    $ruta = "Public/upload/". $this->folder ."/".$archivo;
                    $resultado = move_uploaded_file($file["tmp_name"], $ruta);
                    return ($resultado) ? $ruta : null;                
                }
                else {
                    Session::set('msg', "tipo de archivo no permitido o excede a los $limite_kb kb");
                    return null;
                }          
            }
            else {
                Session::set('msg', "error en la extensión");
                return null;
            }
        }
    }
    private function checkExtension($file, $types){
        $file['type'] = pathinfo($file['name'], PATHINFO_EXTENSION);
        // Aca le agrego strtolower por si envian algo como .JPG q suele ser comun
        foreach($types as $type){
            if($type == strtolower($file['type'])){
                return true;
            }
        }
        return false;
    }
    // Esta funcion nos limpiara el nombre del archivo eliminando cualquier caracter raro
    private function stringURLSafe($string){
        $str = str_replace('-', ' ', $string);
        $str = str_replace('_', ' ', $string);
        $str = str_replace('.', ' ', $string);
        $str = preg_replace(array('/\s+/','/[^A-Za-z0-9\-]/'), array('-',''), $str);
        $str = trim(strtolower($str));
        return $str;
    }
    // Mi version cuando quiero generar un id unico de longitud fija :)
    private function uniqueId($l = 8) {
        return substr(md5(uniqid(mt_rand(), true)), 0, $l);
    }
    
    private function getExtensionImage(){
        return array('jpg', 'jpeg','png', 'gif');
    }
}