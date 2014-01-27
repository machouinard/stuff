<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lpr extends CI_Controller{


    function __construct() {
            parent::__construct();
        }

    function index(){
        $data = array(
            'title' => 'Grandpa\'s Picture \'O Day Site',
            'content' => 'video/lpr_robin_view',
            'msg' => 'How to add photos to Grandpa\'s Picture \'O Day site.<br /><span class="small_text">click the photo to see the video</span>',
            'page_title' => 'Something simple for Grandpa',
            'js1' => '/qtp_files/scripts/prototype.js',
            'js2' => '/qtp_files/scripts/qtp_poster.js',
            'css1' => '/qtp_files/stylesheets/qtp_poster.css'
        );
        $this->load->view('page_guest', $data);
    }


}
?>