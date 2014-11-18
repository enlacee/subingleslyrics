<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//si no existe la función invierte_date_time la creamos
if(!function_exists('vtLevelDescription'))
{
    /**
    * create button level in difficulty
    * @param $intlevel level number (1-3)
    * @param $stringTime time string returned by youtube 
    * @ return string html 
    */
    function vtLevelDescription($intlevel, $stringTime = '')
    {   
        $html = '';
        $description = false;
        $class = 'btn-u';
        $number = (int) $intlevel;
        if ($number == 1) {
            $description = 'easy';
            $class = 'btn-u-green';
        } else if ($number == 2) {
            $description = 'medium';
            $class = 'btn-u-yellow';
        } else if ($number == 3) {
            $description = 'advanced';
            $class = 'btn-u-red';
        }


        $html = '<a class="btn-u btn-u-xs '. $class .'" href="#">';
        $html .= "{$description}{$stringTime}";
        $html .= '</a>';
        
        return $html;
    }
}