<div class="grid_16">
<?php
//$dir = 'images/test/writing/2012/03/';
//$dir = 'images/2012/03/';
$dir = 'images/sample/';

$contents = get_filenames($dir);
if($images = get_dir_file_info($dir)){
$pics = array();
foreach($images as $image){
    $img_src = base_url(). $image['relative_path'].$image['name'];
   $img = "<img src='{$img_src}' width='285' >";

   array_push($pics, $img);
}
$album = $this->table->make_columns($pics, 3);
echo $this->table->generate($album);
}else{
    echo "<h2>There are no images in $dir</h2>";
}
?>
</div>
