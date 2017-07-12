<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?> | Wishnetwork</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/css/main.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/css/prettify.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
        <script type="text/javascript" src="<?php echo base_url() ?>scripts/core/jquery.js"></script>
        <script type="text/javascript">
            var base_url = '<?php echo base_url() ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url(); ?>scripts/core/jquery-ui.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet"/>
        <script type="text/javascript" src="<?php echo base_url() ?>scripts/site/main.js"></script>
    </head>

    <body data-spy="scroll" data-target=".bs-docs-sidebar">

        <?php
        if (isset($_top)) {
            echo $_top;
        }
        ?>

        <?php
        if (isset($_navigation)) {
            echo $_navigation;
        }
        ?>



        <?php
        if (isset($_slider)) {
            ?>
            <div id="mask">
                <?php echo $_slider;
                ?>           

            </div>
            <?php
        }
        ?>
        <!--/orange hero-->
        <div id="grey-content" class="greyhome">
            <div class="container">
                <?php
                if (isset($_content)) {
                    echo $_content;
                }
                ?>
            </div>
            <!--/container--> 
        </div>
        <!--/white-home-blog-->

        <?php
        if (isset($_footer)) {
            echo $_footer;
        }
        ?>
        <!--/footer bottom--> 

        <!-- Le javascript
            ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 

        <script src="<?php echo base_url() ?>scripts/site/prettify.js"></script> 
        <script src="<?php echo base_url() ?>scripts/core/bootstrap.js"></script> 
        <script src="<?php echo base_url() ?>scripts/site/application.js"></script>
    </body>
</html>
