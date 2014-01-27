<div class="grid_14 push_1">


    <?php
    $this->load->helper('directory');

    echo form_open('/books/add_folder');
    echo form_fieldset('Add Directory');
    echo form_input('folder').  "<br />\r\n";
    echo form_submit('submit', 'Add');
    echo form_fieldset_close();
    echo form_close();







    $dir = 'pdf/';
   $dirs = directory_map($dir, 1);
   $folders = array();
   foreach ($dirs as $folder){
        $folders[$folder] = $folder;
   }



    echo form_open_multipart('books/upload');
    echo form_fieldset('Add to Library');

    echo form_label('Category', 'folder');
    echo form_dropdown('folder', $folders);
    ?>




<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

    <?php
    echo form_fieldset_close();
    echo form_close();
    ?>





</div>