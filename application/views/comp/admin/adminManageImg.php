<div id=main role=main>
    <div id=main-content>

        <?php
        if ($this->session->userdata('_success')) {
            echo '<div class="alert alert-success">Category successfully added</div>';
        }
        $session['_success'] = false;
        $this->session->unset_userdata($session);
        ?>

        <h1>Add Category <a href="<?php echo base_url().Adminconfig::CONTROLLER_ADMINISTRATOR.Adminconfig::METHOD_ADMINISTRATOR_VIEW_CATEGORY ?>" class="btn btn-danger" style="float: right">View All</a></h1>



        <form action="<?php echo current_url() ?>" method="POST" enctype="multipart/form-data">
            <div class=grid_12>
                <div class=block-border>
                    <div class=block-content>
                        <style>
                            p{
                                font-size: 11px;
                                color: red;
                            }
                        </style>
                        <table>
                            <tr>
                                <td valign="top">Category Title</td>
                                <td><input type="text" name="catTitle"/> <?php echo form_error('catTitle'); ?></td>
                            </tr>
                            


                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" name="submit" value="add" class="btn btn-danger"/></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
