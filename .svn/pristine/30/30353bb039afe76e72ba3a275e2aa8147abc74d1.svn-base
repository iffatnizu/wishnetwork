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
                        <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                            <thead>
                                <tr>

                                    <td width="20%">Page Name</td>
                                    <td width="20%">Page Meta Description</td>
                                    <td width="35">Page Meta Keyword</td>
                                    <td width="35">Page Author</td>
                                    <td width="10%">Edit</td>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($metadata as $md) {
                                    ?>

                                    <tr>
                                        <td><?php echo $md[DBConfig::TABLE_PAGE_SEO_ATT_PAGE_TITLE] ?></td>
                                        <td><?php echo $md[DBConfig::TABLE_PAGE_SEO_ATT_PAGE_META_DESCRIPTION] ?></td>
                                        <td><?php echo $md[DBConfig::TABLE_PAGE_SEO_ATT_PAGE_META_KEYWORD] ?></td>
                                        <td><?php echo $md[DBConfig::TABLE_PAGE_SEO_ATT_PAGE_AUTHOR] ?></td>
                                        <td><a href="<?php echo base_url() . Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_EDIT_PAGE_META_DATA . $md[DBConfig::TABLE_PAGE_SEO_ATT_ID] ?>" class="btn btn-small btn-success">Edit</a></td>
                                    </tr>

                                    <?php
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
