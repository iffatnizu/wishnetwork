<h3 class="title"><i class="icon-desktop"></i> User Settings</h3><br clear="all"/>
<span id="titleDes">Profile of <?php echo $this->session->userdata('_userDisplayName') ?></span>
<hr/>
<?php
$this->load->view(SiteConfig::COMPONENT_USER_SETTINGS_NAV);
?>
<div class="grey-inner-headings" id="grey-content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>Profile-user</h2>
            </div>
        </div><!--/row-->
    </div><!--/container-->
</div>
<table class="table">
    <tr>
        <td>First Name</td>
        <td><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME] ?></td>
    </tr>
    <tr>
        <td>Last Name</td>
        <td><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_LAST_NAME] ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $profile[DBConfig::TABLE_USER_ATT_USER_EMAIL_ADDRESS] ?></td>
    </tr>
    <tr>
        <td>Date of Birth</td>
        <td><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_DOB] ?></td>
    </tr>
    <tr>
        <td>Profile Picture</td>
        <td>
            <?php
            if ($profile[DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC] == true) {
                echo '<img src="' . base_url() . 'assets/public/profile/' . $profile[DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC] . '" alt="pro" width="120" height="120"/>';
            } else {
                echo '<img src="' . base_url() . 'assets/public/profile/not-found.jpg" alt="pro" width="120" height="120"/>';
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>Zip Code</td>
        <td><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_ZIP_CODE] ?></td>
    </tr>
    <tr>
        <td>State</td>
        <td>
            <?php
            if (!empty($profile['stateinfo'])) {
                echo $profile['stateinfo'];
            } else {
                echo '<a href="' . base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_EDIT_PROFILE . '">Please set your state</a>';
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>City</td>
        <td>
<?php
if (!empty($profile['cityinfo'])) {
    echo $profile['cityinfo'];
} else {
    echo '<a href="' . base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_EDIT_PROFILE . '">Please set your state</a>';
}
?>
        </td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_ADDRESS] ?></td>
    </tr>
    <tr>
        <td>Phone</td>
        <td><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_PHONE] ?></td>
    </tr>
    <tr>
        <td>Member since</td>
        <td><?php echo date("F j Y g:i a", $profile[DBConfig::TABLE_USER_ATT_USER_REGISTRATION_DATE]) ?></td>
    </tr>
    <tr>
        <td><a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_EDIT_PROFILE ?>" class="btn">Edit Profile Information</a></td>
        <td>&nbsp;</td>
    </tr>
</table>