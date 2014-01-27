<div class="grid_10 push_3">
    <h2></h2>
    <?php
    echo 'base_url: '.  base_url().  " <br />\r\n";
    echo 'site_url: '. site_url().  " <br />\r\n";

    echo form_open('csv/write_to_csv');
    echo form_fieldset('Write to CSV file');
    echo form_label('WP Username', 'name');
    $attr = array(
      'name' => 'name',
        'type' => 'text',
        'size' => '15',
    );
    echo form_input($attr).  " <br />\r\n";
    $attr = array(
      'name' => 'category',
        'type' => 'text',
        'size' => '25',
    );
    echo form_label('Category', 'category');
    echo form_input($attr).  " <br />\r\n";
    echo form_label('Image Directory', 'image_dir');
    $attr = array(
        'name' => 'image_dir',
        'type' => 'text',
        'size' => '25',

    );
    echo form_input($attr);


    echo form_submit('write', 'Write to file');
    echo form_fieldset_close();
    echo form_close();
    ?>
</div>