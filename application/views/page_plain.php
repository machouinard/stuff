<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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


	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/960.css">


	<script src="/js/libs/modernizr-2.0.6.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.js"><\/script>')</script>
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

            <div id="title" class="grid_6 push_9">
            <?php
            if(isset($page_title)){
            echo $page_title;
            }
            ?>
            </div>
            <?php
            if(isset($msg)){
                echo "<div id='msg' class='grid_5 pull_6 trash'>".$msg."</div>";
            }
            ?>

	</header>
	<div id="main" role="main">

            <?php
            if(isset($page_heading)){
                echo'<div id="page_heading" class="grid_10 push_3">
	<h2>'.$page_heading.'</h2>
</div>
<div class="clear"></div>';
            }

            $this->load->library('user_agent');
            if(isset($data)){
                $this->load->view($content, $data);
            }else{
                $this->load->view($content);
            }
            ?>

	</div>



	<footer id="footer" class="grid_16">
            <?php  $this->load->view('templates/footer'); ?>
                <!-- Place this tag where you want the +1 button to render -->

	</footer>

</div> <!--! end of #container -->




<!-- scripts concatenated and minified via ant build script-->
<script src="/js/plugins.js"></script>
<script src="/js/script.js"></script>
<!-- end scripts-->

<script>
	var _gaq=[['_setAccount','UA-28691137-1'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
    //below this is fron google plus1
        //removed for now
</script>



<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
	<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]-->

</body>
</html>
