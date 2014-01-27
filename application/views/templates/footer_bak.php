
<?php if(!$this->ion_auth->logged_in()): ?>
<div id="footer_menu" class="grid_8 push_3">
<ul>
    <li><a href='/' />Home</a></li>
    <li><a href="/auth/login" />Login</a></li>
    <li><a href="/exif" />EXIF Viewer</a></li>
    <li><a href='/utility/regex' />Regex</a></li>
    <li><a href="/email" />Email</a></li>
</ul>
<?php else: ?>
<div id="footer_menu" class="grid_12 push_1">
<ul class="centered">
    <li><a href='/' />Home</a></li>
    <li><a href="/test" />Test</a></li>
    <li><a href="/exif" />EXIF Viewer</a></li>
    <li><a href='/utility/regex' />Regex</a></li>
<!--    <li><a href='/upload' />Upload</a></li>-->
<!--    <li><a href='/webcam' />Webcam</a></li>-->
    <li><a href='/utility' />Utility</a></li>
    <li><a href="/email" />Email</a></li>
    <li><a href="/books" />Library</a></li>
    <li><a href="/books/add" />Add Pdf</a></li>
    <?php if($this->ion_auth->logged_in()): ?>
<!--    <li><a href='/hostgator' />Gator Support</a></li>-->
    <li><a href='/utility/misc' />Misc Help</a></li>
    <?php endif; ?>
    <li><a href='/auth/logout' />Logout</a></li>
</ul>
<?php endif; ?>
</div>