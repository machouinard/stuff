
<div class="grid_10 push_1">


<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/change_password");?>
<fieldset>
    <label for="old">old password</label>
      <?php echo form_input($old_password);?>
      <br />

    <label for="new">new password</label>
      <?php echo form_input($new_password);?>
      <br />

      <label for="new_confirm">confirm password</label>
      <?php echo form_input($new_password_confirm);?>
      <br />
      </fieldset>
      <?php echo form_input($user_id);?>
      <p><?php echo form_submit('submit', 'Change');?></p>

<?php echo form_close();?>

      </div>