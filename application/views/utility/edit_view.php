<div class="grid_12 push_2">
<?php
// $book is all the info from pdfTitles
//print_array($book);
$attrib = array(
  'class' => 'library',
);
echo form_open('books/make_edits', $attrib);
echo form_fieldset();
$data = array(
  'name' => 'name',
    'value' => $book['name'],
    'size' => '75',
);
echo form_input($data).  "<br />\r\n";
$data = array(
  'name' => 'author',
    'size' => '50',
);
echo form_label('Author', 'author');
echo form_input($data).  "<br />\r\n";
$data = array(
  1 => '1',
    2 => '2',
    3 => '3',
    4 => '4',
    5 => '5',
);
echo form_label('Rating', 'rating');
echo form_dropdown('rating', $data).  "<br />\r\n";



echo form_submit('submit', 'Edit');
echo form_fieldset_close();
echo form_close();


?>
</div>