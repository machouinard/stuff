<?php
$this->load->helper('directory');
$dir = './au/';


$shows = directory_map($dir);

$soa = $shows['SOA'];
$season4 = $soa['S04'];
sort($season4);  //season 4 is now an array containing sorted episodes with matching array keys
foreach($season4 as $key=>$value){
    $path_parts = pathinfo($value);
    $name = $path_parts['filename'];
    $season[$value] = $name;
}
//print_array($season, 'Season 4', 1);
echo '<div class="grid_3">';
echo form_open('ent/download');
echo form_fieldset('SOA S04');
echo form_dropdown('file', $season).  "<br /><br />\r\n";
echo form_hidden('show', 'SOA');
echo form_hidden('season', 'S04');
echo form_submit('submit', 'Download');
echo form_fieldset_close();
echo form_close();
echo '</div>';

unset($season);

$league = $shows['The_League'];
$season3 = $league['S03'];
sort($season3);
//print_array($season3, 'The League Season 3 Episodes');
foreach($season3 as $key=>$value){
   $path_parts = pathinfo($value);
   $name = $path_parts['filename'];
   $season[$value] = $name;
}
echo '<div class="grid_4">';
echo form_open('ent/download');
echo form_fieldset('The League S03');
echo form_dropdown('file', $season).  "<br /><br />\r\n";
echo form_hidden('show', 'The_League');
echo form_hidden('season', 'S03');
echo form_submit('submit', 'Download');
echo form_fieldset_close();
echo form_close();
echo '</div>';
echo '<div class="clear"></div>';




?>