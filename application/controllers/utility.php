<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends CI_Controller{

	var $subject_id = '';
	var $title_id = '';

    function __construct() {
            parent::__construct();
        }

    function index(){
        $data = array(
            'title' => 'Utilities',
            'content' => 'utility/index',
            'msg' => 'Some handy things to have',
            'page_title' => 'Site Utilities',
        );
        $this->load->view('page_admin', $data);
    }

    public function error(){
        $x = $this->uri->segment(3);
        if($x){
            $error = urldecode($x);
            $data = array(
                'title' => 'Error',
                'content' => 'result',
                'msg' => 'There has been a problem',
                'page_title' => 'Error',
                'data' => array(
                    'display' => 0,
                  'errors' => $error,
                ),
            );
            $this->load->view('page_guest', $data);
        }

    }


    public function misc(){
        $data = array(
          'title' => 'Various Things I\'ve Picked Up',
            'content' => 'support/misc',
            'page_title' => 'Notes From a Novice...',
            'msg' => 'Some things I needed help with while learning Ubuntu Server 11.10<br />
                <span class="mini_text">and some other stuff I\'ve picked up along the way</span>',
        );
        $this->load->view('page_guest', $data);
    }

    public function regex(){
        $data = array(
            'title' => 'Regex Tester',
            'content' => 'utility/regex_view',
            'msg' => '<a href="http://regexpal.com" target="_blank"><img src="../images/regex/regexpal.gif" alt="RegexPal"/>
                <h1><span class="t1">Regex</span><span class="t2">Pal</span>
        <span id="version">0.1.4</span>
     </h1></a>',
            'page_title' => 'Regular Expressions',
            'css' => 'regexpal.css',
//            'scriptB' => 'regex/helpers.js',
//            'scriptB2' => 'regex/regexpal.js',
//            'scriptB3' => 'regex/xregexp.js',
        );
        $this->load->view('page_guest', $data);
    }


    function user_edit(){
        $user = $this->ion_auth->get_user();
        $id = $user->id;
        if($id == 6){
            redirect('/welcome/not_admin');
        }
        $data = array(
            'title' => 'Edit My Info',
            'content' => 'utility/user_edit_view',
            'msg' => 'message goes here',
            'page_title' => 'Edit Info',
        );
        $this->load->view('page', $data);
    }

    function user_edit_process(){
        //print_array($_POST);
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email');
        if($this->input->post('email2') == ""){
            $email2 = NULL;
        }else{
            $email2 = $this->input->post('email2');
        }
        $user_id = $this->input->post('user_id');

        $data = array(
            'email' => $email,
            'email2' => $email2,
        );
        $this->db->where('id', $user_id);
        if(!$this->db->update('users', $data)){
            $data = array(
                'title' => 'Error',
                'content' => 'result',
                'msg' => 'Errors updating users table',
                'page_title' => 'DB Errors',
            );
            $this->load->view('page', $data);
        }else{
            $data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
            );
            $this->db->where('user_id', $user_id);
            if (!$this->db->update('meta', $data)){
                $data = array(
                    'title' => 'Error',
                    'content' => 'result',
                    'msg' => 'Errors updating meta table',
                    'page_title' => 'DB Errors',
                );
                $this->load->view('page', $data);
            }else{
                $data = array(
                    'title' => 'Info Changed',
                    'content' => 'result',
                    'msg' => 'Your info was saved',
                    'page_title' => 'Saved',
                );
                $this->load->view('page', $data);
            }

        }



    }



    public function logs(){
        $data = array(
            'title' => 'Logs',
            'content' => 'utility/log_view',
            'msg' => 'message',
            'page_title' => 'Error Log',
            'page_heading' => 'heading',
         );
        $this->load->view('page_admin', $data);
    }

    public function delete_file(){
        $file = $this->input->post('file');
        $handle = fopen($file, 'w');
        fwrite($handle, "Cleared at ".date("g:i:sa l F jS",now())."\r\n");
        fclose($handle);

        redirect('utility');
    }

    function info(){
        $constant = $this->input->post('constant');
        ob_start () ;
        phpinfo ($constant) ;
        $info = ob_get_contents () ;
        ob_end_clean () ;

        $data = array(
            'title' => 'PHPInfo',
            'content' => 'result',
            'msg' => 'PHP Info',
            'page_title' => 'PHP',
            'data' => array(
                'display' => 0,
                'info' => $info,
                'info_title' => "PHP Info- $constant",
                'more' => 'utility/index',
            ),
        );
        $this->load->view('page', $data);

    }

    public function read_exif(){
        ob_start();
            $upload_path = 'images/exif_utility/';
                $dir_struct = array(
                    'dir' => $upload_path,
                );
                build_dir_structure($dir_struct);

                $config['upload_path'] = $upload_path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5000';
		$config['max_width']  = '4000';
		$config['max_height']  = '4000';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);

		if ( !$this->upload->do_upload()){
			$error = array(
				'error' => $this->upload->display_errors(),
                        );

			$data = array(
				'title' => 'Error',
				'content' => 'result',
				'page_title' => '!$upload->success;',
				'msg' => 'There was trouble with the upload',
				'data' => array(
					'display' => 1,
					'error' => $error,
					),
			);
			$this->load->view('page', $data);
                        ob_end_flush();
		}
		else
		{
                        $upload_data =  $this->upload->data();
                        $path_parts = pathinfo($upload_data['full_path']);
                        $this->extension = strtolower($path_parts['extension']);
                        $new_name = getTimestamp();
                        $file_name = $new_name.'.'. $this->extension;



                        $image = $upload_path.$file_name;
                        $old_image = $upload_data['full_path'];
                        rename($old_image, $image);

                        $my_exif = get_exif_j($image);
                        $data = array(
                            'title' => 'title',
                            'content' => 'result',
                            'msg' => 'message',
                            'page_title' => 'page_title',
                            'page_heading' => 'heading',
                            'data' => array(
                                'display' => 0,
                                'info' => $my_exif,
                                'info_title' => $old_image,
                                'more' => 'utility/index',
                            ),
                        );
                        $this->load->view('page', $data);
			ob_end_flush();
		}
        }


        function truncate_lib(){
		$query = "SET FOREIGN_KEY_CHECKS=0";
		mysql_query($query);
            $query = "TRUNCATE TABLE `pdfTitles`";
            $result = mysql_query($query);
		$query = "SET FOREIGN_KEY_CHECKS=1";
		mysql_query($query);
            if(!$result){
                $data = array(
                    'title' => 'Error',
                    'content' => 'result',
                    'page_heading' => "Didn't work- ".  mysql_error(),
                );
                $this->load->view('page', $data);
            }else{
                $data = array(
                    'title' => 'Worked',
                    'content' => 'result',
                    'page_heading' => 'Tables were truncated',
                );
                $this->load->view('page', $data);
            }
        }

        function populate_db(){
            $dir = 'pdf';
            $this->getDirectory($dir);
        }

        function getDirectory( $path = '.', $level = 0 ){

    $ignore = array( '.', '..' );
    // Directories to ignore when listing output. Many hosts
    // will deny PHP access to the cgi-bin.

    $dh = opendir( $path );
    // Open the directory to the handle $dh

    while( false !== ( $file = readdir( $dh ) ) ){
    // Loop through the directory

        if( !in_array( $file, $ignore ) ){
        // Check that this file is not to be ignored

            if( is_dir( "$path/$file" ) ){
            // Its a directory, so we need to keep reading down...

                echo "<hr>Subject: ".$file.  "<br />\r\n<hr>";

                $pdfSubjectQuery = "INSERT INTO pdfSubjects(name) VALUES('$file')";
				mysql_query($pdfSubjectQuery);
				if($this->subject_id = mysql_insert_id()){
					echo 'Subject inserted<br />';
				}else{
					echo 'Subject not inserted: '.mysql_error()."<br />";
				}

                $this->getDirectory( "$path/$file", ($level+1) );
                // Re-call this same function but on a new directory.
                // this is what makes function recursive.

            } else {
                $path_parts = pathinfo($file);
                $ext = $path_parts['extension'];
                $file_name = $path_parts['filename'];
                $display_name = preg_replace('~[\.]~', " ", $file_name);
                $display_name = preg_replace('~,\s~', ' - ', $display_name);
				$display_name = preg_replace('~_~', " ", $display_name);
				$dirname = $path_parts['dirname'];
				$basename = $path_parts['basename'];


				$location = $path.'/'.$basename;
				$size = filesize($location);

                echo "File: ".$file.  "<br />\r\n";
                echo "Book Name: ".$file_name.  "<br />\r\n";
                echo "Display Name: ".$display_name.  "<br />\r\n";
                echo "Extension: ".$ext.  "<br />\r\n";
				echo "Size: ".$size,"<br />\r\n";
				echo "Location: ".$location."<br />\r\n";
                // MySQL insertion - pdfTitles, pdfSubjects, pdfSubjectTitle
            	$pdfTitleQuery = "INSERT INTO `pdfTitles`(`name`, `display_name`, `size`, `location`) VALUES('$file', '$display_name', '$size', '$location')";
				mysql_query($pdfTitleQuery);
				if($this->title_id = mysql_insert_id()){
					echo "Title inserted<br />\r\n";
				}else{
					echo "Title not inserted: ".mysql_error()."<br />";
				}
				$pdfSubjectTitleQuery = "INSERT INTO `pdfSubjectTitle`(`title_id`, `subject_id`) VALUES('$this->title_id', '$this->subject_id')";

				if(mysql_query($pdfSubjectTitleQuery)){
					echo 'SubjectTitle inserted'."<br />\r\n";
				}else{
					echo 'SubjectTitle not inserted: '.mysql_error()."<br />\r\n";
				}




            }

        }

    }

    closedir( $dh );
    // Close the directory handle

}

	function modify(){
		$query = "SET FOREIGN_KEY_CHECKS=0";
		mysql_query($query);

		$query = "ALTER TABLE `pdfTitles` ADD COLUMN `file_type` VARCHAR(5) NOT NULL AFTER `display_name`";
		if(mysql_query($query)){
			echo "Added Table<br />\r\n";
		}else{
			echo "Did not add table: ".mysql_error()."<br />\r\n";
		}
		$query = "SET FOREIGN_KEY_CHECKS=1";
		mysql_query($query);

	}



}
?>