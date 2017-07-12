<div class="mLeftContainer">
    <div class="recentActivity">
        <div class="arrow">&nbsp;</div>                       
        <h3 class="title" style="margin-top: -12px;"><i class="icon-money"></i> Transaction History</h3><br clear="all"/>
        <span id="titleDes">Transaction History</span>
        <hr/>

        <?php
        $this->load->view(SiteConfig::COMPONENT_USER_SETTINGS_NAV);
        //debugPrint($history);
        ?>

        <div class="grey-inner-headings" id="grey-content">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <h2>Transaction History</h2>
                    </div>
                </div><!--/row-->
            </div><!--/container-->
        </div>

        <div class="well">
            <table class="table table-striped">
                <thead>
                    <tr style="background: #ddd;">
                        <td>Wish</td>
                        <td>Amount</td>
                        <td>Token</td>
                        <td>Payer ID</td>
                        <td>Reference ID</td>
                        <td>Time</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($history)) {
                        foreach ($history as $h) {
                            ?>
                            <tr>
                                <td><a class="focus" style="font-weight: normal" href="<?php echo base_url().SiteConfig::CONTROLLER_WISH.SiteConfig::METHOD_WISH_DETAILS_WISH.$h[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>"><?php echo $h['title'] ?></a></td>
                                <td><?php echo $h[DBConfig::TABLE_WISH_DONATE_ATT_AMOUNT] ?>$</td>
                                <td><?php echo $h[DBConfig::TABLE_WISH_DONATE_ATT_TOKEN] ?></td>
                                <td><?php echo $h[DBConfig::TABLE_WISH_DONATE_ATT_PAYER_ID] ?></td>
                                <td><?php echo $h[DBConfig::TABLE_WISH_DONATE_ATT_GETEWAY_REFERENCE] ?></td>
                                <td><?php echo date("F j Y g:i a",$h[DBConfig::TABLE_WISH_DONATE_ATT_PAY_TIME]) ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>



    </div>
</div>
