<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gmap extends CI_Controller{


    function __construct() {
            parent::__construct();
        }

    function index(){
        $data = array(
            'title' => 'Google Maps Test Page',
            'content' => '/gmap/gmap_view',
            'page_title' => '$location->map_it()',
            'msg' => 'Using Google Maps API v3',
            'css1' => '/css/mac_gmap.css',
            'js1' => 'http://maps.googleapis.com/maps/api/js?key=AIzaSyBvz9_5jMMJlchz-G1HQ6RtD6M_F8_oxKY&sensor=false',
        );
        $this->load->view('page_guest', $data);
        }


    function show_map(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('city', 'City', 'min_length[4]');
        $this->form_validation->set_rules('state', 'State', 'min_length[2]');
        $this->form_validation->set_rules('street', 'Street', 'min_length[3]');

        if($this->form_validation->run() == FALSE){
            $data = array(
                'title' => 'Form Error',
                'content' => 'exif/exif_view',
                'page_title' => 'Errors',
                'msg' => validation_errors(),
                'error' => 1,
            );
            $this->load->view('page_guest', $data);
                }else{

                    $this->show_map_after_validate();
                                }
    }

    function show_map_after_validate(){


        $this->load->library('googlemaps');

        $street = $this->input->post('street');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $location = $street.' '.$city.' '.$state;



        $config = array(
          'center' => $location,
            'zoom' => 14,
            'map_type' => 'HYBRID',
            'map_types_available' => array("HYBRID", "SATELLITE", "TERRAIN"),
            'map_height' => '500px',
            'mapTypeControlPosition' => 'TOP_LEFT',
        		'geocodeCaching' => TRUE,
            'bicyclingOverlay' => TRUE,
        );


        $this->googlemaps->initialize($config);

        $marker = array();
        $marker['position'] = $location;
        $this->googlemaps->add_marker($marker);

        $gdata['map'] = $this->googlemaps->create_map();

        $data = array(
            'title' => 'result',
            'content' => 'exif/exif_map_view',
            'page_title' => $location,
            'msg' => 'Google says that address is right here on the map',
            'map' => $gdata['map'],
        );
        $this->load->view('page_gmap', $data);

    }

}
?>