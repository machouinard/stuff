<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tidbits extends CI_Controller{


    function __construct() {
            parent::__construct();
        }

    function index(){
        $data = array(
            'title' => 'Computing Tidbits I\'ve picked up',
            'content' => 'support/tidbits',
            'msg' => 'Some things I\'ve picked up along the way.<br />Should\'ve started this list long ago...',
            'page_title' => 'More Stuff',
            'page_heading' => 'Things I don\'t want to forget',
        );
        $this->load->view('page_guest', $data);
    }


}
?>