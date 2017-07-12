<div id=main role=main>
    <div id=main-content>
        <h1><?php echo $title ?> </h1>


        <div class=grid_12>
            <div class=block-border>
                <div class=block-content>
                    <div class="well">
                        <h3><?php echo $wish[DBConfig::TABLE_WISH_ATT_WISH_TITLE] ?></h3>
                        <small>
                            <!-- poster -->
                            <span class="item">
                                <i class="icon-user"></i>
                                <a href="#" class="link itm-txt"><?php echo $wish['username']; ?></a>			
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

                        <img src="<?php echo base_url() . 'assets/public/wish/' . $wish[DBConfig::TABLE_WISH_ATT_WISH_PHOTO] ?>" alt="wish"/>
                        <hr/>
                        <?php echo $wish[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION] ?>
                        
                         <h4>All Comments (<?php echo sizeof($wish['comments']) ?>)</h4>
                         
                         <?php
                        foreach ($wish['comments'] as $w) {
                            ?>

                            <div class="well comment alert alert-info">

                                <img style="float: left;margin-right: 10px;" width="50" height="50" src="<?php echo base_url() ?>assets/public/profile/<?php echo $w['details'][DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC] ?>" alt="post"/>

                                <a href="javascript:;"><?php echo $w['details'][DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME] ?></a>  
                                <p style="font-size: 12px;"><?php echo $w['details'][DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS] ?></p>
                                <small style="font-size: 10px;"> <?php echo $w['details']['time']; ?></small>

                            </div>

                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

