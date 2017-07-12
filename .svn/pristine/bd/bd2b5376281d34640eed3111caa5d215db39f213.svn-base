<div id="social-top">
    <div class="container">
        <ul>

            <?php
            if ($this->session->userdata('_userLogin')) {
                ?>
                <li><a class="login" href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SETTINGS; ?>"><i class="icon-cog"></i> WELCOME <?php echo strtoupper($this->session->userdata('_userDisplayName')); ?></a></li>
                <li>
                    <a data-toggle="dropdown" class="login" href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_DASHBOARD; ?>"><i class="icon-cog"></i> SETTINGS</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_HOME; ?>">Profile</a></li>
                        <li><a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SETTINGS; ?>">Settings</a></li>
<!--                        <li><a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_ACTIVE_WISH; ?>">Active Wish</a></li>-->
                        
                    </ul>
                </li>
                <li><a class="login" href="<?php echo base_url() . SiteConfig::CONTROLLER_MESSAGES; ?>"><i class="icon-envelope"></i> MESSAGES</a></li>
                <li><a class="join" href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGOUT; ?>"><i class="icon-lock"></i> LOGOUT</a></li>
                <?php
            } else {
                ?>
                <li><a class="login" href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN; ?>"><i class="icon-unlock"></i> LOGIN</a></li>
                <li><a class="join" href="<?php echo base_url() . SiteConfig::CONTROLLER_USER; ?>"><i class="icon-forward"></i> JOIN NOW</a></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <!--/container--> 
</div>




