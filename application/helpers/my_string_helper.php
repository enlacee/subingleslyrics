<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//si no existe la función invierte_date_time la creamos
if(!function_exists('truncate_string'))
{
    function truncate_string($cadena, $limite, $corte=" ", $pad="...")
    {   
        if(strlen($cadena) <= $limite)
            return $cadena;
        if(false !== ($breakpoint = strpos($cadena, $corte, $limite))) {
            if($breakpoint < strlen($cadena) - 1) {
                $cadena = substr($cadena, 0, $breakpoint) . $pad;
            }
        }
        return $cadena;
        
    }
}

if(!function_exists('uniqueFileName'))
{
    /**
     * Soport file extension (2,3 or 4 char)
     * ejem: $targetFileUrl('.py')
     * @param String $fileName
     * @return string
     */
    function uniqueFileName($fileName)
    {   
        $rs = false;
        if(strlen($fileName) >= 3) {
            for ($i = 3; $i <= 5; $i++) { 
                $extension =  substr($fileName, (strlen($fileName)-$i));
                if(strpos($extension, '.') !== false) {
                    $rs = time().$extension;
                    break;
                }
            }            
        }
        return $rs;
    }
}


