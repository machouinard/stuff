<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller{

    function __construct() {
        parent::__construct();
    }


    function index(){
        $data = array(
            'title' => 'FAQ',
            'content' => 'utility/faq_view',
            'page_title' => 'FAQs',
            'msg' => 'frequently asked questions',
            'css' => 'faq.css',
            'script' => 'faq.js',
        );
        $this->load->view('page_guest', $data);
    }


}
?>