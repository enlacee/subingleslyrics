<!DOCTYPE html>
<!--[if IE 8]> <html lang="es" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="es" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="es"> <!--<![endif]-->
    
<head>
    <title><?php echo $title; ?></title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Extra metadata -->
    <?php echo $metadata; ?>    

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo assets_url('favicon.ico') ?>">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="<?php echo assets_url('plugins/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo assets_url('css/style.css'); ?>">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo assets_url('plugins/line-icons/line-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo assets_url('plugins/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo assets_url('plugins/flexslider/flexslider.css'); ?>">     
    <link rel="stylesheet" href="<?php echo assets_url('plugins/parallax-slider/css/parallax-slider.css'); ?>">

    <!-- CSS Theme -->    
    <link rel="stylesheet" href="<?php echo assets_url('css/themes/default.css'); ?>" id="style_color">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="<?php echo assets_url('css/custom.css'); ?>">
    <?php echo $css; ?>
    
</head>	

<body>
    <?php echo $body; ?>
    <!-- / -->

<!-- JS Global Compulsory -->			
<script type="text/javascript" src="<?php echo assets_url('plugins/jquery-1.10.2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo assets_url('plugins/jquery-migrate-1.2.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo assets_url('plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="<?php echo assets_url('plugins/back-to-top.js'); ?>"></script>
<script type="text/javascript" src="<?php echo assets_url('plugins/flexslider/jquery.flexslider-min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo assets_url('plugins/parallax-slider/js/modernizr.js'); ?>"></script>
<script type="text/javascript" src="<?php echo assets_url('plugins/parallax-slider/js/jquery.cslider.js'); ?>"></script>
<!-- JS Page Level -->           
<script type="text/javascript" src="<?php echo assets_url('js/app.js'); ?>"></script>
<script type="text/javascript" src="<?php echo assets_url('js/pages/index.js'); ?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
      	App.init();
        App.initSliders();
        Index.initParallaxSlider();        
    });
</script>
<!--[if lt IE 9]>
    <script src="<?php echo assets_url('plugins/respond.js'); ?>"></script>
    <script src="<?php echo assets_url('plugins/html5shiv.js'); ?>"></script>    
<![endif]-->

    <!-- Extra javascript -->
    <?php echo $js; ?>
    <!-- Extra javascript Snip -->
    <?php echo $jsnip; ?>

    <?php if ( ! empty($ga_id)): ?><!-- Google Analytics -->
    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','<?php echo $ga_id; ?>');ga('send','pageview');
    </script>
    <?php endif; ?><!-- / -->
</body>
</html>	