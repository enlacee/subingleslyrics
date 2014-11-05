<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['assets_url'] = 'http://localhost/www.subingleslyrics.com/assets/';


// 01 - config addional by library composer
$config['hashids'] = new Hashids\Hashids(
    'this is my salt SubInglesLyrics.com',  4,
    '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
);


/* End of file assets.php */
/* Location: ./application/config/assets.php */