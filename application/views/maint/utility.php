<?php



echo form_open('/portfolio/update_thumbs');

echo form_fieldset('Update Thumbs');

$data = array(

    '200' => '200px',

    '250' => '250px',

    '300' => '300px',

    '400' => '400px',

    '500' => '500px',

);

echo form_label("Resize to:<br />\r\n(as close to, while<br />\r\n maintaining aspect ratio)", 'size');

echo form_dropdown('size', $data, '200').  "<br /><br />\r\n";



echo form_hidden('year', 2011);

echo form_submit('submit', 'Update');

echo form_fieldset_close();

echo form_close();





echo form_open('/portfolio/update_med_thumbs');

echo form_fieldset('Update Intermediate Thumbs');

$data = array(

    '600' => '600px',

    '800' => '800px',

    '1000' => '1000px',

);

echo form_label("Resize to:<br />\r\n(as close to, while<br />\r\n maintaining aspect ratio)", 'size');

echo form_dropdown('size', $data, '200').  "<br /><br />\r\n";



echo form_hidden('year', 2011);

echo form_submit('submit', 'Update');

echo form_fieldset_close();

echo form_close();





echo form_open('portfolio/add_image');

echo form_fieldset('Add Image');

echo form_submit('submit', 'Add');

echo form_fieldset_close();

echo form_close();



?>

