<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . 'core/MY_ControllerCustom.php';

class Video extends MY_ControllerCustom {

    public function __construct()
    {   
        parent::__construct();
        $this->load->model('video/video_model');        
    }

    /**
     * view presentation UNIFY, and integration google search with: (two page main search)
     * action search is view  the results.
     * 
     * @return Void show html main page.
     */
    public function index()
    {
        //$this->load->model('Video_data_model');
        //$Video = new Video_data_model($idVideo); 

        $data = array();
        $aside1 = $this->video_model->getDataLast(9);
        $aside2 = $this->video_model->getDataMoreView(6);
        //$aside3 = $this->video_model->getDataSearch(array('lover', 'maria', 'roos', 'love'), 6);
        $aside3 = $this->video_model->getDataLastSync(6);
        
        $this->template->add_js('plugins/jquery.lazyload.min.js');
        $script = <<< JS
    $(function() {
        /***** 01 Lazy load (laod images) *****/
        $("img.lazy").lazyload({
         effect : "fadeIn"
        });

        /***** 02 ToolTip boostrap *****/
        $('[data-toggle="tooltip"]').tooltip();

    });
JS;
        $this->template->add_jsnip($script);

        $this->template->set_title('Home');
        $this->template->load_view('video/video/index', array(
            'aside1' => Modules::run('video/_aside1', $aside1),
            'aside2' => Modules::run('video/_aside2', $aside2),
            'aside3' => Modules::run('video/_aside3', $aside3),                       
            'data' => $data
        ));
    }
    
    /**
     * function for create mostView
     * 
     * @param array $data array with a list of videos.
     * @retun View
     */
    public function _aside1($data)
    {
        $this->load->view('video/video/_aside1', array(
            'data' => $data,
        ));
    }
    
    /**
     * function for create mostView
     * 
     * @param array $data array with a list of videos.
     * @retun View
     */
    public function _aside2($data)
    {
        $this->load->view('video/video/_aside2', array(
            'data' => $data,
        ));
    }
    
    /**
     * function for create mostView
     * 
     * @param array $data array with a list of videos.
     * @retun View
     */
    public function _aside3($data)
    {
        $this->load->view('video/video/_aside3', array(
            'data' => $data,
        ));
    }       
    
    /**
     *  Player 
     */
    public function view($url = '')
    {
        $data = array();
        $idHash = '';
        
        if (strlen($url)>= 4) {
            $idHash = substr($url, strlen($url)-4);
        }
        
        $id = $this->hashids->decode($idHash);
        if (isset($id[0])) {
            $id = $id[0];
            $data = $this->video_model->getDataId($id);
        }
        
        // view
        if (count($data) > 0) {
            $this->template->set_title($data['title']);

            $this->template->add_metadata('description', $data['title'], false);            
            $this->template->add_metadata('keyworks', $data['title'].',', false);
            $this->template->add_metadata('og:title', $data['title'], false);
            $this->template->add_metadata('og:description', $data['title'], false);            
            $this->template->add_metadata('og:type', 'website');
            $this->template->add_metadata('og:image', 'https://i.ytimg.com/vi/'.$data['id_youtube'].'/hqdefault.jpg');
            $this->template->add_metadata('og:url', "" . site_url());
        }

        $this->template->add_js('js/modules/video/videoplayer.js');
        $this->template->add_js('js/modules/video/videoplayers.js');
        $this->template->add_css('css/pages/page_404_error.css');        

        $this->template->load_view('video/video/view', array(
            /*'pagelet_sidebar' => Modules::run('skeleton/_pagelet_sidebar', $skeleton_data),*/
            'data' => $data
        ));
    }

    /**
    * Google search integration (two pages 'page result')
    *
    * @return  
    */
    public function search()
    {
        $this->template->set_title('Search');
        // Google box search 'cse'
        $script = <<< JS
  (function() {
    var cx = '004501394547719902685:cjnwvd3iseg';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
JS;

        $this->template->add_jsnip($script);        
        $this->template->load_view('video/video/search');
    }
    
    /**
     * Test
     *  
     * @param type $url
     */
    public function test($url='')
    {
     //echo __CLASS__ . __FUNCTION__; EXIT; 
        $id = '';
        if (strlen($url)>= 4) { // .html
            $id = substr($url, strlen($url)-4);
        }
        echo $url;
        $this->template->load_view('video/video/test');
    }  
}
