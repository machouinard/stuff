<div class="clear"></div>
<div id="stylized" class="grid_10 push_1">

    <?php
    echo form_open('email/mailto_mark');
    echo form_fieldset('Put words in these boxes');
    ?>


    <label for="name" >Name</label>
    <input type="text" name="name" value="<?php echo set_value('name'); ?>" size="30" /><br />
    <label for="email" >Email</label>
    <input type="text" name="email" value="<?php echo set_value('email'); ?>" size="30" /><br />
    <label for="subject">Subject</label>
    <input type="text" name="subject" value="<?php echo set_value('subject'); ?>" size="30" /><br />
    <label for="msg" >What's on your mind?</label>
    <textarea name="msg" rows="5" cols="30" ><?php echo set_value('msg'); ?></textarea><br />
    <input type="submit" name="submit" value="Send" />

    <?php




    echo form_fieldset_close();
    echo form_close();
    ?>



</div>