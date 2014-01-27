<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Csv extends CI_Controller{

    function __construct() {
        parent::__construct();
    }


    function index(){
        $data = array(
            'title' => 'CSV Utilities',
            'content' => 'csv/csv_view',
        );
        $this->load->view('page', $data);
    }

    public function write_to_csv(){
        //print_array($this->input->post(), null, 1);
        $name = $this->input->post('name');
        $category = $this->input->post('category');
        $image_dir = '/home/machoui/public_html/'.$this->input->post('image_dir').'/';
        $url = 'http://chouinard.me/'.  $this->input->post('image_dir').'/';
        $csv_file = $image_dir.'/images.csv';
        $header = '"csv_post_title","csv_post_post","csv_post_categories","csv_post_date","csv_post_author","csv_post_slug","csv_post_type","csv_post_parent","csv_post_image"';

        $dir_handle = opendir($image_dir);
$fh = fopen($csv_file, 'a');
fwrite($fh, '"csv_post_title","csv_post_post","csv_post_categories","csv_post_date","csv_post_author","csv_post_slug","csv_post_type","csv_post_parent","csv_post_image"'."\r\n");

$regex = "([\d-]*)-at-([\d-]*)";
echo $header.  "<br />\n";
while (false !== ($entry = readdir($dir_handle))) {
        if(! preg_match('~^\.~', $entry)){

            $new_name = preg_replace('` `', '-', $entry);
            rename($image_dir.$entry, $image_dir.$new_name);

                preg_match("~$regex~", $new_name, $matches);
                $date2 = strftime("%B %d %G",strtotime($matches[1]));
                $date = strftime("%B %d %G",strtotime($matches[1])).' '.preg_replace("~-~",":",$matches[2]);
                echo $date.  " <br />\r\n";
                $time = preg_replace("~-~", ":", $matches[2]);
                //$string = '"Title'.$x.'","Body","4Runner","'.$date.'&nbsp;'.$time.'","Mark",,,,"'.$dir.$new_name.'"'."\r\n";
                $s = '"'.$matches[1].'","'.$time.'","'.$category.'","'.$date.'","'.$name.'",,,,"'.$url.$new_name.'"'."\r\n";
                fwrite($fh, $s);
                echo $s.  " <br />\r\n";

//                echo '<pre>';
//                print_r($matches);
//                echo '</pre>';

            //echo $new_name.  " <br />\r\n";


        }
    }


    }


}
?>