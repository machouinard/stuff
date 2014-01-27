<div id="gmap" class="grid_16">

    <div id="distance" class="grid_8 push_6"><span class="mini_text">click anywhere on the map for distance measurement from marker</span></div>
<?php

echo $map['html'];
?>
</div>

<div class="clear"></div>
<?php
$gps_data = array(
          'gps_error' => 'error',
            );
$this->load->view('exif/exif_view', $gps_data);

if(isset($exif_thumb) && $exif_thumb !== FALSE){
    echo '<div id="exif_thumb" class="grid_4 push_11">';
    echo "<h3>Embedded <br />Thumbnail</h3><br /><a href='".  base_url().$exif_thumb."' rel='lightbox'>".img($exif_thumb)."</a>";
    echo '</div>';
    echo '<div id="toggle_exif_on" class="grid_2 pull_4"><h2>Show All Data</h2></div>';
    echo '<div id="toggle_exif_off" class="grid_2 pull_4"><h2>Hide All Data</h2></div>';

}else{
    echo '<div id="toggle_exif_on" class="grid_2"><h2>Show All Data</h2></div>';
    echo '<div id="toggle_exif_off" class="grid_2"><h2>Hide All Data</h2></div>';
}
    echo '<div class="clear"></div>';
echo '<hr class="divider">';
echo '<div id="main_exif1" class="grid_8">';
if(isset($exif_exif)){
    if(strpos($exif_exif, '<td>') !== false){
        echo '<div id="show_exif_exif" class="grid_8"><h2>Show EXIF</h2></div>';
        echo '<div id="exif_exif" class="grid_8">';
        echo $exif_exif;
    echo '</div>';
    }
}
if(isset($exif_xmp)){
    if(strpos($exif_xmp, '<td>') !== false){
        echo '<div id="show_exif_xmp" class="grid_8"><h2>Show XMP</h2></div>';
        echo '<div id="exif_xmp" class="grid_8">';
        echo $exif_xmp;
    echo '</div>';
    }
}
if(isset($exif_photoshop)){
    if(strpos($exif_photoshop, '<td>') !== false){
        echo '<div id="show_exif_photoshop" class="grid_8"><h2>Show Photoshop</h2></div>';
        echo '<div id="exif_photoshop" class="grid_8">';
        echo $exif_photoshop;
    echo '</div>';
    }
}
if(isset($exif_iptc)){
    if(strpos($exif_iptc, '<td>') !== false){
        echo '<div id="show_exif_iptc" class="grid_8"><h2>Show IPTC</h2></div>';
        echo '<div id="exif_iptc" class="grid_8">';
        echo $exif_iptc;
    echo '</div>';
    }
}

if(isset($exif_jfif)){
    if(strpos($exif_jfif, '<td>') !== false){
        echo '<div id="show_exif_jfif" class="grid_8"><h2>Show JFIF</h2></div>';
        echo '<div id="exif_jfif" class="grid_8">';
        echo $exif_jfif;
    echo '</div>';
    }
}
if(isset($exif_exif_tool)){
    if(strpos($exif_exif_tool, '<td>') !== false){
        echo '<div id="show_exif_exif_tool" class="grid_8"><h2>Show ExifTool Info</h2></div>';
        echo '<div id="exif_exif_tool" class="grid_8">';
        echo $exif_exif_tool;
    echo '</div>';
    }
}
echo '</div>';
echo '<div id="main_exif2" class="grid_8">';

if(isset($exif_file)){
    if(strpos($exif_file, '<td>') !== false){
        echo '<div id="show_exif_file" class="grid_8"><h2>Show File Info</h2></div>';
        echo '<div id="exif_file" class="grid_8">';
        echo $exif_file;
    echo '</div>';
    }
}
if(isset($exif_maker_notes)){
    if(strpos($exif_maker_notes, '<td>') !== false){
        echo '<div id="show_exif_maker_notes" class="grid_8"><h2>Show Maker Notes</h2></div>';
        echo '<div id="exif_maker_notes" class="grid_8">';
        echo $exif_maker_notes;
    echo '</div>';
    }
}
if(isset($exif_composite)){
    if(strpos($exif_composite, '<td>') !== false){
        echo '<div id="show_exif_composite" class="grid_8"><h2>Show Composite</h2></div>';
        echo '<div id="exif_composite" class="grid_8">';
        echo $exif_composite;
    echo '</div>';
    }
}
if(isset($exif_icc_profile)){
    if(strpos($exif_icc_profile, '<td>') !== false){
        echo '<div id="show_exif_icc_profile" class="grid_8"><h2>Show ICC Profile</h2></div>';
        echo '<div id="exif_icc_profile" class="grid_8">';
        echo $exif_icc_profile;
    echo '</div>';
    }
}

?>

</div>
<div class="clear"></div>
<div id="thanks" class="grid_11 push_3 subtitle">
    Thanks to Phil Harvey for his <a href="http://www.sno.phy.queensu.ca/~phil/exiftool/" target="_blank">ExifTool</a>, <a href="http://www.imagemagick.org/script/index.php" target="_blank">ImageMagick</a> for the histograms
    and Jeffrey Friedl, whose <a href="http://regex.info/exif.cgi" target="_blank">site</a> I found while building this project<a href='/exif/test_images'>.</a>
</div>
