<div id=main role=main>
    <div id=main-content>
        <h1><?php echo $title ?> </h1>

        <div class=grid_12>
            <div class=block-border>
                <div class=block-content>

                    <link href="<?php echo base_url() ?>scripts/plugins/datatable/css/demo_table_jui.css" rel="stylesheet" type="text/css"/>
                    <link href="<?php echo base_url() ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css"/>

                    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>scripts/plugins/datatable/js/jquery.js"></script>
                    <script type="text/javascript" language="javascript" src="<?php echo base_url() ?>scripts/plugins/datatable/js/jquery.dataTables.js"></script>
                    <script type="text/javascript" charset="utf-8">
                        $(document).ready(function() {
                            var oTable = $('#example').dataTable({
                                "bJQueryUI": true,
                                "sPaginationType": "full_numbers"

                            });
                        });
                    </script>
                    <style>
                        .ui-icon{
                            float: right;
                            margin-top: 4px;
                        }
                        .dataTables_info{
                            font-size: small;
                        }
                    </style>
                    <div class="well">
                        <table cellpadding="0" cellspacing="0" border="0" class="table" id="example" style="width: 100%">
                            <thead>
                                <tr>
                                    <td width="20%">Wish </td>            
                                    <td width="20%">Amount</td>      
                                    <td width="15%">Paid By</td>
                                    <td width="15%">Token</td>
                                    <td width="15%">Payer ID</td>
                                    <td width="15%">Reference ID</td>
                                    <td width="15%">Time</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //debugPrint($wish);
                                if (!empty($transaction)) {
                                    foreach ($transaction as $w) {
                                        ?>
                                        <tr>
                                            <td><a href="<?php echo base_url() . Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_WISH_DETAILS . $w[DBConfig::TABLE_WISH_DONATE_ATT_WISH_ID] ?>" ><?php echo $w['title'] ?></a></td>
                                            <td><?php echo $w[DBConfig::TABLE_WISH_DONATE_ATT_AMOUNT] ?></td>
                                            <td><?php echo $w['paid-by'];?></td>
                                            <td><?php echo $w[DBConfig::TABLE_WISH_DONATE_ATT_TOKEN];?></td>
                                            <td><?php echo $w[DBConfig::TABLE_WISH_DONATE_ATT_PAYER_ID];?></td>
                                            <td><?php echo $w[DBConfig::TABLE_WISH_DONATE_ATT_GETEWAY_REFERENCE];?></td>
                                            <td><?php echo date("F j, Y, g:i a",$w[DBConfig::TABLE_WISH_DONATE_ATT_PAY_TIME]);?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
