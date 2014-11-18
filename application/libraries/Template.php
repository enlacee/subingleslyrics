<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Template Library
 * Handle masterview and views within masterview
 */

class Template {

    private $_ci;

    protected $brand_name = 'SubInglesLyrics';
    protected $title_separator = ' - ';
    protected $ga_id = FALSE; // UA-XXXXX-X

    protected $layout = 'default';

    protected $title = FALSE;
    
    protected $metadata = array();
    private $stacksMetaData = array(); // just useful so var

    protected $js = array();
    protected $jsnip = array();
    protected $css = array();

    function __construct()
    {
        $this->_ci =& get_instance();
    }

    /**
     * Set page layout view (1 column, 2 column...)
     *
     * @access  public
     * @param   string  $layout
     * @return  void
     */
    public function set_layout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Set page title
     *
     * @access  public
     * @param   string  $title
     * @return  void
     */
    public function set_title($title)
    {
        $this->title = $title;
    }

    /**
     * Add metadata
     *
     * @access  public
     * @param   string  $name
     * @param   string  $content
     * @param   string or boolean $position (setting position by stacks)
     * @return  void
     */
    public function add_metadata($name, $content, $position = 'asc')
    {
        $name = htmlspecialchars(strip_tags($name));
        $content = htmlspecialchars(strip_tags($content));

        if ($name == 'description'
            || $name == 'keyworks' 
            || $name == 'og:title'
            || $name == 'og:description')
        {
            $this->metadata[$name] = '';
            $stacks = $this->stacksMetaData;
            $stacks[$name][] = $content;

            // first add -> first seen
            if ($position == 'asc') {
                for ($i = 0; $i < count($stacks[$name]); $i++) {                    
                    $this->metadata[$name] .= empty($stacks[$name][$i]) ? '' : $stacks[$name][$i] .' ';
                }
            } else if ($position == 'desc' || $position == false) { // fisrt add -> last seen
                for ($i = count($stacks[$name])-1; $i >= 0; $i--) {
                    $this->metadata[$name] .= empty($stacks[$name][$i]) ? '' : $stacks[$name][$i] . ' ';
                }
            }
            $this->metadata[$name] = trim($this->metadata[$name]);    
            $this->stacksMetaData = $stacks;

        } else {
            $this->metadata[$name] = $content;
        }
    }

    /**
     * Add js file path
     *
     * @access  public
     * @param   string  $js
     * @return  void
     */
    public function add_js($js)
    {
        $this->js[$js] = $js;
    }

    /**
    * Add jscript Snip (litle) (not valid double code)
    *
    * @param string $strScript
    * @return void
    */
    public function add_jsnip($strScrip)
    {   
        $this->jsnip[] = $strScrip;
    }

    /**
     * Add css file path
     *
     * @access  public
     * @param   string  $css
     * @return  void
     */
    public function add_css($css)
    {
        $this->css[$css] = $css;
    }

    /**
     * Load view
     *
     * @access  public
     * @param   string  $view
     * @param   mixed   $data
     * @param   boolean $return
     * @return  void
     */
    public function load_view($view, $data = array(), $return = FALSE)
    {
        // Not include master view on ajax request
        if ($this->_ci->input->is_ajax_request())
        {
            $this->_ci->load->view($view, $data);
            return;
        }

        // Title
        if (empty($this->title))
        {
            $title = $this->brand_name;
        }
        else
        {
            $title = $this->title . $this->title_separator . $this->brand_name;
        }

        // Metadata
        $metadata = array();
        foreach ($this->metadata as $name => $content)
        {
            if (strpos($name, 'og:') === 0)
            {
                $metadata[] = '<meta property="' . $name . '" content="' . $content . '">';
            }
            else
            {
                $metadata[] = '<meta name="' . $name . '" content="' . $content . '">';
            }
        }
        $metadata = implode('', $metadata);

        // Javascript
        $js = array();
        foreach ($this->js as $js_file)
        {
            $js[] = '<script src="' . assets_url($js_file) . '"></script>';
        }
        $js = implode('', $js);

        // Javascript Snip
        $jsnip = array();
        foreach ($this->jsnip as $jsnip_script)
        {
            $jsnip[] = '<script type="text/javascript" charset="utf-8">' . $jsnip_script . '</script>';
        }
        $jsnip = implode('', $jsnip);        

        // CSS
        $css = array();
        foreach ($this->css as $css_file)
        {
            $css[] = '<link rel="stylesheet" href="' . assets_url($css_file) . '">';
        }
        $css = implode('', $css);

        $header = $this->_ci->load->view('header', array(), TRUE);
        $footer = $this->_ci->load->view('footer', array(), TRUE);
        $main_content = $this->_ci->load->view($view, $data, TRUE);

        $body = $this->_ci->load->view('layout/' . $this->layout, array(
            'header' => $header,
            'footer' => $footer,
            'main_content' => $main_content,
        ), TRUE);

        return $this->_ci->load->view('base_view', array(
            'title' => $title,            
            'metadata' => $metadata,
            'js' => $js,
            'jsnip' => $jsnip,
            'css' => $css,
            'body' => $body,
            'ga_id' => $this->ga_id,
        ), $return);
    }
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */