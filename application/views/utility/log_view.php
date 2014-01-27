<div class="grid_15 push_1">
<?php
$date = date("Y-m-d");
$file = "application/logs/log-$date.php";
//$file = "application/logs/log.php";
if(file_exists($file)){
$contents = file_get_contents($file);
print_array($contents);
}else{
    echo '<div class="grid_4 push_5"><h2>No File Found</h2></div>';
}
?>
</div>
<div class="grid_2">
<?php
echo form_open('utility/delete_file');
echo form_fieldset('Empty File');
echo form_submit('submit', 'Delete');
echo form_hidden('file', $file);
echo form_fieldset_close();
echo form_close();
?>
</div>