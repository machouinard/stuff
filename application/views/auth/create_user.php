<div class='mainInfo grid_12 push_2'>

	<h1>create user</h1>
	<p>Please enter the users information below.</p>

	<div id="infoMessage"><?php echo $message;?></div>

    <?php echo form_open("auth/create_user");?>
        <fieldset>
            <label for="firs_name">first name</label>
      <?php echo form_input($first_name);?><br />


            <label for="last_name">last name</label>
      <?php echo form_input($last_name);?><br />


            <label for="company">company</label>
      <?php echo form_input($company);?><br />


            <label for="email">email</label>
      <?php echo form_input($email);?><br />


            <label for="phone">phone</label>
      <?php echo form_input($phone1);?>-<?php echo form_input($phone2);?>-<?php echo form_input($phone3);?><br />


      <label for="password">password</label>
      <?php echo form_input($password);?><br />


      <label for="password_confirm">confirm password</label>
      <?php echo form_input($password_confirm);?><br />


      </fieldset>
      <p><?php echo form_submit('submit', 'Create User');?></p>


    <?php echo form_close();?>

</div>
