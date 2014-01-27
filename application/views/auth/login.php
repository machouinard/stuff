







	<div id="infoMessage"><?php echo $message;?></div>
        <div id="login_form" class="grid_8 push_1">
    <?php echo form_open("auth/login");?>
    <?php echo form_fieldset('Login with email address and password');?>
      <p>
      	<label for="email">Email:</label>
      	<?php echo form_input($email);?>
      </p>

      <p>
      	<label for="password">Password:</label>
      	<?php echo form_input($password);?>
      </p>

      <p>
	      <label for="remember">Remember Me:</label>
	      <?php echo form_checkbox('remember', '1', FALSE);?>
	  </p><br />


      <p><?php
      echo form_fieldset_close();
      echo form_submit('submit', 'Login');
      ?></p>


    <?php

    echo form_close();
    ?>

        </div>
