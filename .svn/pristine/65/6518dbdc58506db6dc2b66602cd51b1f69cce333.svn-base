</div>
<!--/container--> 
</div>

<div id="white-home-blog" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            <div class="span12 column-divider" style="margin-bottom: 5px;"> 
                <span class="column-divider-icon pull-left home-icon-fix"><i class="icon-bookmark"></i></span>
                <h4 id="w">Best wishes</h4>

                <div class="filter">
                    <a href="#" class="btn" data-filter="popular" tabindex="-1">Popular</a> 
                    <a href="#" class="btn active2" data-filter="recent" tabindex="-1">Recent</a>
                    <a href="#" class="btn" data-filter="completed" tabindex="-1">Completed </a>
                </div>
            </div>
            <!--/row9--> 
        </div>


        <script type="text/javascript">
            $(document).ready(function() {

                setTimeout(function() {
                    $('#list').trigger("click")
                }, 10)

                $('#list').click(function() {
                    $('#products .item div.wish-desh').css({
                        "display": "block"
                    })
                    $('#products .item').addClass('list-group-item');
                });
                $('#grid').click(function() {
                    $('#products .item div.wish-desh').css({
                        "display": "none"
                    })
                    $('#products .item').removeClass('list-group-item');
                });
            })

        </script>

        <div class="container">

            <div class="btn-group" style="float: left;margin-bottom: 10px;">
                <a href="javascript:;" id="list" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-th-list"></span>&nbsp;List</a>
                <a href="javascript:;" id="grid" class="btn btn-inverse btn-sm"><span class="glyphicon glyphicon-th"></span>&nbsp;Grid</a>
            </div>
            <br class="clear"/>
            <div id="products" class="row list-group">
                <?php
                foreach ($wishes as $wish) {
                    ?>
                    <div class="item span3">
                        <a href="<?php echo base_url() . SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_DETAILS_WISH . $wish[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>"><img class="group list-group-image" src="<?php echo base_url() . 'assets/public/wish/' . $wish[DBConfig::TABLE_WISH_ATT_WISH_PHOTO] ?>"></a>
                        <h4 class="group inner list-group-item-heading"><a href="<?php echo base_url() . SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_DETAILS_WISH . $wish[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>"><?php echo $wish[DBConfig::TABLE_WISH_ATT_WISH_TITLE] ?></a></h4>
                        <div class="wish-desh" style="display: none;">
                            <?php echo $wish[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION] ?>
                            <div class="wish-info">
                                <div><a href="<?php echo base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_DETAILS . encode($wish[DBConfig::TABLE_WISH_ATT_WISH_USER_ID]) ?>" class="link itm-txt focus"><i class="icon-user"></i> <?php echo $wish['username']; ?></a>	</div>
                                <div><i class="icon-time"></i> <?php echo $wish['time']; ?></div>
                                <div><a href="#" class="link"><i class="icon-signal"></i> <?php echo $wish['city'] ?>, <?php echo $wish['state'] ?></a>	</div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div><!--/.container-->

    </div>
</div>


<!--/row--> 