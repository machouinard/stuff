<?php



class Book_model extends CI_Model{


    function add_book($book){
        //print_array($book);
        $location = $book['location'];
        $name = mysql_real_escape_string($book['name']);
        $name = htmlspecialchars($name);
        $display_name = mysql_real_escape_string($book['display_name']);
        $rating = $book['rating'];
        $size = $book['size'];
        $year_published = $book['year_published'];
        $comments = mysql_real_escape_string($book['comments']);
        $link = mysql_real_escape_string($book['link']);
        $image = $book['image'];
        $forum = mysql_real_escape_string($book['forum']);

        $query = "INSERT INTO pdfTitles(location, name, display_name, rating, size, year_published, comments, link, image, forum)
            VALUES('{$location}', '{$name}', '{$display_name}', '{$rating}', '{$size}', '{$year_published}', '{$comments}',
            '{$link}', '{$image}', '{$forum}')";
        $result = mysql_query($query);
        if(!$result){
            $msg = $display_name.' was not inserted successfully<br />'.  mysql_error();
            $data = array(
                'title' => 'Error',
                'content' => 'result',
                'msg' => $msg,
                'page_title' => 'pdfTitles Error',
            );
            $this->load->view('page_admin', $data);
        }else{
            $id = mysql_insert_id();
            $subject_id = $book['subject_id'];
            $query = "INSERT INTO pdfSubjectTitle(subject_id, title_id) VALUES('{$subject_id}', '{$id}')";
            $result = mysql_query($query);
            if(!$result){
                $msg = $display_name.' was not added to pdfSubjectTitle<br />'.  mysql_error();
                $data = array(
                    'title' => 'Error',
                    'content' => 'result',
                    'msg' => $msg,
                    'page_title' => 'pdfSubjectTitle Error',
                );
                $this->load->view('page_admin', $data);
            }else{
                return $id;
            }

        }


    }

    function add_book2($book){

    }

    function count_books_by_subject($subject){
        $count = 0;
	$id = $this->find_subject_id_from_subject_name($subject);
	$query = "SELECT pdfTitles.id FROM pdfSubjectTitle INNER JOIN pdfTitles ON pdfSubjectTitle.title_id = pdfTitles.id WHERE pdfSubjectTitle.subject_id = '$id'";
	//$query = "SELECT * FROM pdfTitles";
	if($result = mysql_query($query)){
            $count = mysql_num_rows($result);
        }
	return $count;
    }


    function book_exists($name){

    }


    function db_prep($str){
        $new_string = preg_replace('~ ~', '_', $str);
        return mysql_real_escape_string($new_string);
    }

    function delete_book($id){
        $query = "SELECT location, image FROM pdfTitles WHERE id = '{$id}'";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        if(!unlink($row['location'])){
            log_message('debug', "{$row['location']} could not be deleted");
        }
        if(!unlink($row['image'])){
            log_message('debug', "{$row['image']} could not be deleted");
        }
    }

    function find_books_by_subject($subject){
        $name = array();
        $books = array();
        $id = $this->find_subject_id_from_subject_name($subject);
        $query = "SELECT pdfTitles.id FROM pdfSubjectTitle
            INNER JOIN pdfTitles ON pdfSubjectTitle.title_id = pdfTitles.id
            WHERE pdfSubjectTitle.subject_id='$id'";
        $result = mysql_query($query);
        if($result){
            while ($row = mysql_fetch_array($result)){
                $id = $row['id'];
                $name[$id] = $this->find_book_name_by_id($id);

            }
            array_push($books, $name);
            return $books[0];
        }  else {
            return FALSE;
        }
    }



    function find_book_by_id($id){
        $query = "SELECT * FROM pdfTitles WHERE id = '$id' ORDER BY 'display_name'";
        $result = mysql_query($query);
        return mysql_fetch_assoc($result);
    }

    function find_book_by_name($name){
        $query = "SELECT * FROM pdfTitles WHERE name = '$name'";
        $result = mysql_query($query);
        if(mysql_num_rows($result) > 0){
            return mysql_fetch_assoc($result);
//            $row = mysql_fetch_assoc($result);
//            return $row['name'];
        }
    }


    function find_book_by_id2($id){
        $query = "SELECT * FROM pdfTitles WHERE id = '$id' ORDER BY 'display_name'";
        $result = mysql_query($query);
        return $result;
    }


