<?php

class Test_model extends CI_Model{


    public function make_album(){
        $this->db->select("*");
        $this->db->from('images');
        $this->db->where('ext', 'jpg');
        $this->db->or_where('ext', 'png');
        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

public function get_images(){
    $dir = 'images/folio/2011';
    $files = get_dir_file_info($dir);
    return $files;
}


    public function db($files){
       foreach($files as $file){

          $file = (object)$file;
          $myFile = $file->relative_path.'/'.$file->name;
           $x = $file->server_path;
           //print_array($file);
          if(is_file($x)){
              list($width, $height, $type, $dim) = getimagesize($myFile);
              //echo img($file->server_path).  "<br />\r\n";

              $path_parts = pathinfo($myFile);
              $file_name = $file->name;
              $name = $path_parts['filename'];
              $size = $file->size;
              $ext = $path_parts['extension'];
              $img_url = 'http://megan.chouinard.me/'.$file->relative_path.'/'.$file_name;
              $img_loc = $file->relative_path."/".$file_name;
              $thumb_loc = $file->relative_path."/thumbs/".$name."_thumb".".".$ext;

              $data = array(
                  'file_name' => $file_name,
                  'name' => $name,
                  'size' => $size,
                  'ext' => $ext,
                  'width' => $width,
                  'height' => $height,
                  'dim' => $dim,
                  'img_url' => $img_url,
                  'img_loc' => $img_loc,
                  'thumb_loc' => $thumb_loc,
              );
              $this->db->insert('images', $data);
          }

       }
    }


    public function shit($files){
        foreach($files as $file){
            $file = (object)$file;

            list($width, $height, $type, $dim) = getimagesize($file->relative_path.'/'.$file->name);

            $path_parts = pathinfo($file->server_path);
            $file_name = $file->name;
            $name = $path_parts['filename'];
            $size = $file->size;
            $ext = $path_parts['extension'];
            $img_url = 'http://megan.chouinard.me/'.$file->relative_path.'/'.$file_name;
            $img_loc = $file->relative_path.'/'.$file_name;
            $thumb_loc = $file->relative_path."/thumbs/".$name."_thumb".".".$ext;



           echo 'img_loc should be: '.$img_loc.  "<br />\r\n";

            echo 'file_name '.$file_name.  "<br />\r\n";
            echo 'name '.$name.  "<br />\r\n";
            echo 'size '.$size.  "<br />\r\n";
            echo 'ext '.$ext.  "<br />\r\n";
            echo 'width '.$width.  "<br />\r\n";
            echo 'height '.$height.  "<br />\r\n";
            echo 'dim '.$dim.  "<br />\r\n";
            echo 'img_url '. $img_url.  "<br />\r\n";
            echo 'img_loc '.$img_loc.  "<br />\r\n";
            echo 'thumb_loc '. $thumb_loc.  "<br />\r\n";
            echo img($thumb_loc).  "<br />\r\n";
            echo '<br />';

        }
    }


}
?>
