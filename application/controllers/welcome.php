<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


        function __construct() {
            parent::__construct();
        }

	public function index()
	{
		$data = array(
                  'title' => 'stuff',
                    'page_title' => "hello",
                    'content' => 'welcome_message',
                    'msg' => 'PHP, MySQL, Javascript,<br />&nbsp;&nbsp;&nbsp;&nbsp; CSS, HTML5 & More!',
                    'page_heading' => 'Virtual Playground For Some Computer Science Experiments<br />- or -<br />My Endless Battle Against Insomnia',
//                    'logo' => '/images/graphics/dummies6.png',
                    'logo' => '/images/graphics/coder140.gif',
                );
                $this->load->view('page_guest', $data);
	}

        function not_admin(){
            $data = array(
                'title' => 'Nope',
                'content' => 'result',
                'page_title' => '$access->deny();',
                'msg' => 'Sorry, this page is not for you.',
                'page_heading' => 'Admin Access Only',
            );
            $this->load->view('page_guest', $data);
                }

        public function resume(){
        	$data = array(
        				'title' => 'My "Resume"',
        					'content' => 'resume',
        					'page_title' => 'Resume',
        					'page_heading' => '',
        					'msg' => 'brief but accurate assesment of my work history/ability',
        			);
        			$this->load->view('page_guest', $data);
        }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
