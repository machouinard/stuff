<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller{
	var $extension;

	public function __construct(){
		parent::__construct();
	}

    public function index(){
        $this->load->library('table');
        $data = array(
            'title' => 'Test',
            'content' => 'fact_view',
            'page_title' => 'Test',
            'msg' => 'test message',
            );
        $this->load->view('page_admin', $data);
    }

    public function divs(){
        $data = array(
            'title' => 'Div Test',
            'content' => 'test/test_view',
            'page_title' => 'Centered Div',
            'msg' => "from<br /><a href='http://matthewjamestaylor.com/blog/beautiful-css-centered-menus-no-hacks-full-cross-browser-support' target='_blank'>Matthew James Taylor</a>"
            );
        $this->load->view('page_guest', $data);
    }

    public function dbTest(){

        $this->db->select('*');
        $this->db->from('podcasts');
        $this->db->where('number >', 470);
//            $query = $this->db->get();
        $query = $this->db->query("SELECT * FROM podcasts WHERE number > 470");
        foreach($query->result() as $row){
            echo '<pre>';
            print_r($row);
            echo '</pre>';
        }
    }

    public function arrayTest(){
        $x = array(
            'one'    => 1,
            'two'    => 2,
            'three'  => 3,
            'eight'  => 8,
            'twenty' => 20
            );
        $y = array(
            'one'    => 'one',
            'two'    => 'two',
            'three'  => 'three',
            'eight'  => 'eight',
            'twenty' => 'twenty'
            );

        $add   = $x + $y;
        $addB  = $y + $x;
        $merge = array_merge($x, $y);

        asort($addB);

        echo '<pre>';
        print_r($add);
        print_r($addB);
        print_r($merge);
        echo '</pre>';
    }

    public function title(){
        $host   = 'localhost';
        $dbname = 'machoui_stuff';
        $user   = 'machoui_php';
        $pass   = 'Skipper1';
        try {
                # trying to establish best way to encode TAL comments to handle the em dash/&mdash

            $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $STH = $DBH->query("SELECT title FROM podcasts WHERE number > 481");
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $STH->fetch()){
                $title = $row['title'];

                echo $title."<br />\n";
                echo 'HTMLDecoded: '.html_entity_decode(($title))."<br /><br />\n";
            }

        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function title2(){
        $host   = 'localhost';
        $dbname = 'machoui_stuff';
        $user   = 'machoui_php';
        $pass   = 'Skipper1';
        try {
            # trying to establish best way to encode TAL comments to handle the em dash/&mdash

            $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $STH = $DBH->query("SELECT title FROM podcasts WHERE number > 481");
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $rows = $STH->fetchAll();
            foreach($rows as $row){
                $title = $row['title'];

                echo $title."<br />\n";
                echo 'HTMLDecoded: '.html_entity_decode(($title))."<br /><br />\n";
            }

        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function blank_host(){
        $host   = 'localhost';
        $dbname = 'machoui_stuff';
        $user   = 'machoui_php';
        $pass   = 'Skipper1';
        try {
                # MS SQL Server and Sybase with PDO_DBLIB

            $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $STH = $DBH->query("SELECT * FROM podcasts");
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $STH->fetch()){
                echo $row['url'].  "<br />\n";
            }


        }
        catch(PDOException $e) {
          echo $e->getMessage();
      }
  }

  public function fb(){
    $status      = 'YOUR_STATUS';
    $first_name  = 'YOUR_FIRST_NAME';
    $login_email = 'mark@chouinard.me';
    $login_pass  = 'Skipper1';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://login.facebook.com/login.php?m&amp;next=http%3A%2F%2Fm.facebook.com%2Fhome.php');
    curl_setopt($ch, CURLOPT_POSTFIELDS,'email='.urlencode($login_email).'&pass='.urlencode($login_pass).'&login=Login');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "my_cookies.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "my_cookies.txt");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
    curl_exec($ch);

    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_URL, 'http://m.facebook.com/home.php');
    $page = curl_exec($ch);

    curl_setopt($ch, CURLOPT_POST, 1);
    preg_match('/name="post_form_id" value="(.*)" \/>'.ucfirst($first_name).'/', $page, $form_id);
    curl_setopt($ch, CURLOPT_POSTFIELDS,'post_form_id='.$form_id[1].'&status='.urlencode($status).'&update=Update');
    curl_setopt($ch, CURLOPT_URL, 'http://m.facebook.com/home.php');
    curl_exec($ch);
}

public function tal(){
    $data = array(
        'title'      => 'title',
        'content'    => 'utility/tal_view',
        'msg'        => 'message',
        'page_title' => 'page_title',
        );
    $this->load->view('page', $data);
}

public function cartalk(){
    $data = array(
        'title'      => 'title',
        'content'    => 'utility/cartalk_view',
        'msg'        => 'message',
        'page_title' => 'page_title',
        );
    $this->load->view('page', $data);
}

public function iphone(){
    $uploadDir    = '/home/machoui/public_html/stuff/images/iphone/';
    $file_name    = basename($_FILES['userfile']['name']);
    $path_parts   = pathinfo($file_name);
    $ext          = $path_parts['extension'];

    $randomNumber = rand(0, 999999);
    $newName      = $uploadDir . $randomNumber .'.'. $ext;
    $temp         = $_FILES['userfile']['tmp_name'];
            //mail("mark@chouinard.me", "From test controller", "New name: {$newName}");
    move_uploaded_file($temp, $newName);
}


public function sledding(){
    $data = array(
        'title'      =>  'Sledding',
        'content'    => 'sledding_view',
        'page_title' => 'Fun in the Snow!!!!!',
        'Henry & Dad made this!!!!!'
        );
    $this->load->view('page_guest', $data);
}


public function read_exif(){
    $upload_path = 'images/exif_view/';
    $dir_struct = array(
        'dir' => $upload_path,
        );
    build_dir_structure($dir_struct);

    $config['upload_path']   = $upload_path;
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']      = '5000';
    $config['max_width']     = '4000';
    $config['max_height']    = '4000';
    $config['overwrite']     = TRUE;
    $this->load->library('upload', $config);

    if ( !$this->upload->do_upload()){
     $error = array(
        'error' => $this->upload->display_errors(),
        );

     $data = array(
        'title'      => 'Error',
        'content'    => 'result',
        'page_title' => '!$upload->success;',
        'msg'        => 'There was trouble with the upload',
        'data'       => array(
            'display' => 1,
            'error'   => $error,
            ),
        );
     $this->load->view('page_guest', $data);
 }
 else
 {
    $upload_data     =  $this->upload->data();
    $path_parts      = pathinfo($upload_data['full_path']);
    $this->extension = strtolower($path_parts['extension']);
    $new_name        = getTimestamp();
    $file_name       = $new_name.'.'. $this->extension;



    $image     = $upload_path.$file_name;
    $old_image = $upload_data['full_path'];
    rename($old_image, $image);

    $my_exif   = get_exif_j($image);
    $data      = array(
        'title'        => 'title',
        'content'      => 'result',
        'msg'          => 'message',
        'page_title'   => 'page_title',
        'page_heading' => 'heading',
        'data'         => array(
            'display'    => 0,
            'info'       => $my_exif,
            'info_title' => 'EXIF',
            'more'       => 'test_view',
            ),
        );
    $this->load->view('page', $data);

}
}

public function bookmarklet(){
    $upload_path = 'images/exif_utility/';
    $dir_struct  = array(
        'dir' => $upload_path,
        );
    build_dir_structure($dir_struct);

    $this->load->library('simple_html_dom');
    $string   = '';
    $num      = $this->uri->total_segments();
    $segments = $this->uri->segment_array();
    print_array($segments,'Segments');
    for($i=4; $i <= $num; $i++){
        $string .= $segments[$i].'/';
    }
    $url = $this->uri->segment(3).'//'.substr($string,0,-1);
    echo 'URL: '.$url.  "<br /><br />\r\n";
    $html = file_get_html($url);
    $max_size = 0;
    if($x = $html->find('img')){
        foreach($x as $e){
            $image = $e->src;
            echo 'IMAGE(src): '.$image.  "<br />\r\n";
            if(strpos($image, 'http:') === FALSE){
                $found_image = $url.'/'.$image;
                echo $found_image.  "<br />\r\n";
                    //SAVE FOUND_IMAGE
                $path_parts     = pathinfo($found_image);
                $ext            = $path_parts['extension'];
                $dir_name       = $path_parts['dirname'];
                $orig_base_name = $path_parts['filename'];
                $found_image    = $dir_name.'/'.rawurlencode($orig_base_name).'.'.$ext;
                echo 'encoded filename? '.$image.  "<br />\r\n";
                $new_base_name = getTimestamp();
                $new_image     = $upload_path.$new_base_name.'.'.$ext;
                echo 'new_image: '.$new_image.  "<br />\r\n";
                copy($found_image,$new_image);

                @$size = getimagesize($new_image);
                $image_size = $size[0] * $size[1];
                echo $image_size.  "<br />\r\n";
                if($image_size > $max_size){
                    $max_size = $image_size;
                    $biggest_image = $found_image;
                }
            }else{
                    //$found_image = $image;
                echo $image.  "<br />\r\n";
                    //SAVE FOUND_IMAGE
                $path_parts     = pathinfo($image);
                $ext            = $path_parts['extension'];
                $dir_name       = $path_parts['dirname'];
                $orig_base_name = $path_parts['filename'];
                $image          = $dir_name.'/'.rawurlencode($orig_base_name).'.'.$ext;
                echo 'encoded filename? '.$image.  "<br />\r\n";
                $new_base_name = getTimestamp();
                $new_image     = $upload_path.$new_base_name.'.'.$ext;
                echo 'line 138: '.$new_image.  "<br />\r\n";
                copy($image,$new_image);

                @$size = getimagesize($image);
                $image_size = $size[0] * $size[1];
                echo $image_size.  "<br />\r\n";
                if($image_size > $max_size){
                    $max_size      = $image_size;
                    $biggest_image = $image;
                }
            }
        }
    }else{
        $path_parts    = pathinfo($url);
        $ext           = $path_parts['extension'];
        $new_base_name = getTimestamp();
        $new_image     = $upload_path.$new_base_name.'.'.$ext;
        echo 'new_image: '.$new_image.  "<br />\r\n";
        copy($url,$new_image);
        $biggest_image = $url;
    }
    echo 'Biggest Image: '.$biggest_image.  "<br />\r\n";

}
public function bookmarkletII(){
    $this->load->library('simple_html_dom');
    $string   = '';
    $num      = $this->uri->total_segments();
    $segments = $this->uri->segment_array();
    print_array($segments);
    $domain   = $this->uri->segment(3).'//'.$this->uri->segment(4);
    echo 'Domain: '.$domain.  "<br />\r\n";
    $html     = file_get_html($domain);
    $max_size = 0;
    foreach($html->find('img') as $e){
        $image = $e->src;
        echo 'IMAGE(src): '.$image.  "<br />\r\n";
        if(strpos($image, 'http:') === FALSE){
                    $found_image = $domain.'/'.$image;
                    //echo $found_image.  "<br />\r\n";
                    @$size = getimagesize($found_image);
                    $image_size = $size[0] * $size[1];
            echo $image_size.  "<br />\r\n";
            if($image_size > $max_size){
                $max_size  = $image_size;
                $big_image = $found_image;
            }
        }else{
            $found_image = $image;
                    //echo $image.  "<br />\r\n";
            @$size = getimagesize($image);
            $image_size  = $size[0] * $size[1];
            echo $image_size.  "<br />\r\n";
            if($image_size > $max_size){
                $max_size  = $image_size;
                $big_image = $found_image;
            }
        }
    }
    echo 'Largest Image?: '.$big_image.  "<br />\r\n";
    $path_parts = pathinfo($big_image);
    $file_name  = $path_parts['basename'];
    echo 'File Name: '.$file_name.  "<br />\r\n";

}




public function exif_album(){
    $this->load->model('image_model');
    $this->load->library('table');
    $album = $this->image_model->get_album();
    $data = array(
      'title'      => 'Test',
      'content'    => 'result',
      'msg'        => 'Test Page',
      'page_title' => '$something->test();',
      'data'       => array(
        'display'    => 0,
        'errors'     => '',
        'info'       => $album,
        'info_title' => 'EXIF Album',
        )
      );
    $this->load->view('page_guest', $data);


}

public function kml(){
    $dir    = 'http://stuff.chouinard.me/images/2012/03/';
    $result = `exiftool -fileOrder gpsdatetime -p images/fmt/kml.fmt -d %Y-%m-%dT%H:%M:%SZ $dir > images/exif/kml/out.kml`;
    print_array($result);
}

public function tag(){
    $this->load->helper('file');
    $track      = 'images/exif/tracks/030412.gpx';
    $dir        = 'images/exif/tag/';
    $file_names = get_filenames($dir);
    foreach($file_names as $image){
     `exiftool -Copyright="© MAChouinard" $dir.$image`;
 }
 $result = `exiftool -geotag $track '-geotime<\${datetimeoriginal}-08:00' -v2  $dir`;
 $data = array(
    'title'        => 'Exif Test',
    'content'      => 'result',
    'msg'          => 'I think this will work',
    'page_title'   => 'EXIF',
    'page_heading' => 'Mark Alexander Chouinard',
    'data'         => array(
        'display'      => 0,
        'result'       => $result,
        'result_title' => 'ExifTool Results',
        ),
    );
 $this->load->view('page', $data);
}




}
?>