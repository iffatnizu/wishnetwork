<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="logo pull-left" href="<?php echo base_url() ?>">WISH<br/>NETWORK</a>
<!--            <a class="brand pull-left" href="index.html"><img src="assets/img/logo.png" alt="Smoothie" width="166" height="22" /></a>-->
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <li <?php echo ($nav=="1")?'class="active"':""; ?>> <a href="<?php echo base_url() ?>"><i class="icon-home"></i> HOME</a> </li>
<!--                    <li <?php echo ($nav=="2")?'class="active"':""; ?>> <a href="#"><i class="icon-question-sign"></i> ABOUT</a> </li>-->
                    <li <?php echo ($nav=="-1")?'class="active"':""; ?>> <a href="<?php echo base_url() ?>forum/"><i class="icon-user"></i> FORUM</a> </li>
                    <li <?php echo ($nav=="3")?'class="active"':""; ?>> <a style="color: #FB7922;" href="<?php echo base_url().SiteConfig::CONTROLLER_WISH.SiteConfig::METHOD_WISH_POST_WISH ?>"><i class="icon-pencil"></i> POST A WISH</a> </li>                                                       
                    <li <?php echo ($nav=="4")?'class="active"':""; ?>> <a href="<?php echo base_url().SiteConfig::CONTROLLER_CONTACT ?>"><i class="icon-envelope"></i> CONTACT</a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>