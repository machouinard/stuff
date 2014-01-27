<?php
$name_list = "/home/machoui/public_html/stuff/tal/test/names.txt";
$dir = "/home/machoui/public_html/stuff/ct/";
$ep_names = array();

$file_names = get_filenames($dir);
//print_array($file_names, 'filenames', 1);
$pattern = "~#([\s\S]+)_\s*([\s\S]+).mp3~";
$pattern2 = "~([\d]{1,3}):\s([\d\w\s]+)~";


//print_array($file_names, 'file names');
//foreach($file_names as $file){
//    preg_match($pattern, $file, $matches);
//
//}
natcasesort($file_names);
foreach($file_names as $file){
//    preg_match($pattern, $file, $matches);
//    print_array($matches, '$matches');
    $name = preg_replace('/,/', '', $file);
    echo $file.  "<br />\n";
    echo $name.  "<br /><br />\n";

    rename($dir.$file, $dir.$name);
//    echo $file.  "<br />\n";
//    echo $matches[1].'-'.$name.  ".mp3<br /><br />\n";


//    $oldname = $file;
//    $newname = $matches[1].'-'.$name.'.mp3';
//    echo 'old: '.$oldname.  "<br />\n";
//    echo 'new: '.$newname.  "<br /><br />\n";
    //rename($oldname, $newname);
}
//print_array($file_names);
?>