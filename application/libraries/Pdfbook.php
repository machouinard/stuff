<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdfbook {

    var $CI;
    var $location;
    var $name;
    var $display_name;
    var $rating;
    var $size;
    var $year_published;
    var $comments;
    var $link;
    var $image;
    var $forum;



    	public function __construct($config = array())
	{
		$this->CI =& get_instance();
                $this->CI->load->model('book_model');

		if (count($config) > 0)
		{
			$this->initialize($config);
		}

		log_message('debug', "PdfBook Class Initialized");
	}



	function initialize($config = array())
	{
		foreach ($config as $key => $val)
		{
			if (isset($this->$key))
			{
				$this->$key = $val;
			}
		}
	}


        function create(){

        }

}

/* End of file Someclass.php */