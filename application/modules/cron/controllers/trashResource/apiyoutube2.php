<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 03 valid videos SHELL
* Create new tabla and insert data with api youtube
*
*/
class ApiYoutube2 extends MY_Controller {
    
    public $tb_video = 'ac_videos';
    public $tb_video_helper = 'ac_videos_helper';
    

    public function __construct()
    {   
        parent::__construct();        
        $this->load->library('template');
        $this->load->model('video/video_model');
    }
    
    /**
    * execute in SHELL
    * Lista all  data video with status = 0 (for fix in other table)
    * 
    * VALIDAR() status for create database 1 = create 0 = default overwrite 
    * @return void
    */
    public function index() 
    {
        echo "Ejecute in BASH (Custom for bash)\n";
        echo "\n";
        sleep(3);
        echo "=======================================\n";
        echo "Insert Data  in www.subingles.com\n";
        echo "tables :  {$this->tb_video} \n";
        echo "tables :  {$this->tb_video_helper} \n";        
        echo "=======================================\n";
        if ($this->createTable()) {
            echo "CREATE TABLE {$this->tb_video_helper} \n";
        }else {
            echo "{$this->tb_video_helper} TABLE EXISTS \n";
        };

        // paginador init    
        $offset = 0;
        $limit = 1;
        $this->db
            ->from($this->tb_video)
            ->where('status', '0');
        $count = $this->db->count_all_results();
        $total_pages = ($count > 0) ? ceil($count/$limit) : 1; //echo $total_pages; exit;

        for ($page = 1; $page <= $total_pages; $page++) {
            $offset = ($limit * $page) - $limit;
            //sql
            $this->db
                ->select('id, id_youtube_more')
                ->where('status', '0') 
                ->limit($limit,$offset)
                ->from($this->tb_video);
            $query = $this->db->get();
            $result = $query->result_array();            
            //sql
            foreach ($result as $key => $value) {                
                $this->validar($result[$key]);
            }
            echo "=======================================\n";
            echo "Break (stop requests for 5'')\n";
            echo "=======================================\n";
            sleep(5); // sleep for heavy load in server
        }
        // paginador end

    }

    /**
     * valid video (custom logic)
     *
     * @param $data data (data variable id_youtube_more = json)
     * @param type $paramSearch
     * @return void
     */
    private function validar($data)
    {
        if (count($data) > 0) {

            $dataJson = json_decode($data['id_youtube_more']); //echo "<pre>"; print_R($dataJson);exit;
            // Unwrap dataJson 'id_youtube_more' IDS
            if (is_array($dataJson) && count($dataJson) > 0) {
                foreach ($dataJson as $key => $obj) {
                    # code...                
                    $idata['id_youtube'] = $obj->id;
                    $idata['status'] = '1';
                    $idata['ref_id_origen'] = $data['id'];

                    //insert
                    $this->db->insert($this->tb_video_helper, $idata);
                    $this->db->insert_id();
                    echo "[$key] = new record  {$obj->id} \n";
                }                
            }
        }

    }


    /**
    * Create new tabla helper
    * Im ask if table exist else create
    *
    * @param $create boolean status to create table
    * @return boolean
    */
    private function createTable($create = false)
    {   
        $return = false;
        $query = "
        SELECT *
         FROM INFORMATION_SCHEMA.TABLES 
         WHERE TABLE_NAME = '{$this->tb_video_helper}' ";
        $stm = $this->db->query($query);
        $count = (int) $stm->num_rows();
        

        if ($count == 0 || $create == '1') {
            $this->load->dbforge();
            $fields = array(
                'id' => array(
                     'type' => 'INT',                  
                     'unsigned' => TRUE,
                     'auto_increment' => TRUE
                                  ),            
                'id_youtube' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '11',
                    'null' => TRUE,
                ),
                'id_youtube_metadata' => array(
                    'type' => 'TEXT',
                    'null' => TRUE,
                ),
                'status' => array(
                    'type' =>'VARCHAR',
                    'constraint' => '1',
                    'null' => TRUE,
                ),
                'ref_id_origen' => array(
                    'type' =>'INT',
                    'null' => TRUE,
                )            
            );

            $this->dbforge->drop_table($this->tb_video_helper);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->add_field($fields);                    
            $return = $this->dbforge->create_table($this->tb_video_helper);
        }

        return $return;      
    }

    /**
    * Save metadata in db
    *
    * @param $id int  primary key video
    * @param $data array
    * @return boolean succes or fail
    */
    private function saveMetaData($id, $data, $status)
    {
        //SQL
        $json = (is_array($data) && count($data) > 0) ? json_encode($data) : '';
        $this->db->where('id', $id);
        return $this->db->update($this->tb_video, 
            array('id_youtube_metadata' => $json, 'status' => $status));
    }

}
