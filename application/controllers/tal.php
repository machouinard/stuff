<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tal extends CI_Controller{
    var $errors;
    var $count;

    function __construct() {
            parent::__construct();
        }

    function index(){
        $data = array(
            'title' => 'This American Life',
            'content' => 'podcast/tal_view2',
            'msg' => 'Checking for new episodes',
            'page_title' => 'This American Life',

        );
        $this->load->view('page', $data);
    }

    function get_data(){
        $this->load->library('tal_episode');
        $this->load->model('tal_model');
        for($i=224; $i<226; $i++){
            $episode = new Tal_episode();
            $episode->number = $i;
            $episode->get_episode_info_for_db();

         //$id = $this->tal_model->db_insert($episode->info());
         //echo 'Record ID for episode '.$episode->number.': '.$id.  "<br />\n";
         print_array($episode->info());
        }
    }

    function test(){
        $this->load->library('tal_episode');
        $ep = new Tal_episode();
        $ep->number = 467;
        $result = $ep->get_episode_info();

        $file = $ep->number.'.mp3';
        $ep->save_loc = '/home/machoui/public_html/archives/thisamericanlife/'.$file;
        $ep->location = 'archives/thisamericanlife/'.$file;


//        echo 'fuck'.  "<br />\n";
//        print_array($result);



        echo $ep->get_comment();


    }

    function get_episode(){
        $this->load->library('tal_episode');
        $this->load->model('tal_model');


        $url = 'http://audio.thisamericanlife.org/jomamashouse/ismymamashouse/';

        $episodes = $this->input->post('episodes', TRUE);
//        print_array($episodes, 'line 64 tal.php', 1);

        $this->count = count($episodes);
        $this->errors = 0;
        foreach($episodes as $episode){

            $file = $episode.'.mp3';

            $ep = new Tal_episode();
            $ep->number = $episode;
            $ep->save_loc = '/home/machoui/public_html/archives/thisamericanlife/'.$file;
            $ep->location = 'archives/thisamericanlife/'.$file;
            $ep->episode_url = $url.$file;

            $ep->download_episode();

            $this->tal_model->db_insert($ep->info());
//            print_array($ep->info());

        }

//        die();

        if($this->errors == 0){
            $data = array(
                'title' => 'Downloaded',
                'content' => 'result',
                'msg' => 'Downloaded '.$this->count.' episodes',
                'page_title' => 'Added to podcasts!',
            );
            $this->load->view('page', $data);
        }else{
            $data = array(
                'title' => 'Errors',
                'content' => 'result',
                'msg' => 'There were '.$this->errors.' errors',
                'page_title' => 'Problem',
            );
            $this->load->view('page', $data);
        }


    }



//        function get_episode(){
//        $url = 'http://audio.thisamericanlife.org/jomamashouse/ismymamashouse/';
//
//        $episodes = $this->input->post('episodes', TRUE);
//        $this->count = count($episodes);
//
//        foreach($episodes as $episode){
//            $this->errors = 0;
//            $file = $episode.'.mp3';
//            $this->save_loc = '/home/machoui/public_html/archives/'.$file;
//            $this->episode_url = $url.$file;
//
//            $this->download_episode();
//            $this->get_episode_info();
//
//
//            // Add to database somehow
//
//            //
//            $tal = new Tal();
//            $tal->episode_url = 'url goes here';
//            $tal->count = 55;
//            $tal->name = 'name goes here';
//
//            $vars = get_object_vars($tal);
//            print_array($vars, NULL, 0);
//        }
//
//        die();
//
//        if($this->errors == 0){
//            $data = array(
//                'title' => 'Downloaded',
//                'content' => 'result',
//                'msg' => 'Downloaded '.$this->count.' episodes',
//                'page_title' => 'Added to podcasts!',
//            );
//            $this->load->view('page', $data);
//        }else{
//            $data = array(
//                'title' => 'Errors',
//                'content' => 'result',
//                'msg' => 'There were '.$this->errors.' errors',
//                'page_title' => 'Problem',
//            );
//            $this->load->view('page', $data);
//        }
//
//
//    }





}
?>