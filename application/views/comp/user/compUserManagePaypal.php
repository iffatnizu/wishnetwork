<div class="mLeftContainer">
    <div class="recentActivity">
        <div class="arrow">&nbsp;</div>                       
        <h3 class="title" style="margin-top: -12px;"><i class="icon-edit-sign"></i> Manage Paypal</h3><br clear="all"/>
        <span id="titleDes">Manage paypal Info</span>
        <hr/>

        <?php
        $this->load->view(SiteConfig::COMPONENT_USER_SETTINGS_NAV);
        ?>

        <div class="grey-inner-headings" id="grey-content">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <h2>Manage Paypal Info</h2>
                    </div>
                </div><!--/row-->
            </div><!--/container-->
        </div>

        <?php
        if ($this->session->userdata('successMsg')) {
            ?>
            <div class="alert alert-success">
                Paypal info successfully updated
            </div>
            <?php
        }
        $s['successMsg'] = FALSE;
        $this->session->unset_userdata($s);
        ?>



        <form id="registration" enctype="multipart/form-data" action="<?php echo current_url() ?>" method="POST" autocomplete="off">
            <table style="width: 100%;">
                <tr>
                    <td style="width:180px;">Paypal Username</td>
                    <td><input type="text" name="paypal-username" placeholder="Paypal Username" value="<?php echo decode($paypalinfo[DBConfig::TABLE_USER_PAYPAL_ATT_USERNAME]) ?>"/></td>
                    <td><span class="required"><?php echo form_error('paypal-username') ?></span></td>
                </tr>
                <tr>
                    <td>Paypal Password</td>
                    <td><input type="text" name="paypal-password" placeholder="Paypal Password" value="<?php echo decode($paypalinfo[DBConfig::TABLE_USER_PAYPAL_ATT_PASSWORD]) ?>"/></td>
                    <td><span class="required"><?php echo form_error('paypal-password') ?></span></td>
                </tr>
                <tr>
                    <td>Paypal Signature</td>
                    <td><textarea style="width: 312px; height: 84px;" name="paypal-signature" placeholder="Paypal Signature"><?php echo decode($paypalinfo[DBConfig::TABLE_USER_PAYPAL_ATT_SIGNATURE]) ?></textarea></td>
                    <td><span class="required"><?php echo form_error('paypal-signature') ?></span></td>
                </tr>
                <?php
                if (!empty($paypalinfo)) {
                    ?>
                    <tr>
                        <td>Verification Status</td>
                        <td>
                            <?php
                            if ($paypalinfo[DBConfig::TABLE_USER_PAYPAL_ATT_STATUS] == '0') {
                                echo '<i style="color:#F60808" class="icon-remove-sign"> Pending....</i>';
                            } 
                            elseif ($paypalinfo[DBConfig::TABLE_USER_PAYPAL_ATT_STATUS] == '1')  {
                                echo '<i style="color:green" class="icon-ok-sign"> Verified</i> ';
                            }
                            elseif ($paypalinfo[DBConfig::TABLE_USER_PAYPAL_ATT_STATUS] == '2')  {
                                echo '<i style="color:red" class="icon-ok-sign"> Rejected</i> ';
                            }
                            ?>
                        </td>
                    </tr>
    <?php
}
?>                
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input class="btn btn-info" type="submit" name="submit" value="Update"/>
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
