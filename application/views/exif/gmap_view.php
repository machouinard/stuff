<div id="stylized" class="grid_10 push_3">



echo form_open('gmap/show_map');
echo form_fieldset('Enter Info');
?>
    <label for="street">Airport Code</label>
    <input type="text" name="street" value="<?php echo set_value('street');?>" size="50"/><br />
    <?php echo form_label('City', 'city');?>
    <input type="text" name="city" value="<?php echo set_value('city');?>" size="30"/><br />
    <?php echo form_label('State', 'state');?>
    <input type="text" name="state" value="<?php echo set_value('state');?>" size="5"/><br />
    <input type="submit" name="submit" value="View on Map" />
<?php

echo form_fieldset_close();
echo form_close();
?>
</div>