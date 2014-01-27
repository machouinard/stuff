<div class="grid_8 push_4">
    <?php
    echo form_open_multipart('upload/geotag');
    echo form_fieldset('Zip/Exif Test');
    echo form_label('ZIP', 'zip');
    echo form_upload('zip');
    echo form_submit('submit', 'Upload');
    echo form_fieldset_close();
    echo form_close();
    ?>
</div>