<?php

class Webcam extends CI_Controller{

	function __construct() {
		parent::__construct();
	}

    public function index(){

        $data['title'] = 'Webcam';
        $data['page_title'] = "Webcam Test Page";
        $data['content'] = 'cam/webcam_view_geo';
        $this->load->view('page_guest', $data);

    }

    function test(){
        $this->load->helper('text');
        $lat = NULL;
        $lon = NULL;
        if($this->uri->segment(3) !== 'shit'){
            $lat = $this->uri->segment(3);
        }
        if($this->uri->segment(4) !== 'shit'){
            $lon = $this->uri->segment(4);
        }
        $words = $this->uri->segment(5);
        $comment = urldecode($words);


        //Get user info
        // $user = $this->ion_auth->get_user();
        // $user_id = $user->id;
        $year        = date("Y");
        $month       = date("m");
        $orig_dir    = 'images/original/'.$year.'/'.$month.'/';
        $upload_dir  = 'images/resized/'.$year.'/'.$month.'/';
        $thumb_dir   = 'images/thumbs/'.$year.'/'.$month.'/';
        $base_name   = date("YmdGis");
        $file_name   = $base_name.'.jpg';
        $thumb_name  = $base_name.'_thumb.jpg';
        $preview_dir = 'images/preview/';
        $dir_data    = array(
          'orig_dir'    => $orig_dir,
          'upload_dir'  => $upload_dir,
          'thumb_dir'   => $thumb_dir,
          'preview_dir' => $preview_dir,
          );
        build_dir_structure($dir_data);



        $jpeg_data    = file_get_contents('php://input');
        $orig_loc     = $orig_dir.$file_name;
        $preview_file = $preview_dir.$file_name;

        $saved_file   = $upload_dir.$file_name;
        $result       = file_put_contents( $saved_file, $jpeg_data );

        $this->image_moo->load($saved_file)->resize(270,270)->save($preview_file)->resize_crop(125,125)->save($thumb_dir.$thumb_name);

        $url = base_url() . $preview_file;
        print "$url\n";

        copy($saved_file, $orig_loc);

        ///////////FOR DB
//         list($width, $height, $type, $attr) = getimagesize($saved_file);
//         $file_size = filesize($saved_file);

//         $newData['comment'] = $comment;
//         $newData['tag'] = '';
//         $newData['new_tag'] = '';
//         $newData['album'] = $album = '2';
//         $newData['method_id'] = '5';
//         $newData['file_name'] = $file_name;
//         $newData['file_loc'] = $file_loc = $saved_file;
//         $newData['file_url'] = base_url().$file_loc;
//         $newData['orig_url'] = base_url().$orig_loc;
//         $newData['thumb_name'] = $thumb_name;
//         $newData['thumb_loc'] = $thumb_loc = $thumb_dir.$thumb_name;
//         $newData['thumb_url'] = base_url().$thumb_loc;
//         $newData['ext'] = 'jpg';
//         $newData['file_size'] = $file_size;
//         $newData['file_dim'] = $attr;
//         $newData['user_id'] = $user_id;
//         $newData['num_tags'] = '';
//         $newData['date_taken'] = 1;
//         $newData['time'] = $time = date("Y-m-d G:i:s");

//         if($lat !== NULL && $lon !== NULL){
//           $newData['gps'] = array(
//                     'lat' => $lat,
//                     'long' => $lon,
//                 );
//                 $newData['type'] = 'webcam';
//                 $newData['label'] = NULL;
//         };

        $test_time = date("D M d G:i:s e Y");
        log_message('error', "PHP time is $test_time, System time is ".exec('date')." w");

//         $image_id = $this->image_model->create($newData);

        ///////////

//         $album_id = '2';
//         $data = array(
//             'image_id' => $image_id,
//             'album_id' => $album_id,
//         );
//         $this->image_model->images_album($data);
//         ///Add to user album for displaying user's images
//           $user_album_id = $this->album_model->get_user_album_id($user_id);
//           $user_album_data = array(
//                 'image_id' => $image_id,
//                 'album_id' => $user_album_id,
//           );
//           $this->image_model->images_album($user_album_data);
    }



}
?>
