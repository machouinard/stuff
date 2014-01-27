<div class="grid_12 push_2">
<?php

$user = $this->ion_auth->get_user();
$id = $user->id;

//print_array($user, 'User Array');
//print_array($user_album, 'User Album');


echo form_open('utility/user_edit_process');
echo form_fieldset('edit account info');
echo form_label('First Name', 'first_name');
echo form_input('first_name', $user->first_name).  "<br />\r\n";
echo form_label('Last Name ', 'last_name');
echo form_input('last_name', $user->last_name).  "<br />\r\n";
echo form_label('Email ');
echo form_input('email', $user->email, "size='40'").  "<br />\r\n";
echo form_label('Additional Email Address');
echo form_input('email2', $user->email2, "size='40'").  "<br />\r\n";

echo form_hidden('user_id', $id);
echo form_fieldset_close();
echo form_submit('submit', 'Save Changes');
echo form_close();

?>
</div>