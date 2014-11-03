<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . 'core/MY_ControllerCustom.php';

class Video extends MY_ControllerCustom {

    /**
     * view presentation UNIFY
     * @return Void show html main page.
     */
    public function index()
    {
        $this->load->model('video/video_model');
        
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
    public function view($id = '')
    {
        $data = '-';
        $this->template->set_title('Home');
        $this->template->load_view('video/video/view', array(
            /*'pagelet_sidebar' => Modules::run('skeleton/_pagelet_sidebar', $skeleton_data),*/
            'data' => $data
        ));                
    }

  
}

/* End of file skeleton.php */
/* Location: ./application/modules/skeleton/controllers/skeleton.php */