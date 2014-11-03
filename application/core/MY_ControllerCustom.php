<?php
/**
 * @author Anibal Copitan
 * @category Library
 * 
 * Encapsulation functions  that load to start main controller
 * base MY_Controller ejm : auth, cron, check, etc..
 */

class MY_ControllerCustom extends MY_Controller {    

    public function __construct()
    {
        parent::__construct();        
        $this->dependecies();
        $this->loadDesignUnify();

    }   
    
    /**
    * dependencies nedded this proyect (/app/core, /app/helper)
    * @return void
    */
    private function dependecies()
    {
    	$this->load->library('template');

    }

    /**
     * Load library essential for design web (js ,css)     
     * Design Unify
     * @return void
     */
    protected function loadDesignUnify()
    {   
        $this->template->set_title('');
        $this->template->set_description('descriptions...');
        $this->template->add_js('modules/video/file.js');
        $this->template->add_css('modules/video/file.css'); 
    }    
  
    
}