    function find_books_by_subject2($subject){
        $books = array();
        $id = $this->find_subject_id_from_subject_name($subject);
        $query = "SELECT pdfTitles.id, pdfTitles.location FROM pdfSubjectTitle
            INNER JOIN pdfTitles ON pdfSubjectTitle.title_id = pdfTitles.id
            WHERE pdfSubjectTitle.subject_id='$id'";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)){
            $location = $row['location'];
            $id = $row['id'];
            $name[$location] = $this->find_book_name_by_id($id);
        }
        array_push($books, $name);
        //print_array($books[0], 'find_books_by_subject', 1);
        return $books[0];
    }


    function find_book_name_by_id($id){
        $query = "SELECT display_name FROM pdfTitles WHERE id = '$id'";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        return $row['display_name'];
    }


    function find_rating_id($name){
        $query = "SELECT id FROM pdfRating WHERE name = '$name'";
        $result = mysql_query($query);
        $rating = mysql_fetch_array($result);

        $id = $rating['id'];
        echo 'book_model line 91$id is: '.$id;die();
        return $id;
    }


    function find_rating_name($id){
        $query = "SELECT name FROM pdfRating WHERE id = '$id'";
        $result = mysql_query($query);
        $rating = mysql_fetch_array($result);
        $name = $rating['name'];

        return $name;
    }



    function find_subject_id_from_subject_name($subject){
        $query = "SELECT id FROM pdfSubjects WHERE name = '$subject'";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);

        return $row['id'];
    }

    function find_subject_name_by_book_id($id){
        $query = "SELECT pdfSubjects.`name`
FROM pdfSubjectTitle INNER JOIN pdfTitles ON pdfSubjectTitle.title_id = pdfTitles.id
	 INNER JOIN pdfSubjects ON pdfSubjects.id = pdfSubjectTitle.subject_id
WHERE pdfSubjectTitle.title_id={$id}";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        return $row['name'];
    }

    function find_subject_name_by_subject_id($id){
        $query = "SELECT name FROM pdfSubjects WHERE id = $id";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);

        return $row['name'];
    }


    function get_ratings_dropdown(){
        $ratings = '<select name="rating">'.  "<br />\n";
        $query = "SELECT * FROM pdfRating ORDER BY id";
        $result = mysql_query($query);
        while ($row = mysql_fetch_assoc($result)){
            if($row['name'] == 'none'){
                $ratings .= '<option value="'.$row['id'].'" selected>'.$row['name']."</option>\n";
            }else{
                $ratings .= '<option value="'.$row['id'].'">'.$row['name']."</option>\n";
            }
        }
        $ratings .= "</select>\n";
        return $ratings;
    }

    function get_subjects(){
        $subjects = array();
        $query = "SELECT name FROM pdfSubjects ORDER BY name";
        $result = mysql_query($query);

        while ($row = mysql_fetch_array($result)){

            array_push($subjects, $row['name']);
        }
	return $subjects;
    }


    function get_subjects_dropdown(){
        $subjects = '<select name="subject_id">'.  "<br />\n";
        $query = "SELECT * FROM pdfSubjects ORDER BY name";
        $result = mysql_query($query);
        while ($row = mysql_fetch_assoc($result)){
            $subjects .= '<option value="'.$row['id'].'">'.$row['name']."</option>\n";
        }
        $subjects .= "</select>\n";
        return $subjects;
    }

    function is_subject($subject){
        $query = "SELECT * FROM pdfSubjects WHERE name = '$subject'";
        $result = mysql_query($query);
        if(mysql_num_rows($result)){
            return TRUE;
        }

    }

    function new_subject($subject){

        if($this->is_subject($subject)){
            $id = $this->find_subject_id_from_subject_name($subject);
            return $id;
        }else{
            $subject_dir = preg_replace('~ ~', '_', $subject);
            $query = "INSERT INTO pdfSubjects(name, location) VALUES('$subject', '$subject_dir')";
            if(mysql_query($query)){
                $id = mysql_insert_id();
                return $id;
            }
        }
    }

    function log_download($data){
       $ip = $data['ip'];
       $title_id = $data['title_id'];
       $query = "INSERT INTO pdfDownload(title_id, ip_address) VALUES($title_id, $ip)";
       mysql_query($query);
    }

}
?>
