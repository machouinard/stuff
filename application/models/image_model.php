<?php

class Image_model extends CI_Model{

    public function insert_db($data){

        $this->db->insert('exif_temp', $data);
        return $this->db->insert_id();

    }

    public function find_ios_image_by_id($id){
        $this->db->select('*');
        $this->db->from('ios_images');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }


    public function get_album(){
        $this->db->select('image_url, thumb_url');
        $this->db->from('exif_temp');
        $query = $this->db->get();
        $result = $query->result();
        $images = array();
        foreach($result as $image){
            $line = "<a href='$image->image_url'><img src='$image->thumb_url' /></a>";
            array_push($images, $line);
        }
        $new_list = $this->table->make_columns($images, 2);
        return $this->table->generate($new_list);
    }

    function fix_rotation($image){
// 		echo 'file location from fix_rotation function line 180: '.$image;
		$this->image_moo->load($image);
		if($this->image_moo->errors){
			print $this->image_moo->display_errors();
		}
                $path_parts = pathinfo($image);
                $ext = $path_parts['extension'];
		if(strpos($ext, 'jpg') !== FALSE){
                $exif = @exif_read_data($image);
                //print_array($exif, 'line 294 map.php');

                }else{
                    $exif = NULL;
                }
// 		print_array($exif, 'EXIF read from $image - same image location being fed to image_moo');//(Custom print_r function) - reads EXIF as expected
                if(isset($exif['Orientation'])){
		$orient = $exif['Orientation'];
		switch($orient)
		{
			case 1: // none
				break;
			case 3: // 180 rotate
				$this->image_moo->rotate(180);
				break;
			case 6: // 90 rotate right
				$this->image_moo->rotate(270);
				break;
			case 8:    // 90 rotate left
				$this->image_moo->rotate(90);
				break;
		}
        }
                read_exif($image, 'images/exif/stored/image.mie');
                $this->image_moo->save($image, TRUE);
		$this->image_moo->clear();
                write_exif($image, 'images/exif/stored/image.mie');
                if(is_file('images/exif/stored/image.mit')){
                    unlink('images/exif/stored/image.mie');
                }
                //print_array($exif, 'line 329 map.php', 1);

//                $m = exif_read_data($image, 0, TRUE);
//                print_array($m, 'line 343 map.php',1);
	}


        public function ios_album(){
                $this->db->select('*');
                $this->db->from('ios_images');
                $this->db->order_by('id', 'asc');
                $query = $this->db->get();
                $result = $query->result();


                $images = array();
                foreach($result as $image){
                    $title = '';
                    if($image->comments !== ''){
                        $title .= $image->comments.  "<br />\n";
                    }
                    if($this->ion_auth->is_admin()){
                        $title .= "<a href='/iphoneupload/delete_image/$image->id'>Delete</a>";
                    }
                    $line = "<a href='$image->image_url' rel='lightbox-ios' title=\"$title\"><img src='$image->thumb_url' /></a>";
                    array_push($images, $line);
                }
                $new_list = $this->table->make_columns($images, 3);
                return $this->table->generate($new_list);
        }


        public function delete_ios_image($id){
            $image = $this->find_ios_image_by_id($id);
            //print_array($image, 'line 106 image_model');
            $this->db->where('id', $id);
            if($this->db->delete('ios_images')){
                $return = 'success';
            }else{
                $return = $this->db->_error_message();
            }

//            echo 'image_loc: '.$image->image_loc.  "<br />\n";
//            echo 'thumb_loc: '.$image->thumb_loc.  "<br />\n";


            if(!unlink($image->image_loc)){
                $return = 'fail';
            }
            if(!unlink($image->thumb_loc)){
                $return = 'fail';
            }

            return $return;
        }


}



?>
