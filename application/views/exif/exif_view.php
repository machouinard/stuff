

<div class="clear"></div>

<span class="seo_hidden"><strong>Welcome to Mark's Online EXIF Viewer</strong></span>
<span class="seo_hidden">View metadata from digital images</span>

<?php
echo '<div class="grid_5 push_1"><br />';
echo form_open();
echo form_fieldset('');
$data = array(
  'name' => 'upload_method_2',
    'id' => 'upload_method_2',
    'value' => 'web',
    'checked' => FALSE,
);
echo form_radio($data)."Image from the InterWeb<br />";
$data = array(
  'name' => 'upload_method_2',
    'id' => 'upload_method_2',
    "value" => 'computer',
    'checked' => TRUE,
);
$js = 'onChange="change_input()"';
echo form_radio($data, $js)."Image from your computer";
echo form_fieldset_close();
echo form_close();
echo '</div>';
//echo '<div class="clear"></div>';
echo form_open_multipart('exif/upload');
echo '<div id="local_image" class="grid_8 push_2">';
echo form_fieldset('Image on Your Computer');
echo form_label('Select an Image', 'userfile');
$data = array(
		'type' => 'file',
		'name' => 'userfile',
		'size' => '30',
		);
echo form_input($data);
echo form_submit('submit', 'View EXIF');
echo form_fieldset_close();
echo form_close();

echo '</div>';

echo '<div id="web_image" class="grid_8 push_2">';
echo '<span class="seo_hidden"><strong>Online Exif Viewer</strong></span>';
echo form_open('exif/web_image');
echo form_fieldset('Image on the InterWeb');
echo form_label('Image URL', 'url');
$input_data = array(
  'name' => 'url',
    'size' => 40,
);
echo form_input($input_data).  "<br />\r\n";
echo form_submit('submit', 'View EXIF');
echo form_fieldset_close();
echo form_close();
?>

</div>
<div class="clear"></div>
<span class="seo_hidden"><b>This page will display exif data for you to view online.</b></span>
<?php
if(isset($exif_thumb) && $exif_thumb !== FALSE && isset($error)){

        echo '<div id="exif_thumb" class="grid_4 push_11">';
        echo "<h3>Embedded Thumbnail</h3><br /><a href='".  base_url().$exif_thumb."' rel='lightbox'>".img($exif_thumb)."</a>";
        echo '</div>';
        echo '<div id="toggle_exif_on" class="grid_2 pull_4"><h2>Show All Data</h2></div>';
        echo '<div id="toggle_exif_off" class="grid_2 pull_4"><h2>Hide All Data</h2></div>';
}elseif(isset($error)){
        echo '<div id="toggle_exif_on" class="grid_2"><h2>Show All Data</h2></div>';
        echo '<div id="toggle_exif_off" class="grid_2"><h2>Hide All Data</h2></div>';
        ////echo '<div id="toggle_exif_on" class="grid_2"><h2>Show All Data</h2></div>';
        //echo '<div id="toggle_exif_off" class="grid_2"><h2>Hide All Data</h2></div>';
}

 echo '<div class="clear"></div>';
 echo '<hr class="divider">';
echo '<div id="main_exif1" class="grid_8">';


if(isset($exif_exif) && !isset($gps_error)){
    if(strpos($exif_exif, '<td>') !== false){
        echo '<div id="show_exif_exif" class="grid_8"><h2>Show EXIF</h2></div>';
        echo '<div id="exif_exif" class="grid_8">';
        echo $exif_exif;
    echo '</div>';
    }
}
if(isset($exif_maker_notes) && !isset($gps_error)){
    if(strpos($exif_maker_notes, '<td>') !== false){
        echo '<div id="show_exif_maker_notes" class="grid_8"><h2>Show Maker Notes</h2></div>';
        echo '<div id="exif_maker_notes" class="grid_8">';
        echo $exif_maker_notes;
    echo '</div>';
    }
}

if(isset($exif_photoshop) && !isset($gps_error)){
    if(strpos($exif_photoshop, '<td>') !== false){
        echo '<div id="show_exif_photoshop" class="grid_8"><h2>Show Photoshop</h2></div>';
        echo '<div id="exif_photoshop" class="grid_8">';
        echo $exif_photoshop;
    echo '</div>';
    }
}

if(isset($exif_jfif) && !isset($gps_error)){
    if(strpos($exif_jfif, '<td>') !== false){
        echo '<div id="show_exif_jfif" class="grid_8"><h2>Show JFIF</h2></div>';
        echo '<div id="exif_jfif" class="grid_8">';
        echo $exif_jfif;
    echo '</div>';
    }
}
if(isset($exif_exif_tool) && !isset($gps_error)){
    if(strpos($exif_exif_tool, '<td>') !== false){
        echo '<div id="show_exif_exif_tool" class="grid_8"><h2>Show ExifTool Info</h2></div>';
        echo '<div id="exif_exif_tool" class="grid_8">';
        echo $exif_exif_tool;
    echo '</div>';
    }
}
echo '</div>';
echo '<div id="main_exif2" class="grid_8">';

if(isset($exif_file) && !isset($gps_error)){
    if(strpos($exif_file, '<td>') !== false){
        echo '<div id="show_exif_file" class="grid_8"><h2>Show File Info</h2></div>';
        echo '<div id="exif_file" class="grid_8">';
        echo $exif_file;
    echo '</div>';
    }
}
if(isset($exif_iptc) && !isset($gps_error)){
    if(strpos($exif_iptc, '<td>') !== false){
        echo '<div id="show_exif_iptc" class="grid_8"><h2>Show IPTC</h2></div>';
        echo '<div id="exif_iptc" class="grid_8">';
        echo $exif_iptc;
    echo '</div>';
    }
}
if(isset($exif_icc_profile) && !isset($gps_error)){
    if(strpos($exif_icc_profile, '<td>') !== false){
        echo '<div id="show_exif_icc_profile" class="grid_8"><h2>Show ICC Profile</h2></div>';
        echo '<div id="exif_icc_profile" class="grid_8">';
        echo $exif_icc_profile;
    echo '</div>';
    }
}

if(isset($exif_composite) && !isset($gps_error)){
    if(strpos($exif_composite, '<td>') !== false){
        echo '<div id="show_exif_composite" class="grid_8"><h2>Show Composite</h2></div>';
        echo '<div id="exif_composite" class="grid_8">';
        echo $exif_composite;
    echo '</div>';
    }
}

if(isset($exif_xmp) && !isset($gps_error)){
    if(strpos($exif_xmp, '<td>') !== false){
        echo '<div id="show_exif_xmp" class="grid_8"><h2>Show XMP</h2></div>';
        echo '<div id="exif_xmp" class="grid_8">';
        echo $exif_xmp;
    echo '</div>';
    }
}
?>



</div>
<?php
if(!isset($gps_error)): ?>
<div class="clear"></div>

<div id="thanks" class="grid_11 push_3 subtitle">
    Thanks to Phil Harvey for his <a href="http://www.sno.phy.queensu.ca/~phil/exiftool/" target="_blank">ExifTool</a>, <a href="http://www.imagemagick.org/script/index.php" target="_blank">ImageMagick</a> for the histograms
    and Jeffrey Friedl, whose <a href="http://regex.info/exif.cgi" target="_blank">site</a> I found while building this project<a href='/exif/test_images'>.</a>
</div>
<?php endif; ?>


<h1 class="seo_hidden">Thanks for using my Online Exif Viewer</h1>

