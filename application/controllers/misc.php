<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Misc extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index(){
			redirect('/welcome');
	}

        function universe(){
            $data = array(
            'title' => 'Magnifying The Universe',
            'content' => 'misc/universe_view',
            'msg' => 'Interesting <a href="http://www.numbersleuth.org/universe/" target="_blank">stuff</a>.',
            'page_title' => 'Science Stuff',
        );
        $this->load->view('page_guest', $data);
        }


        function lyn(){
		$data = array(
			'title' => 'Site Stuff',
				'content' => 'misc/lyn_view',
				'page_title' => 'Site Stuff',
				'msg' => '',
				'error' => 0,
				'page_heading' => 'Some stuff you might be interested in.',
		);
		$this->load->view('page_guest',  $data);
	}

}
?>