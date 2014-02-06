<?php

function get_current_version(){
    return CI_VERSION;
}

function build_dir_structure($data){
    foreach($data as $dir){
        if(!is_dir($dir)){
            mkdir($dir, 0777, true);
        }
    }
    return TRUE;
}

function get_image_resolution($image){
    return `~/perl5/bin/exiftool -IFD1:XResolution -IFD1:YResolution $image`;
}

function thumbnail_info($image){
    $info = `~/perl5/bin/exiftool $image -thumbnailimage -b | exiftool -`;
    return $info;
}

function exif_thumb($image, $thumb){
    `~/perl5/bin/exiftool -thumbnailimage -b  $image>$thumb`;
    if(is_file($thumb) && filesize($thumb) > 0){
        return TRUE;
    }else{
        return FALSE;
    }
}

function read_exif($image, $mie){
    $result = `~/perl5/bin/exiftool -TagsFromFile $image -all:all $mie`;
    //echo 'read exif returns: '.$result.  "<br />\r\n";
    return $result;

}

function write_exif($image, $mie){
    $result = `~/perl5/bin/exiftool -TagsFromFile $mie -all:all $image`;
    //echo 'write exif returns: '.$result.  "<br />\r\n";
    return $result;
}
function get_exif($image){
    $exif = `~/perl5/bin/exiftool $image`;
    return $exif;
}
function get_exif_table($image){
            $exif = `~/perl5/bin/exiftool  -h -g $image`;
            return $exif;
        }
function get_exif_table_test($image){
            $exif = `~/perl5/bin/exiftool -h -a -makernotes:all $image`;
            return $exif;
        }

function get_my_exif($image, $group){
            $exif = `~/perl5/bin/exiftool -h -a -$group:all $image`;
            return $exif;
        }


function get_exif_HG($image){
            $exif = `~/perl5/bin/exiftool -h -G $image`;
            return $exif;
        }
function get_exif_hl($image){
            $exif = `~/perl5/bin/exiftool -h -l $image`;
            return $exif;
        }

function get_exif_php($image){
    $exif = eval('return ' . `~/perl5/bin/exiftool -php $image`);
    // $exif = `~/perl5/bin/exiftool -php $image`;
    return $exif[0];
}

function get_exif_group_headings($image){
    $exif = eval('return ' . `~/perl5/bin/exiftool -php -g $image`);
    return $exif;
}

function get_exif_j($image){
    $exif = `~/perl5/bin/exiftool -j $image`;
    $exif = json_decode($exif, TRUE);
    return $exif[0];
}

function print_array($array, $msg=null, $die=0){
    if($msg !== null){
        echo "<h2>".$msg."</h2><br />\r\n";
    }
    if($die == 0){
        echo '<pre>';
        print_r($array);
        echo "</pre>";
    }else{
        echo '<pre>';
        print_r($array);
        echo "</pre>";
        die();
    }
}

function print_array_var($array, $msg=null, $die=0){
    if($msg !== null){
        echo "<h2>".$msg."</h2><br />\r\n";
    }
    if($die == 0){
        echo "<pre>";
        print_r($array, true);
        echo "</pre>";
    }else{
        echo "<pre>";
        print_r($array, true);
        echo "</pre>";
        die();
    }
}

function getTimestamp()
{
        return date("Y_m_d_H") . substr((string)microtime(), 1, 8);
}

function my_mem_usage(){
    return format_bytes(memory_get_peak_usage());
}

function format_bytes($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

function dirImages($dir)
{
	$d = dir($dir);
	while (false!== ($file = $d->read()))
	{
		$extension = substr($file, strrpos($file, '.'));
		if($extension == ".jpg" || $extension == ".jpeg" || $extension == ".gif"
				|$extension == ".png")
			$images[$file] = $file;
	}
	$d->close();
	return $images;
}

function build_upload_dir($dir){
    $year = date("Y");
    $month = date("m");
    $upload_dir = $dir.$year.'/'.$month.'/';
    $data = array(
        'dir' => $upload_dir,
    );
    if(build_dir_structure($data)){
        return $upload_dir;
    }else{
        return $false;
    }

}
?>
