<div class='mainInfo grid_8 push_1''>

	<h1>Create Account</h1>
	<p>Please enter your information below.</p>



	<div id="infoMessage"><?php echo $message;?></div>

    <?php
    echo form_open("auth/create_account");
    echo form_fieldset();
    ?>

      <p>  <label for="first_name">First Name:</label>
      <?php echo form_input($first_name);?>
      </p>

      <p><label for="last_name">Last Name:</label>
      <?php echo form_input($last_name);?>
      </p>


      <?php echo form_input($company);?>


      <p><label for="email">Email:</label>
      <?php echo form_input($email);?>
      </p>


      <?php
      echo form_input($phone1);
      echo form_input($phone2);
      echo form_input($phone3);
      ?>


      <p><label for="password">Password:</label>
      <?php echo form_input($password);?>
      </p>

      <p><label for="password_confirm">Confirm Password:</label>
      <?php echo form_input($password_confirm);?>
      </p>


      <p><?php
      echo form_fieldset_close();
      echo form_submit('submit', 'Create User');?></p>


    <?php echo form_close();?>

</div>
