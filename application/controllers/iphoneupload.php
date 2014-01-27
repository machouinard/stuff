<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Iphoneupload extends CI_Controller{


    function __construct() {
        parent::__construct();
    }

    function index(){
        $this->load->model('image_model');
        $uploadDir = 'images/iphone/';
        $thumbDir = 'images/iphone/thumbs/';
        $data = array(
          'dir' => $thumbDir,
          );
        build_dir_structure($data);
        $data = array(
          'dir' => $uploadDir,
          );
        build_dir_structure($data);
        $file_name = basename($_FILES['userfile']['name']);
        $path_parts = pathinfo($file_name);
        $ext = $path_parts['extension'];
        $time = date("MdGs");
        $new_filename = $time .'.'. $ext;
        $newName = $uploadDir . $new_filename;
        $temp = $_FILES['userfile']['tmp_name'];
        move_uploaded_file($temp, $newName);
        $this->image_model->fix_rotation($newName);
        $thumb = $thumbDir.$time.'_thmb.'.$ext;
        $this->image_moo->load($newName)->resize(800,800)->save($newName, true)->resize(250,250)->save($thumb);
            //write post data to file for testing
        $size = $_FILES['userfile']['size'];
        $post = print_r($_POST, TRUE);



        $comments = $_POST['comment'];
        $name = $_POST['name'];
        $url = 'http://stuff.chouinard.me/'.$newName;
        list($width, $height, $type, $attr) = getimagesize($newName);

        $data = array(
          'image_loc' => $newName,
          'thumb_loc' => $thumb,
          'attr' => $attr,
          'file_name' => $new_filename,
          'comments' => $comments,
          'name' => $name,
          'image_url' => $url,
          'thumb_url' => 'http://stuff.chouinard.me/'.$thumb,
          );

        $this->db->insert('ios_images', $data);
    }

    function test(){
        $this->load->model('image_model');
        $uploadDir = 'images/iphone/';
        $file_name = basename($_FILES['userfile']['name']);
        $path_parts = pathinfo($file_name);
        $ext = $path_parts['extension'];
        $time = date("MdGs");
        $new_filename = $time .'.'. $ext;
        $newName = $uploadDir . $new_filename;
        $temp = $_FILES['userfile']['tmp_name'];
        move_uploaded_file($temp, $newName);
        $this->image_model->fix_rotation($newName);
        $thumb = "images/iphone/thumbs/".$time.'_thmb.'.$ext;
        $this->image_moo->load($newName)->resize(800,800)->save($newName, true)->resize(250,250)->save($thumb);
            //write post data to file for testing
        $size = $_FILES['userfile']['size'];
        $post = print_r($_POST, TRUE);



        $comments = $_POST['comment'];
        $name = $_POST['name'];
        $url = 'http://stuff.chouinard.me/'.$newName;
        list($width, $height, $type, $attr) = getimagesize($newName);

        $data = array(
          'image_loc' => $newName,
          'thumb_loc' => $thumb,
          'attr' => $attr,
          'file_name' => $new_filename,
          'comments' => $comments,
          'name' => $name,
          'image_url' => $url,
          'thumb_url' => 'http://stuff.chouinard.me/'.$thumb,
          );

        $this->db->insert('ios_images', $data);
    }

    public function hankup(){
        $data = array(
            'title' => 'test',
            'content' => 'test_view',
            'msg' => 'message',
            'page_title' => 'page_title',
            );
        $this->load->view('page_guest', $data);
    }



    public function gallery(){
        $this->load->library('table');
        $ios_album = $this->image_model->ios_album();
        if($ios_album == "Undefined table data"){
            $ios_album = "<h2>No Images to Display</h2>";
        }
        $data = array(
            'title' => 'iOS App Gallery',
            'content' => 'iphone/gallery_view',
            'msg' => '<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;test gallery',
            'page_title' => 'Uploader App Gallery',
            'script' => 'slimbox2.js',
            'css' => 'slimbox2.css',
            'logo' => '/images/graphics/appstoregreen.png',
            'data' => array(
                'display' => 0,
                'ios_album' => $ios_album,
                ),
            );
        $this->load->view('page_guest', $data);
    }



    public function delete_image(){
        $id = $this->uri->segment(3);
        //echo 'ID: '.$id;
        $result = $this->image_model->delete_ios_image($id);
        if($result == 'success'){
            redirect('/iphoneupload/gallery');
        }else{
            $data = array(
                'title' => 'Error',
                'content' => 'result',
                'msg' => 'There was a problem',
                'page_title' => 'Error deleting image',
                'data' => array(
                    'display' => 1,
                    'result' => $result,
                    'result_title' => 'Error!',
                    ),
                );
            $this->load->view('page', $data);
        }




    }

}
?>