
<div class="profile-tabs" style="margin-bottom: 15px;">
    <ul>
        <li><a <?php echo ($setnav == "7") ? 'class="active"' : ""; ?> href="<?php echo base_url(); ?>#w"><i class="icon-home"></i> Home</a></li>
        <li><a <?php echo ($setnav == "1") ? 'class="active"' : ""; ?> href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SETTINGS ?>"><i class="icon-h-sign"></i> General</a></li>
        <li><a <?php echo ($setnav == "5") ? 'class="active"' : ""; ?> href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_CHANGE_PASSWORD ?>"><i class="icon-edit-sign"></i> Change Password</a></li>
        <li><a <?php echo ($setnav == "6") ? 'class="active"' : ""; ?> href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_BIO ?>"><i class="icon-edit"></i> Bio</a></li>
        <li><a <?php echo ($setnav == "2") ? 'class="active"' : ""; ?> href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_PAYPAL ?>"><i class="icon-lock"></i> Paypal Info</a></li>
        <li><a <?php echo ($setnav == "3") ? 'class="active"' : ""; ?> href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_TRANSACTION_HISTORY ?>"><i class="icon-money"></i> Transaction History</a></li>
 <!--   <li><a <?php echo ($setnav == "4") ? 'class="active"' : ""; ?> href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_NOTIFICATION ?>"><i class="icon-bullhorn"></i> Notification</a></li>-->

    </ul>
</div>