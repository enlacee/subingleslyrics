<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . 'core/MY_ControllerCustom.php';

class Video extends MY_ControllerCustom {

    /**
     * view presentation UNIFY
     * @return Void show html main page.
     */
    public function index()
    {
        $data = array();
        $dataMostView = array();
        $dataOne = array();
        $dataTwo = array();
        
        $this->template->set_title('Home');
        $this->template->load_view('video/video/index', array(
            'homeMostView' => Modules::run('video/_homeMostView', $dataMostView),
            'homeOne' => Modules::run('video/_homeListOne', $dataOne),
            'homeListDos' => Modules::run('video/_homeListTwo', $dataTwo),
            'homeRandom' => Modules::run('video/_homeListRandom', $dataTwo),            
            'data' => $data
        ));

    }
    
    /**
     * function for create mostView
     * @param array $data array with a list of videos.
     * @retun View
     */
    public function _homeMostView($data)
    {
        $this->load->view('video/video/_homeMostView', array(
            'data' => $data,
        ));
    }
    
    /**
     * function for create mostView
     * @param array $data array with a list of videos.
     * @retun View
     */
    public function _homeListOne($data)
    {
        $this->load->view('video/video/_homeListOne', array(
            'data' => $data,
        ));
    }
    
    /**
     * function for create mostView
     * @param array $data array with a list of videos.
     * @retun View
     */
    public function _homeListTwo($data)
    {
        $this->load->view('video/video/_homeListTwo', array(
            'data' => $data,
        ));
    }       
    
    /**
     * Method rambo
     * @param array $data array with a list of videos.
     * @retun View
     */
    public function _homeListRandom($data)
    {
        $this->load->view('video/video/_homeListRandom', array(
            'data' => $data,
        ));
    }      
    
    /**
     *  Player 
     */
    public function view($id)
    {
        $data = '-';
        $this->template->set_title('Home');
        $this->template->load_view('video/video/index', array(
            /*'pagelet_sidebar' => Modules::run('skeleton/_pagelet_sidebar', $skeleton_data),*/
            'data' => $data
        ));                
    }

  
}

/* End of file skeleton.php */
/* Location: ./application/modules/skeleton/controllers/skeleton.php */