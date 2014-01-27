
<div class="grid_14">
<?php


if (isset($edit)){
    // $books will be coming from books controller

   foreach ($books as $id=>$name){
       echo form_open('/books/edit_a_book');
       echo form_fieldset();
       echo $name;
       echo form_hidden('id', $id);
       echo form_submit('submit', 'Edit');
       echo form_fieldset_close().  "<br />\r\n";
       echo form_close();
   }



}




$subjects = $this->book_model->get_subjects();
$subject_list = '';
//subjects is array of subjects coming from books/manage
    foreach ($subjects as $subject){
     $subject_list .= "<option value=\"$subject\">$subject</option>\r\n";
    }

?>



    <form action="edit_books" method="post">

        <select name="subject">
            <?php echo $subject_list; ?>
        </select>
        <input type="submit" value="View Books">
    </form>





    </div>