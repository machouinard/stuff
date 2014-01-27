<div class="grid_8 push_4">

<?php
$ver = eval(`const char *GetMagickVersion(size_t *version)`);
//echo 'ImageMagick Version: '.$ver.  "<br />\r\n";



//$array = explode(' ', $result);
//print_array($array);

if(isset($result)){
    if(strpos($result, '<td>') !== false){
    echo $result;
    }else{
        echo 'empty';
    }
}
?>

</div>
<div class="clear"></div>

<?php
$this->load->view('test_view');
?>
