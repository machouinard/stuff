<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * images
 *
 * @author
 *
 * @version
 *
 */

class Images extends CI_Controller {

	function __construct() {
		parent::__construct ();
	}

	public function index() {
		$data = array(
					'title' => 'Image Display',
						'content' => 'display/gallery',
						'page_title' => '$images->display()',
						'page_heading' => 'Test Page for displaying images',
						'msg' => 'trying to figure out best way to display images',
				);
				$this->load->view('page', $data);
	}

}
