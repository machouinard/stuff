<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller{


    function __construct() {
            parent::__construct();
        }

    function index(){
        $data = array(
            'title' => 'email',
            'page_title' => 'contact me',
            'content' => 'utility/email',
            'msg' => 'If you\'re reading this, I\'d be interested in knowing why',
            'logo' => '/images/graphics/email5.png',
        );
        $this->load->view('page_guest', $data);
        }


        function mailto_mark(){
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('msg', 'Message', 'required|min_length[15]');

            if($this->form_validation->run() == FALSE){
                $data = array(
                    'title' => 'Error',
                    'content' => 'utility/email',
                    'page_title' => '<-Fix those errors!',
                    'error' => 1,
                    'msg' => validation_errors(),
                );
                $this->load->view('page_guest', $data);

                        }else{
                $this->mailto_mark_after_validate();
            }
        }






        function mailto_mark_after_validate(){

       $msg = $this->input->post('msg');
       $msg .= "\r\n\r\n <<From stuff.chouinard.me/email>>";
       $name = $this->input->post('name');
       $email = $this->input->post('email');
       $subject = $this->input->post('subject');
       $ip = $this->input->ip_address();

       $data = array(
           'ip' => $ip,
           'from_name' => $name,
           'from_email' => $email,
           'to' => 'mark@chouinard.me',
           'subject' => $subject,
           'message' => $msg,
       );
       $this->db->insert('email', $data);
       $id = $this->db->insert_id();


       $this->load->library('email');
       $this->email->to('mark@chouinard.me');
       $this->email->reply_to($email, $name);
       $this->email->from($email, $name);
       $this->email->subject($subject);
       $this->email->message($msg);

       if(!$this->email->send()){
           $sent = array(
             'success' => 0,
           );
           $this->db->where('id', $id);
           $this->db->update('email', $sent);

           $error = $this->email->print_debugger();
           $data = array(
               'title' => 'Email Result',
               'page_title' => 'Oh, Shit!',
               'msg' => 'There was a problem...',
               'content' => 'result',
               'data' => array(
                 'display' => 1,
                   'error' => $error,
               ),
            );
           $this->load->view('page_guest', $data);
              }else{
                  $sent = array(
                                'success' => 1,
                            );
                            $this->db->where('id', $id);
                            $this->db->update('email', $sent);

                  $data = array(
                      'title' => 'Email Result',
                      'content' => 'result',
                      'page_title' => '$mail->sent==TRUE',
                      'msg' => 'You message was sent.<br />Mark will get back to you as soon as he reads it.',
                  );
                  $this->load->view('page_guest', $data);
                            }
   }

}
?>