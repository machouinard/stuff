<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/css/style_bak.css">
    <link rel="stylesheet" href="<?php echo $css1; ?>">
    <?php
    echo isset( $script ) ? '<script src="' . $script .'"></script>' : '';
    echo isset( $js1 ) ? '<script src="' . $js1 . '"></script>' : '';
    ?>

</head>
<body>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
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
            if(isset($msg)){
                echo "<div id='msg' class='grid_4 pull_8'>".$msg."</div>";
            }
            if(isset($logo)){
                echo '<div class="grid_2 pull_14"> <img src="'.$logo.'" alt="logo image"/> </div>';
            }

            ?>



        </header>

    <?php
    if(isset($data)){
        $this->load->view($content, $data);
    }else{
        $this->load->view($content);
    }
    ?>
    </div>
</body>
</html>