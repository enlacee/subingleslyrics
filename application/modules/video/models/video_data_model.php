<?php

/**
 * Description Logic and model of data, select filter return a object
 *
 * @author anb
 */
class Video_data_model extends CI_Model {
    
    protected $_table = 'ac_videos';
    public $video = null;

    /**
    * init construct
    *
    * @param $id int indice record
    * @param $status integer 
    * @param $table string table name
    * 
    * @return Video_data_model object
    */
    public function __construct($id = null, $status = '', $table = '')
    {
        parent::__construct();
        
        if (!empty($id)){
            if (is_integer($id)) {
                $this->video = $this->getDataById($id);
            } else if (is_string($id)) {
                $this->video = $this->getDataByIdYoutube($id);                
            }
          
            //$this->numVariables = count($this->video);
            //$this->_vincularDatos();
        }

        return $this->video;
    }

    /**
    * Get data one record
    *
    * @param $id integer indice
    * @param $status integer status (0,1)
    * @return array
    */
    public function getDataById($id, $status = '')
    {
        $keyCache = __CLASS__ .'_'. __FUNCTION__ .'_'. $id;        
        if (($rs = $this->cache->file->get($keyCache)) == FALSE) {
            //$selectStr = 'id, id_youtube, id_youtube_more, id_youtube_metadata'; 
            $this->db->select()->from($this->_name);
            $this->db->where('id', $id);
            if (empty($status)) {
                $this->db->where('status', $status);
            }
            $this->db->limit(1);            
            $query = $this->db->get();
            $rs = $query->row_array();            
            $this->cache->file->save($keyCache, $rs);
        }
        return $rs;  
    }

    /**
    * Get data one record
    *
    * @param $id integer indice
    * @param $status integer status (0,1)    
    * @return array    
    */
    public function getDataByIdYoutube($id, $status = '')
    {
        $keyCache = __CLASS__ .'_'. __FUNCTION__ .'_'. $id;        
        if (($rs = $this->cache->file->get($keyCache)) == FALSE) {
            $this->db->select()->from($this->_name);
            $this->db->where('id_youtube', $id);
            if (empty($status)) {
                $this->db->where('status', $status);
            }                       
            $this->db->limit(1);            
            $query = $this->db->get();
            $rs = $query->row_array();            
            $this->cache->file->save($keyCache, $rs);
        }
        return $rs;  
    }    


   
    
    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------

}
