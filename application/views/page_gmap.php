<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// Google Maps API Key  AIzaSyBzcpy3cp1iGCTWnjgY3O0oRHcwrUccDGA
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo $title ?></title>
	<meta name="description" content="Computer Science Experiments.  Fun with PHP, MySQL, Javascript, HTML, CSS & More!">
	<meta name="author" content="Henry's Dad">

	<meta name="viewport" content="width=device-width,initial-scale=1">

<!--        <link rel="shortcut icon" href="/images/favicon.ico">   -->
    <link rel="icon" type="image/png" href="images/ess.png"/>
	<link rel="stylesheet" href="/css/style_bak.css">


        <script src="/js/libs/modernizr-2.0.6.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.js"><\/script>')</script>

        <?php
        if(isset($map['js'])){
            echo $map['js'];
        }
        ?>

        <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-28870365-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

        </script>
</head>
<body>

<div id="container" class="container_16">
	<header id="header" class="grid_16">

            <div id="title" class="grid_8 push_7">
            <?php
            if(isset($page_title)){
            echo $page_title;
            }
            ?>
            </div>
            <?php
            if(isset($short_exif)){
                echo '<div id="top_exif" class="grid_8 push_8">'.$short_exif.'</div>';
            }
            ?>
            <?php
            if(isset($msg)){
                echo "<div id='msg' class='grid_4 pull_8'>".$msg."</div>";
            }
            if(isset($histo)){
                echo "<div id='histo' class='grid_3 pull_9'>".$histo."</div>";
            }
            ?>



	</header>
	<div id="main" role="main">

            <?php
            if(isset($map['html'])){
                $html = $map['html'];
                $data['html'] = $html;
            }
            if(isset($map['markers'])){
                $markers = $map['markers'];
                $data['markers'] = $markers;
            }

            if(isset($page_heading)){
                echo'<div id="page_heading" class="grid_10 push_3">
	<h2>'.$page_heading.'</h2>
</div>
<div class="clear"></div>';
            }


            if(isset($data)){
                $this->load->view($content, $data);
            }else{
                $this->load->view($content);
            }
            echo '<div class="clear"></div>';

            ?>

	</div>
<div class="clear"></div>
<div id="large_img" class="grid_10 push_3"></div>


	<footer id="footer" class="grid_16">
            <?php
            if($this->ion_auth->logged_in()){
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/footer_guest');
            }
            ?>
    </footer>

</div> <!--! end of #container -->

<!-- scripts concatenated and minified via ant build script-->
<script src="/js/plugins.js"></script>
<script src="/js/script.js"></script>
<!-- end scripts-->

<?php
if(isset($error)){
    echo '<script type="text/javascript">'
    , 'msg_error();'
            , '</script>';
}
?>
<script>
$('#title').click(function(){
    hide_footer();
})
</script>
<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
	<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]-->

</body>
</html>
