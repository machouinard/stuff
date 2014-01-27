<?php 
$this->load->helper('directory');

$dir = './sort';

$teams = directory_map($dir);

print_array($teams, 'Sort Dir');

$as = $teams['As'];
$season = $as['S01'];
natcasesort($season);
print_array($season, 'Should be sorted');




?>