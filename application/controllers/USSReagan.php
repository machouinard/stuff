<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: mark
 * Date: 2/7/13
 * Time: 7:22 PM
 * To change this template use File | Settings | File Templates.
 */
class USSReagan extends CI_Controller
{

    public function index()
    {
        $data = array(
            'title' => 'USS Reagan',
            'content' => 'temp/ussreagan_view',
            'page_title' => '<span class="mini_text">Three New Navy Ships</span>',
            'msg' => 'Thanks, Ed!',
            'logo' => 'images/graphics/navy.gif'
        );
        $this->load->view('page_guest', $data);
    }

}
