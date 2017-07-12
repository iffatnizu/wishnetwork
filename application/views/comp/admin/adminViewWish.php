<div id=main role=main>
    <div id=main-content>
        <h1><?php echo $title ?> </h1>

        <?php
        if ($this->session->userdata('_success')) {
            echo '<div class="alert alert-success">Operation successfully completed!</div>';
        }
        $session['_success'] = false;
        $this->session->unset_userdata($session);
        ?>

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
                                    <td width="20%">Name</td>            
                                    <td width="20%">User</td>      
                                    <td width="15%">View</td>
                                    <td width="15%">Status</td>
                                    <td width="15%">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //debugPrint($wish);
                                if (!empty($wish)) {
                                    foreach ($wish as $w) {
                                        ?>
                                        <tr>
                                            <td><?php echo $w[DBConfig::TABLE_WISH_ATT_WISH_TITLE] ?></td>
                                            <td><?php echo $w['username'] ?></td>
                                            <td><a href="<?php echo base_url() . Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_WISH_DETAILS . $w[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>" class="btn btn-small btn-info">View</a></td>
                                            <td>
                                                <?php
                                                $status = $w[DBConfig::TABLE_WISH_ATT_WISH_STATUS];
                                                if ($status == '1') {
                                                    echo '<i style="color:green" class="icon-ok-sign"> Approved</i>';
                                                } else if ($status == '0') {
                                                    echo '<i style="color:red" class="icon-remove-sign"> Banned</i>';
                                                } else if ($status == '2') {
                                                    echo '<i style="color:blue" class="icon-beaker"> Pending</i>';
                                                } else if ($status == '3') {
                                                    echo '<i style="color:#FB7922" class="icon-eye-close"> Timedout</i>';
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
                                                            <li><a href="<?php echo base_url() . Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_WISH_BANNED . $w[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>"><i class="icon-ban-circle"></i> Banned</a></li>
                                                            <li><a href="<?php echo base_url() . Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_WISH_DELETE . $w[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>"><i class="icon-trash"></i> Delete</a></li>
                                                            <?php
                                                        } else if ($status == '0') {
                                                            ?>
                                                            <li><a href="<?php echo base_url() . Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_WISH_APPROVED . $w[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>"><i class="icon-pencil"></i> Approved</a></li>
                                                            <li><a href="<?php echo base_url() . Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_WISH_DELETE . $w[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>"><i class="icon-trash"></i> Delete</a></li>
                                                            <?php
                                                        } else if ($status == '2') {
                                                            ?>
                                                            <li><a href="<?php echo base_url() . Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_WISH_APPROVED . $w[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>"><i class="icon-pencil"></i> Approved</a></li>
                                                            <li><a href="<?php echo base_url() . Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_WISH_BANNED . $w[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>"><i class="icon-pencil"></i> Banned</a></li>
                                                            <li><a href="<?php echo base_url() . Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_WISH_DELETE . $w[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>"><i class="icon-trash"></i> Delete</a></li>
                                                            <?php
                                                        } else if ($status == '3') {
                                                            ?>
                                                            <li><a href="<?php echo base_url() . Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_WISH_DELETE . $w[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>"><i class="icon-trash"></i> Delete</a></li>
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
