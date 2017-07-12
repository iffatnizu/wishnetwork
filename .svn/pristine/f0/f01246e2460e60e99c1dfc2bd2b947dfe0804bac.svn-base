
<?php
if ($this->session->userdata('_userLogin')) {
    $this->load->view(SiteConfig::COMPONENT_USER_NAV);
}
?>
<?php
//debugPrint($wish);

if (!empty($wish)) {
    ?>

    <div class="grey-inner-headings" id="grey-content">
        <div class="container">
            <div class="row">
                <?php
                if ($this->session->userdata('success')) {
                    ?>
                    <div class="alert alert-success">
                        <i class="icon-ok-sign"></i> Donate Successfully Completed
                    </div>
                    <?php
                }
                $sess['success'] = FALSE;
                $this->session->unset_userdata($sess);
                ?>

                <div class="span6">
                    <h3><i class="icon-magic"></i> <?php echo $wish[DBConfig::TABLE_WISH_ATT_WISH_TITLE] ?></h3>
                    <small>
                        <!-- poster -->
                        <span class="item">
                            <i class="icon-user"></i>
                            <a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_DETAILS . encode($wish[DBConfig::TABLE_WISH_ATT_WISH_USER_ID]) ?>" class="link itm-txt focus"><?php echo $wish['username']; ?></a>			
                        </span>
                        <span class="item">
                            <i class="icon-time"></i>
                            <span class="itm-txt"><?php echo $wish['time']; ?></span>
                        </span>
                        <span class="item">
                            <i class="icon-signal"></i>
                            <a href="#" class="link"><?php echo $wish['city'] ?>, <?php echo $wish['state'] ?></a>			
                        </span>
    <!--                    <span class="item">
                            <i class="icon-move"></i>
                            <a href="#" class="link itm-txt">More Information</a>
                        </span>		-->
                    </small>
                    <br class="clear"/>
                    <img width="200" src="<?php echo base_url() . 'assets/public/wish/' . $wish[DBConfig::TABLE_WISH_ATT_WISH_PHOTO] ?>" alt="wish"/>
                </div>
                <div class="span6">
                    <h3 style="color: #96007C"><i class="icon-heart"></i> Make Donation. Support Them</h3>

                    <?php
                    if ($paypalInfo[DBConfig::TABLE_USER_PAYPAL_ATT_STATUS] == '1') {
                        ?>
                        <form action="<?php echo current_url() ?>" method="POST">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Donate Amount (USD)</td>
                                    <td>
                                        <input type="text" name="donate-amount" placeholder="Amount"/>$
                                        <?php echo form_error('donate-amount'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Simple Wish</td>
                                    <td>
                                        <textarea placeholder="Simple Wish" style="width: 340px; height: 81px;" name="simple-wish"></textarea>
                                        <?php echo form_error('simple-wish'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input class="btn btn-danger" type="submit" name="submit" value="Pay with paypal"/></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                    } else {
                        echo 'This user not a payment verified user.please come back later!';
                    }
                    ?>
                </div>
            </div><!--/row-->
        </div><!--/container-->
    </div>

    <!--/container--> 
    </div>

    <?php
} else {
    ?>
    <div style="padding-top: 0px;" id="white-home-blog">
        <div class="container">
            <div class="row">
                <div class="span9" style="text-align: left;padding: 10px;">

                    <?php echo '<h2><i class="icon-remove-sign"></i>Requested content could not be found</h2>' ?>
                </div>
            </div>
        </div>
        <!--/container--> 
    </div>
    <?php
}
?>


