<?php

defined('BASEPATH') OR exit('No direct script access allowed');





class Maint extends CI_Controller {



	function __construct()

	{

		parent::__construct();

	}



	function index(){

			redirect('/welcome');

	}



	function offline(){

		$data = array(

			'title' => 'Offline',

				'content' => 'result',

				'page_title' => '$this->offline();',

				'msg' => 'Try again later',

				'error' => 1,

				'page_heading' => 'The page you are looking for is temporarily offline',

		);

		$this->load->view('page_guest',  $data);

	}





        function populate_db(){



            $this->load->helper('directory');

            $dir = 'pdf/';

            $files = directory_map($dir);



            ksort($files);

            foreach ($files as $subject=>$books){

                if ($subject !== "other_mobile_formats"){



                    echo "<h2>$subject</h2>";

                    $data = array(

                       'subject_name' => $subject,

                    );

                    $this->db->insert('pdfSubjects', $data);

                    $subject_id = $this->db->insert_id();



                    foreach ($books as $book){



                        $location = $dir.$subject.'/'.$book;

                        $size = filesize($location);

                        echo 'Size: '.$size.  "<br />\r\n";

                        echo 'Location: '.$location.  "<br />\r\n";

                        $pattern = "~([\s\S]+)(.pdf)~";

                        preg_match($pattern, $book, $matches);

                        $book_name = $matches[1];

                        $name = preg_replace('~[\._]~', ' ', $book_name);

                        echo 'Title: '.$name.  "<br />\r\n";

                        echo 'Filename: '.$book.  "<br />\r\n";

                        $data = array(

                          'name' => $name,

                            'location' => $location,

                            'size' => $size,

                        );

                        $this->db->insert('pdfTitles', $data);

                        $title_id = $this->db->insert_id();



                        $data = array(

                            'title_id' => $title_id,

                            'subject_id' => $subject_id,

                        );

                        $this->db->insert('pdfSubjectTitle', $data);



                    }



                    echo "<hr>";





                }





            }

        }





}

?>