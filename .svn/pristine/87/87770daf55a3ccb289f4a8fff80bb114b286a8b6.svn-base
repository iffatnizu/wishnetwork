<h3 class="title"><i class="icon-desktop"></i> User Settings</h3><br clear="all"/>
<span id="titleDes">Profile of <?php echo $this->session->userdata('_userDisplayName') ?></span>
<hr/>
<?php
$this->load->view(SiteConfig::COMPONENT_USER_SETTINGS_NAV);

//debugPrint($profile);

?>
<div class="grey-inner-headings" id="grey-content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>Change bio</h2>
            </div>
        </div><!--/row-->
    </div><!--/container-->
</div>
<div id="ajax-content">

</div>
<table style="width: 100%;">
    <tr>
        <td>
            <div style="padding: 10px;min-height: 80px;border:1px solid #ddd;" id="user-bio" contenteditable="true" onmouseover="wishnetwork.border()">

                &nbsp; <?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_ABOUT] ?>

            </div> 
        </td>
    </tr>
    <tr>
        <td><a class="btn" href="javascript:;" onclick="wishnetwork.updateBio()">Update bio</a></td>
    </tr>


</table>