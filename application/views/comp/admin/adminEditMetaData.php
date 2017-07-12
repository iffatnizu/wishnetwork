<div id=main role=main>
    <div id=main-content>

        <?php
        if ($this->session->userdata('_success')) {
            echo '<div class="alert alert-success">Meta information successfully updated</div>';
        }
        $session['_success'] = false;
        $this->session->unset_userdata($session);
        ?>

        <h1>Meta information : Edit</h1>



        <form action="<?php echo current_url() ?>" method="POST">
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
                                <td valign="top">Page Title</td>
                                <td><input type="text" name="title" value="<?php echo $metadata[DBConfig::TABLE_PAGE_SEO_ATT_PAGE_TITLE] ?>"/> </td>
                                <td><?php echo form_error('title'); ?></td>
                            </tr>
                            <tr>
                                <td valign="top">Page Meta Description </td>
                                <td><input type="text" name="description" value="<?php echo $metadata[DBConfig::TABLE_PAGE_SEO_ATT_PAGE_META_DESCRIPTION] ?>"/> </td>
                                <td><?php echo form_error('description'); ?></td>
                            </tr>
                            <tr>
                                <td valign="top">Page Meta Keyword </td>
                                <td><textarea name="keyword" style="width: 420px;height: 175px;"><?php echo $metadata[DBConfig::TABLE_PAGE_SEO_ATT_PAGE_META_KEYWORD] ?></textarea> </td>
                                <td><?php echo form_error('keyword'); ?></td>
                            </tr>
                            <tr>
                                <td valign="top">Page Author  </td>
                                <td><input type="text" name="author" value="<?php echo $metadata[DBConfig::TABLE_PAGE_SEO_ATT_PAGE_AUTHOR] ?>"/> </td>
                                <td><?php echo form_error('author'); ?></td>
                            </tr>
                            


                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" name="submit" value="Update" class="btn btn-warning"/></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
