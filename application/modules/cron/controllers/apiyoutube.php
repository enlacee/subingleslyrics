<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 003
*
*/
class ApiYoutube extends MY_Controller {
    
    public $tb_video = 'ac_videos';
    public $url = 'https://www.googleapis.com/youtube/v3/videos';
    
    
    public function __construct()
    {   
        parent::__construct();        
        $this->load->library('template');
        $this->load->model('video/video_model');
    }
    

    public function index() 
    {
        // 01 data sql
        //$this->db->from($this->tb_video);
        //$count = $this->db->count_all_results();
        $this->db
            ->select('id, id_youtube')  
            ->limit(10)          
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



        function initTimer() {
            for (var i=0; i < data.length; i++) {
                console.log(i,data[i].id_youtube);
                ajaxApiYoutube(data[i].id, data[i].id_youtube);
                console.log("before");
                sleepFor(1000)
                console.log("after");
            }
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
                      $( "#display" ).append("[echo]| ");
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
        
        $this->template->set_title('Api Youtube : index');
        $this->template->load_view('cron/apiyoutube/index.php', array());

    }

    /**
     * Process data get JS api youtube
     * @param type $paramSearch
     */
    public function processData()
    {
        var_dump($_REQUEST); EXIT;
        $this->input->post();
        $this->input->get_post();
    }

    

}
