<div id=main role=main>
    <div id=main-content>

        <?php
        if ($this->session->userdata('_success')) {
            echo '<div class="alert alert-success">Password successfully updated</div>';
        }
        if ($this->session->userdata('_notmached')) {
            echo '<div class="alert alert-danger">Old password did not match</div>';
        }
        $session['_success'] = false;
        $session['_notmached'] = false;
        $this->session->unset_userdata($session);
        ?>

        <style type="text/css">
            input[type=password]
            {
                float: left;
                margin-right: 5px;
            }
            p{

                color: red;
            }
        </style>
        
        <h1>Change Administrator Password</h1>
        <div>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 250px;">Old Password</td>
                        <td><input type="password" name="old_password" value=""/> <?php echo form_error('old_password') ?> </td>
                    </tr>
                    <tr>
                        <td>New Password</td>
                        <td><input type="password" name="new_password" value=""/> <?php echo form_error('new_password') ?></td>
                    </tr>
                    <tr>
                        <td>Confirm New Password</td>
                        <td><input type="password" name="con_new_password" value=""/> <?php echo form_error('con_new_password') ?></td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Update" name="updatePassword" class="btn btn-danger"/></td>
                    </tr>
                </table>


            </form>
        </div>
    </div>
</div>
