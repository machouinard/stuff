<div class="grid_3">
    <?php
    echo form_open('utility/logs');
    echo form_fieldset('Today\'s Log');
    echo form_submit('submit', 'View');
    echo form_fieldset_close();
    echo form_close();
    ?>
</div>

<div class="grid_2">
<?php
$data = array(
    INFO_GENERAL => 'General',
    INFO_CONFIGURATION => 'Config',
    INFO_MODULES => 'Modules',
    INFO_ENVIRONMENT => 'Environ',
    INFO_VARIABLES => 'VARS',
    INFO_ALL => 'ALL',
);
echo form_open('utility/info');
echo form_fieldset('PHPInfo');
echo form_dropdown('constant', $data, INFO_MODULES);
echo form_submit('submit', 'View');
echo form_fieldset_close();
echo form_close();
?>
</div>

<div class="clear"></div>
<hr class="divider">
<div class="grid_10 push_3">
    <?php
    echo form_open_multipart('utility/read_exif');
echo form_fieldset('Don\'t erase this again');
echo form_label('Select an Image', 'userfile');
$data = array(
		'type' => 'file',
		'name' => 'userfile',
		'size' => '30',
		);
echo form_input($data);
echo form_submit('submit', 'View EXIF');
echo form_fieldset_close();
echo form_close();
    ?>
</div>