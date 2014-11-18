<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*  Setting number view in youtube (id_youtube_metadata)
*
*
*/
class Cron06 extends MY_Controller {

    public $tb_video = 'ac_videos';    

    public function __construct()
    {   
        parent::__construct();
        $this->load->model('video/video_model');        
    }
    /**
    * execute in SHELL
    * 
    * @return void
    */
    public function index() 
    {
        echo "=======================================\n";
        echo "            EJECUTION SHELL            \n";
        echo "=======================================\n";        
        echo " = Description :                       \n";
        echo " * Update database local (views)       \n";      
        echo "=======================================\n";
        sleep(3);

        // paginador init    
        $offset = 0;
        $limit = 100;
        $this->db
            ->from($this->tb_video)
            ->where('status', '1');
        $count = $this->db->count_all_results();
        $total_pages = ($count > 0) ? ceil($count/$limit) : 1; //echo $total_pages; exit;
        $c = 1;
        for ($page = 1; $page <= $total_pages; $page++) {
            $offset = ($limit * $page) - $limit;
            //sql
            $this->db
                ->select('id,id_youtube_metadata')
                ->where('status', '1') 
                ->limit($limit, $offset)
                ->from($this->tb_video);
            $query = $this->db->get();
            $result = $query->result_array();           
            //sql
            $cc = $c;
            foreach ($result as $key => $value) {
                $answer = $this->_updateViews($result[$key]);
                if ($answer) {
                    echo "[$cc] = Update correct\n";
                } else {
                    echo "[$cc] = Update fail!\n";
                }
                $cc++;
            }
            $c = $cc;
            echo "=======================================\n";
            echo "break  for 2 seconds)\n";
            echo "data paginator : $limit \n";
            echo "=======================================\n";            
            sleep(2); // sleep for heavy load in server
        }
        // paginador end

    }


    /**
    * Udate views of metadata youtube
    *
    * @return boolean
    */
    private function _updateViews($data)
    {   
        $rs = false;
        if (isset($data['id']) && isset($data['id_youtube_metadata'])) {
            $id = $data['id'];
            $metadata = json_decode($data['id_youtube_metadata']);
            //SQL        
            $this->db->where('id', $id);
            $rs = $this->db->update($this->tb_video, array('id_youtube_view' => $metadata->viewCount));
        }

        return $rs;
    }


}
