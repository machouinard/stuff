<?php
$name_list = "/home/machoui/public_html/stuff/tal/test/names.txt";
$dir = "/home/machoui/public_html/stuff/tal/";
$ep_names = array();

$file_names = get_filenames($dir);
//print_array($file_names);
$pattern = "~([\w\s\d]+).mp3~";
$pattern2 = "~([\d]{1,3}):\s([\d\w\s]+)~";

$names = file($name_list);
//print_array($names, 'Should be an array of file names');
foreach($names as $title){

        preg_match($pattern2, $title, $matches);
        $ep_names[$matches[1]] = $matches[2];

}

$flip = array_flip($ep_names);
print_array($ep_names, 'Should be an array with ep no as keys and titles as values');


//print_array($file_names, 'file names');
foreach($file_names as $file){
    preg_match($pattern, $file, $matches);
    $basename = preg_replace('~_~', ' ', $matches[1]);
    $basename = $basename;
    echo $basename."<br />";

    $key = array_search($basename, $ep_names);
    echo $key.' - '.$basename.  "<br />\n";
}


?>