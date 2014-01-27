<!--<div id="share_this" class="grid_4">
<?php
$this->load->helper('sharethis');
echo '<div id="sthoverbuttons" class="sthoverbuttons-pos-left">';
$list = "facebook, twitter, email, gbuzz";
echo sharethis($list);
echo '</div>';
?>
</div>-->
<div class="grid_10 push_3">
<ul>
    <li><a href='/' />Home</a></li>
    <?php if (!$this->ion_auth->logged_in()){
    echo '<li><a href="/auth/login" />Login</a></li>';
    }  else {
        echo '<li><a href="/auth/logout" />Logout</a></li>';
    }

    ?>
    <li><a href="/test" />Test</a></li>
    <li><a href="/exif" />EXIF Viewer</a></li>
    <li><a href="/upload" />Upload</a></li>
    <li><a href="/webcam" />Webcam</a></li>
    <li><a href="/utility" />Util</a></li>
    <li><a href="/email" />Email</a></li>
</ul>

</div>
