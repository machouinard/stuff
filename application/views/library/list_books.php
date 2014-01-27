
<div class="grid_10 push_1">
<?php
//print_array($books);
if (isset($edit) && is_array($books)){
    // $books will be coming from books controller
    natcasesort($books);
   foreach ($books as $id=>$name){
	   $attrib = array(
	   'class' => 'library_list',
		);
       echo form_open('/books/download2', $attrib);
       echo form_fieldset();
       echo form_hidden('id', $id);
       if($this->ion_auth->is_group('library')){
       echo '<a href="/books/display_book/'.$id.'">'.$name.'</a>';
       }else{
           echo '<a href="/books/edit_book/'.$id.'">'.$name.'</a>';
       }
       if($this->ion_auth->is_admin()){
           echo form_submit('delete', 'Delete');
       }else{
       echo form_submit('submit', 'Download');
       }
       echo form_fieldset_close().  "<br />\r\n";
       echo form_close();
   }



}

if(isset($_COOKIE['subject'])){
        $selected_subject = $_COOKIE['subject'];
    }else{
        $selected_subject = 'ActionScript';
    }


$subjects = $this->book_model->get_subjects();
$subject_list = '';
//subjects is array of subjects coming from books/manage
    foreach ($subjects as $subject){

        //$id = $this->book_model->find_subject_id_from_subject_name($subject);
        $count = $this->book_model->count_books_by_subject($subject);
        if($selected_subject == $subject){

            $subject_list .= "<option value=\"$subject\" selected='selected'>$subject ($count)</option>\r\n";
        }else{
     $subject_list .= "<option value=\"$subject\">$subject ($count)</option>\r\n";
        }
    }


?>



    <form action="/books/list_by_subject" class="library" method="post">
        <label for="subject">Subject</label><br />
        <select name="subject">
            <?php echo $subject_list; ?>
        </select>
        <input type="submit" value="View Books">
    </form>





    </div>