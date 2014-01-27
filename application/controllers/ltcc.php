<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ltcc extends CI_Controller{


    function __construct() {
            parent::__construct();
        }

    function index(){

    }

    public function assign_2(){
        $data = array(
            'title' => 'Assignment 2',
            'content' => 'ltcc/assign_2',
            'msg' => 'Things started clicking for me on this one.',
            'page_title' => 'YinYang',
        );
        $this->load->view('page_guest', $data);
    }
}
?>