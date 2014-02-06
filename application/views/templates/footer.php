
<?php
//trigger_error('trigger_error Big Ass Error', E_USER_ERROR);

//echo my_mem_usage()."<br />\n";
$user = $this->ion_auth->get_user();

if(!$this->ion_auth->logged_in()): ?>
<div id="footer_menu" class="grid_8 push_4">
<ul>
    <li><a href='/' >Home</a></li>
    <li><a href="/auth/login" >Login</a></li>
<!--    <li><a href="/auth/create_account" >Create Account</a></li>
    <li><a href="/auth/forgot_password" >Forgot Password</a></li>-->
    <li><a href="/exif" >EXIF Viewer</a></li>
    <li><a href='/webcam' />Webcam</a></li>
    <li><a href='/utility/regex' >Regex</a></li>
    <li><a href="/email" >Email</a></li>
</ul>

<?php elseif($user->id == 6 || $user->id == 11): ?>
    <div id="footer_menu" class="grid_12 push_3">
    <ul class="centered">
    <li><a href='/' />Home</a></li>
    <li><a href="/exif" />EXIF Viewer</a></li>
    <li><a href='/utility/regex' />Regex</a></li>
    <li><a href="/books" />PDF Library</a></li>

    <li><a href="/email" />Email</a></li>

    <li><a href='/auth/logout' />Logout</a></li>

<?php elseif($this->ion_auth->is_admin()): ?>
<div id="footer_menu" class="grid_12 push_1">
<ul class="centered">
    <li><a href='/' />Home</a></li>
    <li><a href="/test" />Test</a></li>
    <li><a href="/exif" />EXIF Viewer</a></li>
    <li><a href='/utility/regex' />Regex</a></li>
    <li><a href='/tal' />Amer. Life</a></li>
    <li><a href='/webcam' />Webcam</a></li>
    <li><a href='/utility' />Utility</a></li>
    <li><a href="/email" />Email</a></li>
    <li><a href="/books" />PDF Library</a></li>
    <li><a href="/books/add_book" />Add Pdf</a></li>
    <li><a href='/utility/misc' />Misc Help</a></li>
    <li><a href="/utility/user_edit" />Edit my info</a></li>
    <li><a href='/auth/change_password' />change password</a></li>
    <li><a href='/iphoneupload/gallery' />Upload App Gallery</a></li>
    <li><a href='/auth' />Users</a></li>
    <li><a href='/auth/logout' />Logout</a></li>
</ul>

    <?php elseif($this->ion_auth->is_group('library')): ?>
    <div id="footer_menu" class="grid_12 push_1">
    <ul class="centered">
    <li><a href='/' />Home</a></li>
    <li><a href="/exif" />EXIF Viewer</a></li>
    <li><a href='/utility/regex' />Regex</a></li>
    <li><a href="/books" />PDF Library</a></li>

    <li><a href="/email" />Email</a></li>
    <li><a href="/utility/user_edit" />Edit my info</a></li>
    <li><a href='/auth/change_password' />change password</a></li>
    <li><a href='/auth/logout' />Logout</a></li>

  <?php elseif($this->ion_auth->logged_in()): ?>
    <div id="footer_menu" class="grid_12 push_2">
    <ul class="centered">
    <li><a href='/' />Home</a></li>
    <li><a href="/exif" />EXIF Viewer</a></li>
    <li><a href='/utility/regex' />Regex</a></li>


    <li><a href="/email" />Email</a></li>
    <li><a href="/utility/user_edit" />Edit my info</a></li>
    <li><a href='/auth/change_password' />change password</a></li>
    <li><a href='/auth/logout' />Logout</a></li>

<?php endif; ?>
</div>