<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {
        var $ext;
        var $file_name;
        var $file_loc;
        var $gpx_file;


	public function __construct()
	{
		parent::__construct();
	}


        public function index(){
            $data = array(
            'title' => 'Geotag Images',
            'content' => 'upload_view',
            'msg' => 'Upload Images and GPS Tracks',
            'page_title' => 'GeoTag Images',
            'page_heading' => 'Awesomeness',
        );
        $this->load->view('page_admin', $data);
        }

        public function geotag(){

             $upload_dir = 'images/upload/';
             $track_dir = 'images/tracks/';
             $archive_dir = build_upload_dir('images/archives/');
       $dir_structure = array(
         'upload_dir' => $upload_dir,
           'track_dir' => $track_dir,
           'archive_dir' => $archive_dir,
       );
       build_dir_structure($dir_structure);
       $config['upload_path'] = $upload_dir;
		$config['allowed_types'] = 'zip|gpx';
		$config['max_size']	= '20480';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);
                if(!$this->upload->do_upload('zip')){
                    $data = array(
                        'title' => 'Error',
                        'content' => 'test_view',
                        'msg' => 'There were errors',
                        'page_title' => 'Errors',
                        'page_heading' => 'What went wrong?',
                        'data' => array(
                            'display' => 0,
                            'errors' => $this->upload->display_errors(),
                        ),
                    );

                    $this->load->view('page', $data);
                }else{

                    $errors = 0;
                    $this->load->library('unzip');
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                    $zip_file = $upload_dir.$file_name;
                    $this->unzip->allow(
                            array('jpg', 'JPG', 'gpx')
                            );
                    $this->unzip->extract($zip_file);
                    $files = get_filenames($upload_dir, TRUE);
                    /**
                     *Now we rename the files and move them to their permanent home
                     */
                    $image_dir = build_upload_dir('images/');

                    $track = $upload_dir.'track.gpx';
                    $result = `exiftool -geotag $track '-geotime<\${datetimeoriginal}-08:00' -delete_original! -v2  $upload_dir`;
                    ``;

                    foreach($files as $file){
                        $path_parts = pathinfo($file);
                        $this->ext = strtolower($path_parts['extension']);
                        $base_name = getTimestamp();
                        if($this->ext == 'gpx'){
                            $file_name = $path_parts['basename'];
                            $track = $track_dir.$file_name;
                            if(!(rename($file, $track))){
                                $errors++;
                            }

                        }elseif($this->ext == 'zip'){
                            $file_name = $path_parts['basename'];
                            if(!(rename($file, $archive_dir.$file_name))){
                                $errors++;
                            }
                        }elseif($this->ext == 'jpg'){
                            $file_name = $base_name.'.'.$this->ext;
                            $file_loc = $image_dir.$file_name;
                            if(!(rename($file, $file_loc))){
                                $errors++;
                            }
                            `exiftool -Copyright="© MAChouinard" $file_loc`;
                            `exiftool -delete_original! $file_loc`;
                        }
                    }
                    `exiftool -fileOrder gpsdatetime -p images/fmt/kml.fmt -d %Y-%m-%dT%H:%M:%SZ $image_dir > images/exif/kml/out.kml`;
                    $data = array(
                        'title' => 'Upload Data',
                        'content' => 'result',
                        'msg' => 'message',
                        'page_title' => 'page_title',
                        'page_heading' => 'heading',
                        'data' => array(
                            'display' => 0,
                            'error' => $errors,
                            'error_title' => "Number of Errors",
                            'result' => $result,
                            'result_title' => 'ExifTool Result',
                        ),
                    );
                    $this->load->view('page', $data);

        }

        }

        }
