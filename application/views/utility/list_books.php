
<div class="grid_14">
<?php
//print_array($books);
if (isset($edit)){
    // $books will be coming from books controller
    natcasesort($books);
   foreach ($books as $id=>$name){
       echo form_open('/books/download2');
       echo form_fieldset();
       echo "<p>$name</p>";
       echo form_hidden('id', $id);
       echo form_submit('submit', 'Download');
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
        if($selected_subject == $subject){
            $subject_list .= "<option value=\"$subject\" selected='selected'>$subject</option>\r\n";
        }else{
     $subject_list .= "<option value=\"$subject\">$subject</option>\r\n";
        }
    }


?>



    <form action="view_books" method="post">

        <select name="subject">
            <?php echo $subject_list; ?>
        </select>
        <input type="submit" value="View Books">
    </form>





    </div>