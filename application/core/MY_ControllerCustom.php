<?php
/**
 * @author Anibal Copitan
 * @category Library
 * 
 * Encapsulation functions  that load to start main controller
 * base MY_Controller ejm : auth, cron, check, etc..
 */

class MY_ControllerCustom extends MY_Controller {  

    private $_ci;
    // var composer
    public $hashids;

    public function __construct()
    {
        parent::__construct();

        $this->_ci =& get_instance();
             
        $this->dependecies();
        $this->loadDesignUnify();
        $this->loadComponenteComposer();

    }   
    
    /**
    * dependencies nedded this proyect (/app/core, /app/helper)
    * @return void
    */
    private function dependecies()
    {
        $this->load->library('template');        
        $this->load->helper(array(
            'my_string_helper',
            'my_videotemplate_helper'
        ));
        
        $this->load->driver('cache');
    }

    /**
     * Load library essential for design web (js ,css)     
     * Design Unify
     * @return void
     */
    private function loadDesignUnify()
    {   
        $this->template->set_title('');
        $description = 'Aprender ingles de una manera visual, escuchando y viendo frases comunes,'
          .' videos sonidos letras lyrics, musica en ingles subtitulado';
                
        $this->template->add_metadata('description', $description);
        $this->template->add_metadata('keyworks', 'aprender, ingles, letras, lyrics, video, subtitulado');
        $this->template->add_metadata('og:title', 'Aprender ingles con videos subtitulados ');
        $this->template->add_metadata('og:description', $description);        
        $this->template->add_metadata('og:type', 'website');
        $this->template->add_metadata('og:image', assets_url('favicon.ico'));
        $this->template->add_metadata('og:url', site_url());
        $this->template->add_metadata('og:site_name:', 'Subingleslyrics.com');
    }    
  /**
  * Load library composer
  * Note: this library saw call into of helpers (views)
  */
  private function loadComponenteComposer()
  {
    $ci = $this->_ci;
    // init var hasids
    $this->hashids = $ci->config->item('hashids');    

    // init var other
  }
    
}
