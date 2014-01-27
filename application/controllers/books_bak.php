<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller{

    function __construct() {
        parent::__construct();
    }





    function index(){
        $data = array(
            'title' => 'Self Study Books',
            'content' => 'library/books_view',
            'page_title' => 'Assorted PDF Files',
            'msg' => 'Trying to organize all my PDF\'s for once.<br />
                <span class="mini_text">MySQL version can be found <a href="books/index2">here</a></span>',
            'no_index' => 1,
        );
        $this->load->view('page', $data);
    }

    function index2(){
        $data = array(
        'title' => 'Self Study Books',
        'content' => 'library/list_books',
        'msg' => 'Trying to organize my PDF\'s<br /><span class="mini_text">and use my mad PHP and MySQL skillz at the same time</span>',
        'page_title' => 'Assorted PDF Files',
        );
        $this->load->view('page', $data);
    }


      public function view_books(){

        $subject = $this->input->post('subject');
		setcookie("subject", $subject, time()+600);
                $_COOKIE['subject'] = $subject;
        $books = $this->book_model->find_books_by_subject($subject);
        $data = array(
            'title' => 'New PDF Library',
            'content' => 'utility/list_books',
            'msg' => "$subject Books",
            'page_title' => 'PDF Library',
            'data' => array(
                'display' => 0,
                'edit' => 1,
                'books' => $books,
            ),
        );
        $this->load->view('page', $data);
    }
      public function edit_book(){
        $id = $this->uri->segment(3);
        $book = $this->book_model->find_book_by_id($id);
        //print_array($book);
        $data = array(
            'title' => 'Edit Book',
            'content' => 'library/edit_book_view',
            'msg' => $book['display_name'].'',
            'page_title' => 'Book Details',
            'data' => array(
                'display' => 0,
                'book' => $book,
            ),
        );
        $this->load->view('page', $data);

    }

    public function save_book_edits(){
        //print_array($_POST, 'POST', 1);
        $id = $this->input->post('id');
        $display_name = $this->input->post('display_name');
        $year = $this->input->post('year');
        if($year == ''){
            $year = null;
        }
        $link = $this->input->post('link');
        $forum = $this->input->post('forum');
        $rating = $this->input->post('rating');
        if($rating == 'none'){
            $rating = 6;
        }
        $comments = mysql_real_escape_string($this->input->post('comments'));
        //echo 'Rating ID: '.$rating_id;die();

        $query = "UPDATE pdfTitles SET display_name='$display_name', rating='$rating', year_published='$year', comments='$comments', forum='$forum',
        link='$link' WHERE id = '$id'";
        if(!mysql_query($query)){
            $data = array(
                'title' => 'Error',
                'content' => 'result',
                'msg' => mysql_error(),
                'page_title' => 'Update Failed',
            );
            $this->load->view('page_admin', $data);
        }else{
            $book = $this->book_model->find_book_by_id($id);
            $data = array(
                'title' => 'Success',
                'content' => 'library/display_book_view',
                'msg' => 'Updated '.$display_name,
                'page_title' => 'Update Succeeded',
                'data' => array(
                  'book' => $book,
                ),
            );
            $this->load->view('page_admin', $data);
        }
    }


    public function display_book(){
        $id = $this->uri->segment(3);
        $book = $this->book_model->find_book_by_id($id);
        $name = $book['display_name'];
        $data = array(
            'title' => $name,
            'content' => 'library/display_book_view',
            'msg' => 'Info about '.$name,
            'page_title' => 'Book Info',
            'data' => array(
                'display' => 0,
                'book' => $book,
            ),
        );
        $this->load->view('page', $data);
    }


    public function change_image(){
        //print_array($_FILES);
        if($_FILES['image']['error'] > 0){
            echo "ERROR line 134 books.php: ".$_FILES['image']['error'].  "<br />\n";
        }else{
            $file_name = $_FILES['image']['name'];

            $temp_name = $_FILES['image']['tmp_name'];
            $id = $_POST['id'];
            //$size = $_FILES['image']['size'];

            $dir = 'images/pdf/';

            if(move_uploaded_file($temp_name, $dir.$file_name)){
                //exec(chmod($dir.$file_name, "0755"));
                $new_image = $dir.$file_name;
                $query = "UPDATE pdfTitles SET image='$new_image' WHERE id = '$id'";
                $result = mysql_query($query);
                if(!$result){
                    echo "Error: ".mysql_error();
                    die();
                }
                $data = array(
                    'title' => 'File Uploaded',
                    'content' => 'library/display_book_view',
                    'msg' => $file_name.' was uploaded',
                    'page_title' => 'Upload Success',
                    'data' => array(
                      'id' => $id,
                    ),
                );
                $this->load->view('page', $data);
            }else{



                $data = array(
                    'title' => 'Error',
                    'content' => 'result',
                    'msg' => $file_name.' was not uploaded',
                    'page_title' => 'ERROR',
                );
                $this->load->view('page', $data);
            }
        }
    }


    public function make_edits(){
        print_array($_POST);
    }

	function test(){
            $subject = "HTML";
		echo "Count: ".$this->book_model->count_books_by_subject($subject);
	}

	public function list_by_subject(){

		$subject = $_POST['subject'];
		setcookie("subject", $subject, time()+3600);
		$_COOKIE['subject'] = $subject;
		$books = $this->book_model->find_books_by_subject($subject);
                //$count = $this->book_model->count_books_by_subject($subject);
		$data = array(
			'title' => $subject.' Books',
			'content' => 'library/list_books',
			'msg' => $subject . ' Books',
			'page_title' => 'Book Listing',
			'edit' => 1,
			'data' => array(
		'books' => $books,
	),
		);
		$this->load->view('page', $data);
	}


    public function manage(){

        $data = array(
            'title' => 'Manage Books',
            'content' => 'utility/manage_books',
            'msg' => 'You know what the mnessage is',
            'page_title' => 'Book Management',
            'data' => array(
            ),
        );
        $this->load->view('page_admin', $data);
    }


function download2(){
    $this->load->helper('download');
    $id = $_POST['id'];
    $book = $this->book_model->find_book_by_id($id);
    $name = $book['name'];
    $location = $book['location'];
    preg_match('~(pdf/[\S\s]+/)([\s\S]+)~', $location, $matches);
    $book_name = $matches[2];
    force_download($book_name, $location);

}


    public function download(){

        if(isset($book)){
            unset($book);
        }
        if(isset($books)){
            unset($books);
        }
        $ip = $this->input->ip_address();
        $this->load->helper('download');
        $book = $this->input->post('book');
        preg_match('~(pdf/[\S\s]+/)([\s\S]+)~', $book, $matches); // First time I've used a regular expression.  Wish it could have been cooler.
        $book_name = $matches[2];

        $data = array(
            'ip' => $ip,
            'file_name' => $book_name,
        );
        $this->db->insert('pdf_dl', $data);
//        echo $book_name.  "<br />\r\n";
//        echo $book.  "<br />\r\n";

        force_download($book_name, $book);
    }

    public function add_folder(){
        $folder = 'pdf/'.$this->input->post('folder');

        if(!mkdir($folder, 0755)){
            $data = array(
                'title' => 'Error',
                'content' => 'result',
                'page_title' => 'MKDIR Error',
                'msg' => 'Could not create '.$folder,
            );
            $this->load->view('page', $data);
        }else{
            redirect('/books/add');
        }
    }



}
?>