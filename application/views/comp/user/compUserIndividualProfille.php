<h3 class="title"><i class="icon-desktop"></i> User Public Profile</h3><br clear="all"/>
<?php
if (!empty($profile)) {
    ?>

    <?php
    if ($this->session->userdata('_userID') != decode($this->uri->segment(3))) {
        ?>
        <!-- Modal -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel"><i class="icon-envelope"></i> Write Message</h3>
            </div>
            <div class="modal-body">
                <form class="form-signin" onsubmit="return sendMessage('<?php echo $this->uri->segment(3) ?>')">

                    <div class="msgresult"></div>

                    <textarea name="msgBox" style="width: 514px; height: 200px;"></textarea>
                    <button class="btn btn-info" type="submit">Send</button><br class="clear"/>
                    <p></p>
                </form>
            </div>

        </div>
        <?php
    }
    ?>



    <span id="titleDes">Profile of <?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME] ?></span>
    <hr/>
    <div id="white-content">
        <div class="row" style="padding: 20px;">



            <div class="span3">
                <h3><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME] ?>'s Profile</h3>

                <?php
                if ($this->session->userdata('_userID') != decode($this->uri->segment(3))) {
                    ?>
                    <span><a href="#myModal" role="button" class="btn btn-info" data-toggle="modal">Send Message</a></span>
                    <?php
                }
                ?>

                <hr/>
                <?php
                if ($profile[DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC] == true) {
                    echo '<img src="' . base_url() . 'assets/public/profile/' . $profile[DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC] . '" alt="pro" width="220" height="230"/>';
                } else {
                    echo '<img src="' . base_url() . 'assets/public/profile/not-found.jpg" alt="pro" width="120" height="120"/>';
                }
                ?>
                <span class="label label-info">Comments : <?php echo $stat['allComments'] ?></span>
                <span class="label label-info">Wish : <?php echo $stat['allWish'] ?></span>
                <span class="label label-info">Member since : <?php echo $stat['memberSince'] ?></span>

            </div>
            <div class="span8">
                <?php
                //debugPrint($feed);
                foreach ($feed as $w) {
                    ?>

                    <div class="well comment alert alert-success">

                        <span class="focus"><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME] ?> </span>
                        <?php echo $w['txt'] ?> 
                        <?php
                        if ($w['type'] == 'comment') {
                            echo '<a class="focus" href="' . base_url() . SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_DETAILS_WISH . $w[DBConfig::TABLE_WISH_ATT_WISH_ID] . '">' . getWishTitle($w['wishId']) . '</a>';
                        }
                        ?> 
                        <p>
                        <blockquote>
                            <a style="color: #333;" href="<?php echo base_url() . SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_DETAILS_WISH . $w[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>"><i><?php echo ucfirst($w['title']) ?></i></a>
                        </blockquote>
                        </p>
                        <small class="date"><?php echo $w['date'] ?></small>

                    </div>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>
    <?php
} else {
    ?>
    <span id="titleDes">Profile not found</span>
    <hr/>
    <?php
}
?>