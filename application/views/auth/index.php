<div class='mainInfo grid_12 push_2'>

    	<h1>Users</h1>
	<p>Below is a list of the users.</p>




	<div id="infoMessage"><?php echo $message;?></div>
<?php
echo form_open();
echo form_fieldset();
?>
	<table cellpadding=0 cellspacing=10>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Group</th>
			<th>Status</th>
		</tr>

		<?php foreach ($users as $user):?>
			<tr>
				<td><?php echo $user['first_name']?></td>
				<td><?php echo $user['last_name']?></td>
				<td><?php echo $user['email'];?></td>
				<td><?php echo $user['group_description'];?></td>
				<td><?php echo ($user['active']) ? anchor("auth/deactivate/".$user['id'], 'Active') : anchor("auth/activate/". $user['id'], 'Inactive');?></td>
			</tr>
		<?php endforeach;?>
	</table>

        <?php
        echo form_fieldset_close();
        echo form_close();
        ?>


	<p><a href="<?php echo site_url('auth/create_user');?>">Create a new user</a></p>

<!--	<p><a href="<?php // echo site_url('auth/logout'); ?>">Logout</a></p>-->


</div>
