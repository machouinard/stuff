<div class="grid_16">

<?php

if(isset($exif)){
    if(is_array($exif)){
        print_array($exif);
    }else{
        echo $exif;
    }
}


/// I CHANGED THIS FROM ERROR TO ERRORS DUE TO ERROR SETTING FOR CSS IN MSG DIV
if(isset($errors)){
    echo "<div class='grid_8 push_4'>";
    if(is_array($errors)){
        print_array($errors);
    }else{
        echo "<h2>$errors</h2>";
    }
    echo "</div>";
}

if(isset($info)){
    //echo '<div class="grid_16">';
    if(is_array($info)){
        print_array($info, $info_title);
    }else{
        echo '<h2>'.$info_title.'</h2><br />'.$info.  "<br />\r\n";
    }
    echo '<hr class="divider">';
    //echo '</div>';

}

if(isset($result)){
    echo '<div class="grid_8 push_4">';
    if(is_array($result)){
        print_array($result, $result_title);
    }else{
        echo $result_title.':<br > '.$result.  "<br />\r\n";
    }
    echo '</div>';
}
if(isset($extra)){
    echo '<div id="extra" class="grid_8 push_4">';
    if(is_array($extra)){
        print_array($extra, $extra_title);
    }else{
        echo $extra_title.':<br />'.$extra.  "<br />\r\n";
    }
    echo '</div>';
}



if(isset($data) && $display == 1){
    echo '<div class="grid_16">';
    print_array($data, 'Data being fed to result.php');
    echo '</div>';
}

if(isset($more)){
    echo '<div class="clear"></div>';
    $this->load->view($more);
}


?>
</div>