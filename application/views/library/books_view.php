<div class="grid_12 push_2">

    <?php
    $this->load->helper('directory');
    $dir = 'pdf/';
    $files = directory_map($dir);

    ksort($files);
    foreach ($files as $key=>$subject){

            $display_key = preg_replace('~_~', " ", $key);
            $books = array();
            $attributes = array('class' => 'library');
            echo '<form action="books/download" class="library" method="post">';
            echo form_fieldset($display_key);

            foreach ($subject as $book){
                $books[$dir.$key.'/'.$book] = $book;
            }
            natcasesort($books);

            echo form_dropdown('book', $books).  "<br />\r\n";

            // Couldn't set a hidden field for book name for each book, only for each form.
            // USED REGULAR EXPRESSIONS IN BOOKS/DOWNLOAD
            //echo form_hidden('book_name', $book);
            if(!empty($books)){
            echo form_submit('submit', 'Download');
            }
            echo form_fieldset_close();
            echo form_close();

        //print_array($books);
    }



    ?>
</div>