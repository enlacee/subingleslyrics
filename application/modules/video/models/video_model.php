<?php 
/**
* model video
*
*/
class Video_model extends CI_Model {

    protected $_name = 'ac_videos';

    /**
    * init
    */
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    /*
    * Get videos GRID ! i dont use by moment
     * return array
    */
    function getData($dataGrid, $num_rows = FALSE)
    {
        $rs = false;
        
        if (!empty($dataGrid) && is_string($dataGrid)) {
            $this->db->where($dataGrid);
        } elseif (is_array($dataGrid)) {
            
            if (isset($dataGrid['string']) && !empty($dataGrid)) {
               $this->db->where($dataGrid['string']);
               
            } else {
                if (isset($dataGrid['oderby'])) {
                    $sidx = $dataGrid['oderby']['sidx'];
                    $sord = $dataGrid['oderby']['sord'];                
                    $this->db->order_by($sidx, $sord); 
                }            
                if (isset($dataGrid['limit'])) {
                    if (!empty($dataGrid['limit']) && !empty($dataGrid['start'])) {
                        $this->db->limit($dataGrid['limit'], $dataGrid['start']);
                    }else {
                        $this->db->limit($dataGrid['limit']);
                    }
                }   
            }
        }        
        
        $this->db->select();
        $this->db->from($this->_name);
        $query = $this->db->get();

        if ($num_rows === true) {
            $rs = $query->num_rows(); //$rs = $query->num_fields();
        } else {
            $rs = $query->result_array();
        }
        
        return $rs;
    }
    
    /**
     * Return data desc.
     * @param type $limit
     * @return type
     */
    public function getDataLast($limit = 5)
    {
        $date = date('Y_m_d');
        
        $keyCache = __CLASS__ .'_'. __FUNCTION__ .'_'. $date;        
        if (($rs = $this->cache->file->get($keyCache)) == FALSE) {
            $this->db->select();
            $this->db->from($this->_name);
            $this->db->limit($limit);
            $this->db->order_by('id','desc');
            $query = $this->db->get();
            $rs = $query->result_array();            
            $this->cache->file->save($keyCache, $rs);
        }
        return $rs;        
    }

    /**
     * Order desc of db.
     * @param type $limit
     * @return type
     */
    public function getDataRandom($limit = 5)
    {
        $date = date('Y_m_d');
        
        $keyCache = __CLASS__ .'_'. __FUNCTION__ .'_'. $date;        
        if (($rs = $this->cache->file->get($keyCache)) == FALSE) {
            $this->db->select();
            $this->db->from($this->_name);
            $this->db->limit($limit);
            $this->db->order_by('id','asc');
            $query = $this->db->get();
            $rs = $query->result_array();            
            $this->cache->file->save($keyCache, $rs);
        }
        return $rs;         
    }
    
    /**
     *  list of videos seaching by title (array works key)
     * @param array $array
     * @param type $limit
     * @return type
     */
    public function getDataSearch(array $array, $limit)
    {
        $date = date('Y_m_d');
        
        $keyCache = __CLASS__ .'_'. __FUNCTION__ .'_'. $date;        
        if (($rs = $this->cache->file->get($keyCache)) == FALSE) {
            $stringSearch = $array[rand(0, count($array)-1)];
            $this->db->select();
            $this->db->from($this->_name);
            $this->db->like('title', $stringSearch);
            $this->db->limit($limit);
            $this->db->order_by('id','desc');
            $query = $this->db->get();
            $rs = $query->result_array();            
            $this->cache->file->save($keyCache, $rs);
        }
        return $rs;
    }
    
    
}