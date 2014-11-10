<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 02 : Cron ejecutar by terminal (cli-php)
* scrap to subingles for get data of videos relation
*
* php /var/www/www.subingleslyrics.com/index.php cron subingles search
*
*/
class SubIngles extends MY_Controller {
    
    public $tb_video = 'ac_videos';
    
    
    public function __construct()
    {   
        parent::__construct();
        $this->load->model('video/video_model');        
    }
    
    /**
     * Function Base to scrap | search
     * @param type $paramSearch
     */
    public function search()
    {   
        echo "Ejecute in BASH (Custom for bash)\n";
        echo "\n";
        sleep(3);
        echo "=======================================\n";
        echo "Search Data in www.subingles.com\n";
        echo "=======================================\n";
        // paginador init    
        $offset = 0;
        $limit = 100;
        $this->db->from($this->tb_video);
        $count = $this->db->count_all_results();

        $total_pages = ($count > 0) ? ceil($count/$limit) : 1; //echo $total_pages; exit;

        for ($page = 1; $page <= $total_pages; $page++) {
            $offset = ($limit * $page) - $limit;
            $queryLimit = " LIMIT $offset,$limit ";
            $query = "SELECT  id, title FROM {$this->tb_video} " . $queryLimit;
            $stm = $this->db->query($query);
            $result = $stm->result_array();

            foreach ($result as $key => $value) {
                $part = explode('-', $result[$key]['title']);
                $song = $part[0];
                $artist = $part[1];               
                
                $id = $result[$key]['id'];                
                $this->searchAndUpdate($id, $artist .' '. $song);
                echo " [{$id}]  = " . $artist . ' ' . $song ."\n";                
            }
            echo "break (stop request for 5'')\n";
            sleep(5); // sleep for heavy load in server
        }
        // paginador end

        
        
    }

    /**
     * Get data main video, other ids videos relation 
     */
    private function searchAndUpdate($id, $paramSearch)
    {
        //set POST variables
        $json = '';
        $url = "http://www.subingles.com/songs/newvideo";
        $fields = array(
            'data[Song][newvideo]' => urlencode($paramSearch), //urlencode('Westlife Mandy'),
        );

        //url-ify the data for the POST
        $fields_string = '';
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');        

        //open connection
        $ch = curl_init();
      
        //set the url, number of POST vars, POST data
        //curl_setopt($ch, CURLOPT_HEADER, 0);
        $timeout = 5;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

       // curl_setopt($ch, CURLOPT_NOBODY, true);
        //execute post
        $result = curl_exec($ch);
        
        //close connection
        curl_close($ch);        
       
        $json = $this->getStringJson($result);
        
        //SQL
        $this->db->where('id', $id);
        $this->db->update($this->tb_video, array('id_youtube_more' => $json));
        //var_dump( $this->db->query('SELECT version()'));
        return true;
    }
    
    /**
     * Get data in format json
     * @param type $str
     * @return boolean
     */
    private function getStringJson($str)
    {
        // fisrt filter
        $firstFilter = "]='"; 
        if (!strstr($str, $firstFilter)) {
            return false;
        }        
        $array = explode($firstFilter, $str);        
        
        // filter clear tab enter return car
        foreach ($array as $key => $value) {
            $haystack = "';";
            $value = str_replace(array("\n", "\r", '\t'), '', $value);
            $value = preg_replace('/\s+/', ' ', $value);
            $value = trim ($value);
            $array[$key] = $value;
        }
        
        // second filter
        $ids = array();
        foreach ($array as $key => $value) {
            $haystack = "';";        
            if (strstr($value, $haystack)) {
                $part = explode($haystack, $value);
                if (strlen($part[0]) == 11) {
                    $ids[] = array('id' => $part[0]);
                }                
            }
        }
        
        return (count($ids) > 0) ? json_encode($ids) : false;
    }
    
    /**
     * Demo SCRAP
     * @param type $url
     * @return type
     */
    public function getCurldata($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }    

}
