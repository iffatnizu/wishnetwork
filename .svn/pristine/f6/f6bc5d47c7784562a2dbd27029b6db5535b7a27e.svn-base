<h3 class="title"><i class="icon-key"></i> Edit Wish</h3><br clear="all"/>
<span id="titleDes">Modify your submitted wish</span>
<hr/>
<?php
$this->load->view(SiteConfig::COMPONENT_USER_NAV);
//debugPrint($details);
?>
<div class="grey-inner-headings" id="grey-content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>Create Wish</h2>
            </div>
        </div><!--/row-->
    </div><!--/container-->
</div>
<script>
    $(function() {
        $("#datepicker").datepicker({
            showOn: "button",
            buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
            buttonImageOnly: true,
            dateFormat: "yy-mm-dd"
        });
    });
</script>
<?php
if ($this->session->userdata('successMsg')) {
    ?>
    <div class="alert alert-success">
        <?php echo $this->session->userdata('successMsg') ?>
    </div>
    <?php
}
$sess['successMsg'] = FALSE;
$this->session->unset_userdata($sess);
?>
<script type="text/javascript" src="<?php echo base_url() ?>scripts/plugins/ckeditor/ckeditor.js"></script>
<form enctype="multipart/form-data" id="registration" action="<?php echo current_url() ?>" method="POST" autocomplete="off">
    
    <table style="width: 100%">

        <tr>
            <td>Wish Title</td>
            <td><input type="text" name="wish-title" value="<?php echo $details[DBConfig::TABLE_WISH_ATT_WISH_TITLE] ?>"/><span class="error"><?php echo form_error('wish-title') ?></span></td>
        </tr>
        <tr>
            <td>Wish Description</td>
            <td><textarea id="editor2" name="wish-description"><?php echo $details[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION] ?></textarea><span class="error"><?php echo form_error('wish-description') ?></span></td>
        </tr>
        <tr>
            <td>Upload Photo</td>
            <td style="padding: 10px;">
                <img width="120" height="120" src="<?php echo base_url() ?>assets/public/wish/<?php echo $details[DBConfig::TABLE_WISH_ATT_WISH_PHOTO] ?>"/>

                <input type="file" name="userfile"/>
                <span class="error">
                    <?php
                    if ($this->session->userdata('upload-error')) {
                        echo 'File required';
                    }
                    $e['upload-error'] = false;
                    $this->session->unset_userdata($e);
                    ?>
                </span>
            </td>
        </tr>
      
        <tr>
            <td>Wish Category</td>
            <?php
//debugPrint($category);
            ?>
            <td>
                <select name="wish-category" style="width: 180px;">
                    <option value="">-Please Select-</option>
                    <?php
                    $selected = "";
                    foreach ($category as $cat) {

                        if ($cat[DBConfig::TABLE_WISH_CATEGORY_ATT_CATEGORY_ID] == $details[DBConfig::TABLE_WISH_ATT_WISH_CATEGORY_ID]) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = "";
                        }
                        ?>
                        <option <?php echo $selected; ?> value="<?php echo $cat[DBConfig::TABLE_WISH_CATEGORY_ATT_CATEGORY_ID]; ?>"><?php echo $cat[DBConfig::TABLE_WISH_CATEGORY_ATT_CATEGORY_NAME]; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <span class="error"><?php echo form_error('wish-category') ?></span>
            </td>
        </tr>
        <tr>
            <td>State</td>
            <td>
                <select style="width: 180px;" name="state" onchange="getCityByState(this.value)">
                    <option value="">-Please Select-</option>
                    <?php
                    $selected = '';
                    foreach ($states as $state) {

                        if ($state[DBConfig::TABLE_STATES_ATT_STATE_SHORT_NAME] == $details[DBConfig::TABLE_WISH_ATT_WISH_STATE_ID]) {
                            $selected = 'selected="selected"';
                        } else {
                            $selected = "";
                        }

                        echo '<option ' . $selected . ' value="' . $state[DBConfig::TABLE_STATES_ATT_STATE_SHORT_NAME] . '">' . $state[DBConfig::TABLE_STATES_ATT_STATE_NAME] . '</option>';
                    }
                    ?>
                </select>
                <span class="error"><?php echo form_error('state') ?></span>
            </td>
        </tr>
        <tr>
            <td>City</td>
            <td>
                <select style="width: 180px;" name="city">
                    <option value="">-Please Select-</option>
                    <option selected="selected" value="<?php echo $details[DBConfig::TABLE_WISH_ATT_WISH_CITY_ID] ?>">-<?php echo $details['city'] ?>-</option>
                </select>
                <span class="error"><?php echo form_error('city') ?></span>
            </td>

        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input class="btn btn-default" type="submit" value="Update" name="submit"/></td>
        </tr>
    </table>
    <script>

        CKEDITOR.replace('editor2', {
            allowedContent:
                    'h4 p blockquote strong em;' +
                    'span{!font-family};' +
                    'span{!color};' +
                    'span(!marker);' +
                    'del ins'
        });

    </script>
</form>