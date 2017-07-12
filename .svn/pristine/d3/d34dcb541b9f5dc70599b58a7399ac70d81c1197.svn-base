
<?php
if ($this->session->userdata('_userLogin')) {
    $this->load->view(SiteConfig::COMPONENT_USER_NAV);
}
?>
<?php
if (!empty($wish)) {
    ?>
    <div class="grey-inner-headings" id="grey-content">
        <div class="container">
            <div class="row">
                <div class="span12">
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
                        <?php
                        if ($wish['donateAmount'] != "") {
                            ?>
                            <span class="item">
                                <i class="icon-money"></i>
                                <a href="#" class="link focus">Already Donated : <?php echo $wish['donateAmount'] ?>$ </a>			
                            </span>
                            <?php
                        }
                        ?>
                        <span class="item">
                            <input class="btn btn-default" type="button" value="Goal Amount $<?php echo $wish[DBConfig::TABLE_WISH_ATT_WISH_GOAL_AMOUNT] ?>"/>
                        </span>		
                    </small>
                </div>
            </div><!--/row-->
        </div><!--/container-->
    </div>
    <div style="padding-top: 0px;" id="white-home-blog">
        <div class="container">
            <div class="row">
                <div class="span" style="text-align: left;padding: 10px;">
                    <img src="<?php echo base_url() . 'assets/public/wish/' . $wish[DBConfig::TABLE_WISH_ATT_WISH_PHOTO] ?>" alt="wish"/>
                    <hr/>
                    <?php echo $wish[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION] ?>

                    <div class="well">
                        <a href="<?php echo base_url() . SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_DONATE . encode($wish[DBConfig::TABLE_WISH_ATT_WISH_ID]) ?>" class="btn btn-warning"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" alt="paypal"/>  Donate With Paypal Be A Hero !</a>
                    </div>

                    <?php
                    if (!empty($wish['donate'])) {
                        ?>
                        <div class="well">
                            <h4>All Donation (<?php echo sizeof($wish['donate']) ?>)</h4>

                            <?php
                            foreach ($wish['donate'] as $donated) {
                                ?>
                                <div class="alert alert-success">
                                    <img width="50" src="<?php echo base_url() ?>assets/public/profile/<?php echo $donated['userDetails'][DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC] ?>" alt="post"/>

                                    <a class="btn"><?php echo $donated['userDetails'][DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME] ?> donated $<?php echo $donated[DBConfig::TABLE_WISH_DONATE_ATT_AMOUNT] ?></a> <small><?php echo date("F j Y g:i a", $donated[DBConfig::TABLE_WISH_DONATE_ATT_PAY_TIME]); ?></small><br/>
                                    <?php echo $donated[DBConfig::TABLE_WISH_DONATE_ATT_COMMENTS] ?>

                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="well">
                        <h4>All Comments (<?php echo sizeof($wish['comments']) ?>)</h4>
                        <?php
                        if ($this->session->userdata('_userLogin')) {
                            ?>
                            <textarea class="span11" name="wish-comments"></textarea><br/>
                            <input class="btn btn-info" type="button" name="comments-btn" value="Post" onclick="wishnetwork.sendwishcomment('<?php echo $wish[DBConfig::TABLE_WISH_ATT_WISH_ID]; ?>')"/>
                            <?php
                        }
                        ?>
                    </div>  

                    <div id="ajax-content">
                        <?php
                        //debugPrint($wish['comments']);
                        foreach ($wish['comments'] as $w) {
                            ?>

                            <div id="well-<?php echo $w['details'][DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS_ID] ?>" class="well comment alert alert-info">

                                <img src="<?php echo base_url() ?>assets/public/profile/<?php echo $w['details'][DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC] ?>" alt="post"/>

                                <a href="javascript:;"><?php echo $w['details'][DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME] ?></a>  
                                <?php
                                if ($this->session->userdata('_userID') == $wish[DBConfig::TABLE_WISH_ATT_WISH_USER_ID]) {
                                    ?>
                                    <a href="javascript:;" onclick="deleteComment('<?php echo $w['details'][DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS_ID] ?>',<?php echo $wish[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>)" class="btn btn-small" style="float: right;"><i class="icon-remove-sign"></i> remove</a>
                                    <?php
                                }
                                ?>
                                <p id="<?php echo $w['details'][DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS_ID] ?>"><?php echo $w['details'][DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS] ?></p>
                                <small> <?php echo $w['details']['time']; ?></small>

                                <?php
                                if ($this->session->userdata('_userID') == $w['details'][DBConfig::TABLE_WISH_COMMENTS_ATT_USER_ID]) {
                                    ?>
                                    <a id="a-<?php echo $w['details'][DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS_ID] ?>" onclick="editComments('<?php echo $w['details'][DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS_ID] ?>', '<?php echo $w['details'][DBConfig::TABLE_WISH_COMMENTS_ATT_USER_ID]; ?>')" href="javascript:;"><i class="icon-edit-sign"></i></a>
                                    <?php
                                }
                                ?>

                            </div>

                            <?php
                        }
                        ?>
                    </div>                   
                </div>
            </div>
        </div>

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


