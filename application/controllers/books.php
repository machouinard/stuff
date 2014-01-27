<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller{

    function __construct() {
        parent::__construct();
    }


    function index(){
        $data = array(
        'title' => 'Self Study Books',
        'content' => 'library/list_books',
        'msg' => 'Trying to organize my PDF files',
        'page_title' => 'Assorted PDF Files',
        'logo' => '/images/graphics/PDF2.png',
        );
        $this->load->view('page', $data);
    }



    public function test(){
        redirect('/utility/error/Something went wrong');
    }


    public function add_book(){
        if($this->uri->segment(3)){
            $page_heading = urldecode($this->uri->segment(3));
        }else{
            $page_heading = NULL;
        }
        $data = array(
            'title' => 'Add A Book',
            'content' => 'library/add_book_view',
            'msg' => 'add a book',
            'page_title' => 'New Book',
            'page_heading' => $page_heading,
            'logo' => '/images/graphics/PDF2.png',
        );
        $this->load->view('page_admin', $data);
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

            $data = array(
              'dir' => $dir,
            );
            build_dir_structure($data);

            if(move_uploaded_file($temp_name, $dir.$file_name)){
                //exec(chmod($dir.$file_name, "0755"));
                $new_image = $dir.$file_name;

                $this->image_moo->load($new_image)->resize(350,350)->save($new_image, TRUE);

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

     public function display_book(){
        $id = $this->uri->segment(3);
        $book = $this->book_model->find_book_by_id($id);
        $name = $book['display_name'];
        $data = array(
            'title' => $name,
            'content' => 'library/display_book_view',
            'msg' => 'about this pdf...',
            'page_title' => 'Book Info',
            'data' => array(
                'display' => 0,
                'book' => $book,
            ),
        );
        $this->load->view('page', $data);
    }

    function download2(){
        if(isset($_POST['delete'])){
            $id = $_POST['id'];
            $this->book_model->delete_book($id);

            $query = "DELETE FROM pdfTitles WHERE id={$id}";
            mysql_query($query);
            $subject_name = $this->book_model->find_subject_name_by_book_id($id);
            $_POST['subject'] = $subject_name;
            redirect('/books/list_by_subject');

        }else{
        $this->load->helper('download');
        $id = $_POST['id'];
        $book = $this->book_model->find_book_by_id($id);
        $name = $book['name'];
        $location = $book['location'];
        preg_match('~(pdf/[\S\s]+/)([\s\S]+)~', $location, $matches);
        $book_name = $matches[2];
        force_download($book_name, $location);
        }

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






    public function list_by_subject(){
	if(isset($_POST['subject'])){
                $subject = $_POST['subject'];
        }else{
                $subject = urldecode($this->uri->segment(3));
        }
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




    public function save_book_edits(){
        //print_array($_POST, 'POST', 1);
        $id = $this->input->post('id');
        $display_name = $this->input->post('display_name');
        $display_name = mysql_real_escape_string($display_name);
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



    function save_new_book(){
//        print_array($_FILES, 'FILES');
//        print_array($_POST, 'POST', 1);


        if ($_FILES["file"]["error"] > 0){
            switch ($_FILES['file']['error']) {
                case 1:
                    $error = "Exceeds max size in php.ini";
                    break;
                case 2:
                    $error = 'Exceeds max size allowed by form';
                    break;
                case 3:
                    $error = 'File was only partially uploaded';
                    break;
                case 4:
                    $error = 'No file was uploaded';
                    break;
                case 6:
                    $error = 'Temp folder not found';
                    break;
                case 7:
                    $error = 'Failed to write to disk';
                    break;
                case 8:
                    $error = 'A PHP extension stopped the upload';
                    break;
                default:
                    break;
            }


            $data = array(
                'title' => 'Error',
                'content' => 'result',
                'msg' => $error,
                'error' => 1,
                'page_title' => 'Upload Error',
            );
            $this->load->view('page_admin', $data);
        }
            else
        {
//            print_array($_POST);
//            print_array($_FILES['file']);
//            print_array($_FILES['image'], null, 1);


            $book = array();
            $temp_file = $_FILES["file"]["tmp_name"];

            $book['name'] = preg_replace('~ ~', '_', $_FILES["file"]["name"]);

            $shit = $this->book_model->find_book_by_name($book['name']);
//            echo '$book[\'name\']: '.$book['name'].  "<br />\n";
//            echo '$shit: '.$shit;
//            print_array($shit, 'line 353 books.php', 1);
            if(is_array($shit)){
                $data = array(
                    'title' => 'Book Exists',
                    'content' => 'result',
                    'msg' => $_FILES['file']['name'].' has already been uploaded',
                    'page_title' => 'Duplicate?',
                );
//                $this->load->view('page', $data);
                redirect('/books/add_book/Book Already Exists');
            }

            $book['display_name'] = $_POST['display_name'];
            $book['rating'] = $_POST['rating'];
            $book['size'] = $_FILES["file"]["size"];
            $book['year_published'] = $_POST['year_published'];
            if(!empty($_POST['comments'])){
                $book['comments'] = $_POST['comments'];
            }else{
                $book['comments'] = NULL;
            }
            if(!empty($_POST['link'])){
                $book['link'] = $_POST['link'];
            }else{
                $book['link'] = NULL;
            }
            if(!empty($_POST['forum'])){
                $book['forum'] = $_POST['forum'];
            }else{
                $book['forum'] = NULL;
            }

            if(isset($_POST['subject_id'])){
                $book['subject_id'] = $_POST['subject_id'];
            }

            if(!empty($_POST['new_subject'])){
                $book['subject_id'] = $this->book_model->new_subject($_POST['new_subject']);
            }

            $book['image'] = null;

            $subject_name = $this->book_model->find_subject_name_by_subject_id($book['subject_id']);

            $dir_name = preg_replace('` `', '_', $subject_name);

            $book['location'] = 'pdf/'.$dir_name.'/'.$book['name'];


            $data = array(
                'dir' => 'pdf/'.$dir_name,
            );
            build_dir_structure($data);

            if(move_uploaded_file($temp_file, $book['location'])){

                $type = $_FILES["file"]["type"];
//                echo "line 101 books.php uploaded file type: ".$type.  "<br />\n";
//str_replace('"', "", $type);
//echo 'new type: '.$type;die();
                $file_types = array("application/force-download", '"application/pdf"', "application/pdf", "image/jpeg", "image/gif", "image/pjpeg", "image/png");
                if (in_array($type, $file_types)){

                    //save book image if posted
                    if($_FILES['image']['size'] !== 0 && $_FILES['image']['error'] < 1){
                        $path_parts = pathinfo($_FILES['image']['name']);
                        $ext = $path_parts['extension'];
                        $image_name = $this->book_model->db_prep($book['display_name']).'.'.$ext;
                        $new_file = 'images/pdf/'.$image_name;
                        $temp_file = $_FILES['image']['tmp_name'];

//                        echo '$image_name: '.$image_name.  "<br />\n";
//                        echo '$new_file: '.$new_file.  "<br />\n";
//                        die();

                        if(move_uploaded_file($temp_file, $new_file)){
                            $book['image'] = $new_file;
                        }else{
                            echo 'could not move file';die();
                        }
                    }
                    // done saving book image

                    $id = $this->book_model->add_book($book);



                    redirect("/books/edit_book/$id");
                }else{
                    $data = array(
                        'title' => 'Error',
                        'content' => 'result',
                        'msg' => 'File Type Not Supported',
                        'page_title' => 'File Type Error',
                    );
                    $this->load->view('page', $data);
                }

            }else{
                $data = array(
                    'title' => 'Error',
                    'content' => 'result',
                    'msg' => $book['display_name']." could not be moved to ".$book['location'],
                    'page_title' => 'File Save Error',
                );
                $this->load->view('page', $data);
            }

        }

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



}
?>