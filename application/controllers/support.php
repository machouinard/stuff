<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller{


    function __construct() {
            parent::__construct();
        }

    function index(){

    }

    function woodojo(){
        $data = array(
            'title' => 'WooDojo Countdown',
            'content' => 'support/woodojo',
            'msg' => 'Why isn\'t the countdown showing up?<br />What am I doing wrong here?',
            'page_title' => 'No Countdown Timer',
        );
        $this->load->view('page_guest', $data);
    }
}
?>