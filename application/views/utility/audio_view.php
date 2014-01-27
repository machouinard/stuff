<div class="grid_10 push_1">

<?php
echo form_open('audio_files/add_audio_files');
$attr = array(
  'name' => 'dir',
    'size' => '25',
);
echo form_label('Directory', 'dir');
echo form_input($attr).  "<br />\n";
echo form_label('Category', 'category');
$attr = array(
  'name' => 'category',
    'size' => '25',
);
echo form_input($attr).  "<br />\n";

echo form_hidden('names', $names);
echo form_submit('submit', 'Submit');
echo form_close();


?>

</div>