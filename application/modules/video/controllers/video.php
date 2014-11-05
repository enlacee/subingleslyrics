<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . 'core/MY_ControllerCustom.php';

class Video extends MY_ControllerCustom {

    public function __construct()
    {   
        parent::__construct();
        $this->load->model('video/video_model');        
    }

    /**
     * view presentation UNIFY
     * @return Void show html main page.
     */
    public function index()
    {        
        $data = array();
        $aside1 = $this->video_model->getDataLast(9);
        $aside2 = $this->video_model->getDataRandom(6);
        $aside3 = $this->video_model->getDataSearch(array('lover', 'maria', 'roos', 'love'), 6);
        
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
    public function view($stringUrl = '',$idUrlHashids)
    {
        $data = array();
        $id = $this->hashids->decode($idUrlHashids);
        if (isset($id[0])) {
            $id = $id[0];
            $data = $this->video_model->getDataId($id);
        }

        
        // view
        if (count($data) > 0) {
            $this->template->set_title($data['title']);
            $this->template->set_description($data['title'] . 'SubInglesLyrics beta, videos musica en ingles, mp3');

            $this->template->add_metadata('keyworks',$data['title']);
            $this->template->add_metadata('og:title', $data['title']);
            $this->template->add_metadata('og:type', 'website');
            $this->template->add_metadata('og:image', 'https://i.ytimg.com/vi/'.$data['id_youtube'].'/hqdefault.jpg');
            $this->template->add_metadata('og:url', "" . site_url());
        }

        $this->template->add_js('modules/video/videoplayer.js');
        $this->template->add_css('pages/page_404_error.css');
        
        $this->template->load_view('video/video/view', array(
            /*'pagelet_sidebar' => Modules::run('skeleton/_pagelet_sidebar', $skeleton_data),*/
            'data' => $data
        ));                
    }

  
}

/* End of file skeleton.php */
/* Location: ./application/modules/skeleton/controllers/skeleton.php */