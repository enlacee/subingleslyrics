<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 03 getter data of API youtube for adding data to database
*
*/
class ApiYoutube extends MY_Controller {
    
    public $tb_video = 'ac_videos';
    

    public function __construct()
    {   
        parent::__construct();        
        $this->load->library('template');
        $this->load->model('video/video_model');
    }
    
    /**
    * View Cron
    * NOT paginator Select all data of table
    * @return view js
    */
    public function index() 
    {
        // 01 data sql
        $this->db->from($this->tb_video);
        $count = $this->db->count_all_results();        
        $this->db
            ->select('id, id_youtube')  
            ->limit($count) // list unlimited, all data.
            ->from($this->tb_video);
        $query = $this->db->get();
        $rs = $query->result_array();

        // 01 format string
        $stringId = '';
        foreach($rs as $key => $value ) {
            $stringId .= "{id:{$rs[$key]['id']}, id_youtube:'{$rs[$key]['id_youtube']}'},";
        }        
        if (strlen($stringId) > 0) {
            $stringId = substr($stringId, 0, strlen($stringId)-1);
        }
        

        // 02 view        
        $urlprocess = site_url('cron/apiyoutube/processData');
        $script = <<< JS
        var data = [{$stringId}];

        var indice = 0;

        function initTimer() {

            var i = indice;

            setTimeout(function() {
                               
                if (data.length != i) {
                    console.log ('i', i); 
                    ajaxApiYoutube(data[i].id, data[i].id_youtube); 
                    initTimer();
                }

            }, 1000, i);

            indice = i + 1;
        }


        function ajaxApiYoutube(id, id_youtube) {

            var YOUR_API_KEY = 'AIzaSyAcCVPcE82YyBxnXdn3RPSpEV0M8CQGVdY';
            var id_youtube = id_youtube;
            $.ajax({
                url: 'https://www.googleapis.com/youtube/v3/videos?id='+id_youtube+'&key='+YOUR_API_KEY+'&part=snippet,contentDetails,statistics,status',               
                data : {op : ''},
                type: 'GET',
                dataType: 'json',
                success: function (rs){
                    postData = {id:id, id_youtube:id_youtube, rs:rs}
                    $.post( "{$urlprocess}",postData, function( data ) {
                      $( "#display" ).append(id+" = "+id_youtube+" | ");
                    });
                }
            });     
        }

        function sleepFor( sleepDuration ){
            var now = new Date().getTime();
            while(new Date().getTime() < now + sleepDuration){ /* do nothing */ } 
        }        

        /* init cron JS
        initTimer();*/

JS;

        $this->template->add_jsnip($script);        
        $this->template->set_title('Cron - Api Youtube');
        $this->template->load_view('cron/apiyoutube/index.php', array('table' => $this->tb_video));

    }

    /**
     * Process data get JS api youtube
     * @param type $paramSearch
     */
    public function processData()
    {
        $return = false;

        if ($this->input->post()) {
            $post = $this->input->post();

            $id = $post['id'];
            $data = $post['rs'];
            $status = 1;
            $metadata = array();

            if (isset($data['pageInfo']['totalResults'])) {
                if ($data['pageInfo']['totalResults'] == '0') {
                    $status = 0; // video delete of youtube 
                } else if ($data['pageInfo']['totalResults'] == '1') {
                    $status = 1;
                    $video = $data['items'][0];

                    // snippet
                    $metadata['id'] = $video['id'];
                    $metadata['publishedAt'] = $video['snippet']['publishedAt'];
                    $metadata['title'] = $video['snippet']['title'];
                    $metadata['description'] = $video['snippet']['description'];
                    $metadata['channelTitle'] = $video['snippet']['channelTitle'];
                    $metadata['categoryId'] = $video['snippet']['categoryId'];
                    // contentDetails
                    $metadata['duration'] = $video['contentDetails']['duration'];
                    // statistics
                    $metadata['viewCount'] = $video['statistics']['viewCount'];
                    $metadata['likeCount'] = $video['statistics']['likeCount'];
                    $metadata['dislikeCount'] = $video['statistics']['dislikeCount'];
                    $metadata['favoriteCount'] = $video['statistics']['favoriteCount'];
                    $metadata['commentCount'] = $video['statistics']['commentCount'];
                    
                }
            }

            $return = $this->saveMetaData($id, $metadata, $status);
            if ($return == true) {
                echo "success: [$id] = ".$post['id_youtube'];
            } else {
                echo "fail: [$id] = ".$post['id_youtube'];
            }

        } else {
            echo ".";
        }

    }

    /**
    * Save metadata in db
    *
    * @param $id int  primary key video
    * @param $data array
    * @return boolean succes or fail
    */
    private function saveMetaData($id, $data, $status)
    {
        //SQL
        $json = (is_array($data) && count($data) > 0) ? json_encode($data) : '';
        $this->db->where('id', $id);
        return $this->db->update($this->tb_video, 
            array('id_youtube_metadata' => $json, 'status' => $status));
    }

}
