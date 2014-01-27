<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Henry extends CI_Controller{


    function __construct() {
            parent::__construct();
        }

    function index(){
        $data = array(
            'title' => 'Guitar Henry',
            'content' => 'video/henry_guitar_view',
            'msg' => 'Yeah, he\'s come a long way!</span>',
            'page_title' => 'Opening up for his dog',
            'js1' => '/qtp_files/scripts/prototype.js',
            'js2' => '/qtp_files/scripts/qtp_poster.js',
            'css1' => '/qtp_files/stylesheets/qtp_poster.css'
        );
        $this->load->view('page_guest', $data);
    }


}
?>