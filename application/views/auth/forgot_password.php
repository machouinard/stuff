<div class="grid_8 push_1">
<h1>Forgot Password</h1>
<p>Please enter your <?php echo $identity_human;?> so the server can reset your password.<br />
Check your inbox after hitting <i>Submit</i></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php
echo form_open("auth/forgot_password");
echo form_fieldset();
?>

      <p><label for="<?php echo $identity; ?>"><?php echo $identity_human;?>:</label><br />
      <?php echo form_input($identity);?>
      </p>
      <?php echo form_fieldset_close(); ?>
      <p><?php echo form_submit('submit', 'Submit');?></p>

<?php echo form_close();?>

      </div>