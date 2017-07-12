<h3 class="title"><i class="icon-desktop"></i> User Details</h3><br clear="all"/>
<span id="titleDes">Profile of <?php echo $this->session->userdata('_userDisplayName') ?></span>
<hr/>
<?php
$this->load->view(SiteConfig::COMPONENT_USER_NAV);
//debugPrint($activity);
?>
<div class="grey-inner-headings" id="grey-content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>Activity-user</h2>
            </div>
        </div><!--/row-->
    </div><!--/container-->
</div>

<div id="white-content">
    <div class="row" style="padding: 20px;">



        <div class="span3">
            <h3><?php echo $profile[DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME] ?>'s Profile</h3>
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
                        echo '<a class="focus" href="#">' . getWishTitle($w['wishId']) . '</a>';
                    }
                    ?> 
                    <p>
                    <blockquote>
                        <a style="color: #333;" href="#"><i><?php echo ucfirst($w['title']) ?></i></a>
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