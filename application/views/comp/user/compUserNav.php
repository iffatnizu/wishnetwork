
<div class="profile-tabs">
    <ul>
        <li><a <?php echo ($pronav == "1") ? 'class="active"' : ""; ?> href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_HOME ?>"><i class="icon-adjust"></i> Activity</a></li>
<!--        <li><a <?php echo ($pronav == "2") ? 'class="active"' : ""; ?> href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_ABOUT ?>"><i class="icon-question-sign"></i> About</a></li>-->
<!--        <li><a <?php echo ($pronav == "3") ? 'class="active"' : ""; ?> href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_PAGES ?>"><i class="icon-paper-clip"></i> pages</a></li>-->
        <li><a <?php echo ($pronav == "4") ? 'class="active"' : ""; ?> href="<?php echo base_url() . SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_POST_WISH ?>"><i class="icon-gift"></i> Post A Wish</a></li>
        <li class="last"><a <?php echo ($pronav == "5") ? 'class="active"' : ""; ?> href="<?php echo base_url() . SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_MANAGE_WISH ?>"><i class="icon-magic"></i> Manage Active Wishes</a></li>
    </ul>
</div>

