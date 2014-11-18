<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 03 getter data of API youtube for adding data to database
*
*/
class Cron07 extends MY_Controller {
    
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
    *
    * @return view js
    */
    public function index() 
    {

        // 01 data sql
        $this->db->from($this->tb_video);
        $count = $this->db->count_all_results();        
        $this->db
            ->select('id, id_youtube, title')
            ->where('status','0')
            ->limit($count) // list unlimited, all data.
            ->from($this->tb_video);
        $query = $this->db->get();
        $rs = $query->result_array();

        // 01 format string
        $stringId = '';
        foreach($rs as $key => $value ) {
            $stringId .= "{id:{$rs[$key]['id']}, id_youtube:'{$rs[$key]['id_youtube']}',title:\"".$rs[$key]['title']."\"},\n";
        }        
        if (strlen($stringId) > 0) {
            $stringId = substr($stringId, 0, strlen($stringId)-1);
        }
        

        // 02 view        
        $urlprocessEnabledVideo = site_url('cron/cron07/processEnabledVideo');
        $urlprocessSearchVideo = site_url('cron/cron07/processSearchVideo');

        $script = <<< JS
        var YOUR_API_KEY = 'AIzaSyAcCVPcE82YyBxnXdn3RPSpEV0M8CQGVdY';
        var data = [{$stringId}];

        var indice = 0;

        function initTimer() {

            var i = indice;

            setTimeout(function() {
                               
                if (data.length != i) {
                    console.log ('i', i); 
                    ajaxApiYoutube(data[i].id, data[i].id_youtube, data[i].title); 
                    initTimer();
                }

            }, 1000, i);

            indice = i + 1;
        }


        function ajaxApiYoutube(id, id_youtube, title) {

            var id_youtube = id_youtube;
            $.ajax({
                url: 'https://www.googleapis.com/youtube/v3/videos?id='+id_youtube+'&key='+YOUR_API_KEY+'&part=snippet,contentDetails,statistics,status',               
                data : {op : ''},
                type: 'GET',
                dataType: 'json',
                success: function (rs){

                    if (rs.items.length == 0) {
                        ajaxApiYoutubeSearch(id, id_youtube, title);

                    } else { // data ok -> change status to 1
                        
                        postData = {id:id, id_youtube:id_youtube, rs:rs}
                        $.post( "{$urlprocessEnabledVideo}",postData, function(data) {
                            $("#display").append(id+" = "+id_youtube+" | ");
                        });
                    }

                }
            });     
        }

        /**
        * Search API youtube just ONE records :D
        *
        */
        function ajaxApiYoutubeSearch(id, id_youtube, title) {
            
            var maxResults = 1;
            var q = _formatTitle(title)+"+lyrics";
            var pathUrl = 'https://www.googleapis.com/youtube/v3/search';
            pathUrl += '?part=snippet';
            pathUrl += '&maxResults='+maxResults;
            pathUrl += '&q='+q;
            pathUrl += '&key='+YOUR_API_KEY;

            $.ajax({
              url: pathUrl,
              type: 'GET',
              data: '',
              success: function(rs) {
                
                var postData = {id:id, id_youtube:id_youtube, rs:rs}
                $.post( "{$urlprocessSearchVideo}", postData, function( data ) {
                    $("#display").append(id+" = "+id_youtube+" | ");
                });                
              }              
        });

        }

        function _formatTitle(str) {
            var res = str.replace('-', ' ');            
            res = res.replace(/\(/g, ''); // (
            res = res.replace(/\)/g, ''); // )               
            res = res.replace(/ /g, '+');
            return res;
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
    public function processSearchVideo()
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
                } else if ($data['pageInfo']['totalResults'] > 0) {
                    $status = 1;
                    $video = $data['items'][0];
                    $metadata['id'] = $video['id']['videoId'];
                    //$metadata['publishedAt'] = $video['snippet']['publishedAt'];
                    
                }
            }


            if (count($metadata) > 0 && isset($metadata['id']))  {
                $updateData = array(
                    'id_youtube' => $metadata['id'],
                    'updated' => date('Y-m-d h:i:s'),
                    'status' => $status
                );

                $return = $this->updateData($id, $updateData);
                if ($return == true) {
                    echo "success: [$id];";
                } else {
                    echo "fail: [$id];";
                }
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
    private function updateData($id, $data)
    {
        //SQL
        $this->db->where('id', $id);
        return $this->db->update($this->tb_video, $data);
    }

    /**
    * Status = 1
    *
    */
    public function processEnabledVideo()
    {
        $return = false;
        if ($this->input->post()) {
            $post = $this->input->post();

            $id = $post['id'];
            $updateData = array(                
                'updated' => date('Y-m-d h:i:s'),
                'status' => 1
            );

            $return = $this->updateData($id, $updateData);
            if ($return) {
                echo "success: [$id];";
            } else {
                echo "fail: [$id];";
            }
            
        }
    }

}
