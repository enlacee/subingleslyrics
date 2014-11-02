<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . 'core/MY_ControllerCustom.php';

class Video extends MY_ControllerCustom {

    /**
     * view presentation
     */
    public function index()
    {

        $skeleton_data = '';
        $this->template->set_title('Video Unify...');
        $this->template->load_view('index', array(
            /*'pagelet_sidebar' => Modules::run('skeleton/_pagelet_sidebar', $skeleton_data),
            'skeleton_data' => $skeleton_data*/
        ));

        $item = '';
        $this->load->view('video/video/index', $item);     
    }

  
}

/* End of file skeleton.php */
/* Location: ./application/modules/skeleton/controllers/skeleton.php */