<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Assets URL
 *
 * @access  public
 * @param   string
 * @return  string
 */
if ( ! function_exists('assets_url'))
{
    function assets_url($uri = '')
    {
        $CI =& get_instance();

        $assets_url = $CI->config->item('assets_url');

        return $assets_url . trim($uri, '/');
    }
}

// ----------------------------------------------------------------

if ( ! function_exists('toAsciiUrl'))
{
    /**
    * @return string with format url ascci
    */
    setlocale(LC_ALL, 'en_US.UTF8');
    function toAsciiUrl($str)
    {
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_| -]+/", '-', $clean);

        return $clean;
    }
}

if ( ! function_exists('generateUrlVideo'))
{
    /**
    * @param $str string title
    * @param $id integer unique
    * @return parser string url video
    */
    function generateUrlVideo($str, $id)
    {
        $CI =& get_instance();

        $url = '';

        if (!empty($str) || !empty($id)) {

            $hashids = $CI->config->item('hashids');
            
            $strUrl = toAsciiUrl($str);

            $url = 'video/view/' . $strUrl . '/' . $hashids->encode($id);
        }

        return base_url($url);
    }
}

/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */