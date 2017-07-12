<div id=main role=main>
    <div id=main-content>
        
        <?php
        if ($this->session->userdata('_success')) {
            echo '<div class="alert alert-success">Paypal Status Successfully Changed </div>';
        }
        $session['_success'] = false;
        $this->session->unset_userdata($session);
        ?>
        
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
                                    <td width="20%">Username </td>            
                                    <td width="20%">Paypal Email</td>      
                                    <td width="15%">Status</td>
                                    <td width="15%">Action</td>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //debugPrint($wish);
                                if (!empty($request)) {
                                    foreach ($request as $w) {
                                        ?>
                                        <tr>
                                            <td><?php echo $w['req-by'] ?></td>
                                            <td><?php echo decode($w[DBConfig::TABLE_USER_PAYPAL_ATT_USERNAME]) ?></td>
                                            <td>
                                                <?php
                                                $status = $w[DBConfig::TABLE_USER_PAYPAL_ATT_STATUS];
                                                if ($status == '1') {
                                                    echo '<i style="color:green" class="icon-ok-sign"> Approved</i>';
                                                } else if ($status == '0') {
                                                    echo '<i style="color:blue" class="icon-time"> Pending</i>';
                                                } else if ($status == '2') {
                                                    echo '<i style="color:red" class="icon-remove"> Rejected</i>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn" href="#"><i class="icon-user"></i> Action</a>
                                                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="padding-top: 9px;"><span class="icon-caret-down"></span></a>
                                                    <ul class="dropdown-menu">

                                                        <?php
                                                        if ($status == '1') {
                                                            ?>
                                                        <li><a href="<?php echo base_url().Adminconfig::CONTROLLER_ADMINISTRATOR.Adminconfig::METHOD_ADMINISTRATOR_CHANGE_PAYPAL_STATUS.$w[DBConfig::TABLE_USER_PAYPAL_ATT_ID].'/2' ?>"><i class="icon-ban-circle"></i> Reject</a></li>

                                                            <?php
                                                        } else if ($status == '0') {
                                                            ?>
                                                            <li><a href="<?php echo base_url().Adminconfig::CONTROLLER_ADMINISTRATOR.Adminconfig::METHOD_ADMINISTRATOR_CHANGE_PAYPAL_STATUS.$w[DBConfig::TABLE_USER_PAYPAL_ATT_ID].'/1' ?>"><i class="icon-pencil"></i> Approve</a></li>
                                                            <li><a href="<?php echo base_url().Adminconfig::CONTROLLER_ADMINISTRATOR.Adminconfig::METHOD_ADMINISTRATOR_CHANGE_PAYPAL_STATUS.$w[DBConfig::TABLE_USER_PAYPAL_ATT_ID].'/2' ?>"><i class="icon-trash"></i> Reject</a></li>
                                                            <?php
                                                        } else if ($status == '2') {
                                                            ?>
                                                            <li><a href="<?php echo base_url().Adminconfig::CONTROLLER_ADMINISTRATOR.Adminconfig::METHOD_ADMINISTRATOR_CHANGE_PAYPAL_STATUS.$w[DBConfig::TABLE_USER_PAYPAL_ATT_ID].'/1' ?>"><i class="icon-pencil"></i> Approve</a></li>
                                                                <?php
                                                            }
                                                            ?>
                                                    </ul>
                                                </div>
                                            </td>
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
