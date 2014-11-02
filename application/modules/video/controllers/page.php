<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . 'core/MY_ControllerCustom.php';

class Page extends MY_ControllerCustom {

    /**
     * Form attencion client (comunication)
     */
    public function contact()
    {
        $data = 'datax_contact';
        $this->template->set_title('Contact');
        $this->template->load_view('video/page/contact', array(
            /*'pagelet_sidebar' => Modules::run('skeleton/_pagelet_sidebar', $skeleton_data),*/
            'data' => $data
        ));        
        
    }

  
}

