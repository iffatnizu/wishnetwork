<h3 class="title"><i class="icon-key"></i> Create New Wish</h3><br clear="all"/>
<span id="titleDes">The World's Leading Helping Site</span>
<hr/>
<?php
$this->load->view(SiteConfig::COMPONENT_USER_NAV);
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
            dateFormat:"yy-mm-dd"
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
    <small style="color: #99007E">[All fields are required]</small>
    <table style="width: 100%">

        <tr>
            <td>Wish Title</td>
            <td><input type="text" name="wish-title" value=""/><span class="error"><?php echo form_error('wish-title') ?></span></td>
        </tr>
        <tr>
            <td>Wish Description</td>
            <td><textarea id="editor2" name="wish-description"></textarea><span class="error"><?php echo form_error('wish-description') ?></span></td>
        </tr>
        <tr>
            <td>Upload Photo</td>
            <td>
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
            <td>Goal Amount</td>
            <td><input type="text" name="wish-goal-amount"/><span class="error"><?php echo form_error('wish-goal-amount') ?></span></td>
        </tr>
        
        <tr>
            <td>Currency</td>
            <td>
                <select name="wish-currency" style="width: 180px;">
                    <option value="">-Please Select-</option>
                    <?php
                    foreach ($currency as $cur) {
                        ?>
                        <option value="<?php echo $cur[DBConfig::TABLE_CURRENCY_ATT_ID]; ?>"><?php echo $cur[DBConfig::TABLE_CURRENCY_ATT_CURRENCY_NAME]; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <span class="error"><?php echo form_error('wish-currency') ?></span>
            </td>
        </tr>
        
        <tr>
            <td>Grant Date</td>
            <td><input type="text" id="datepicker" name="wish-grant-date"/><span class="error"><?php echo form_error('wish-grant-date') ?></span></td>
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
                    foreach ($category as $cat) {
                        ?>
                        <option value="<?php echo $cat[DBConfig::TABLE_WISH_CATEGORY_ATT_CATEGORY_ID]; ?>"><?php echo $cat[DBConfig::TABLE_WISH_CATEGORY_ATT_CATEGORY_NAME]; ?></option>
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
                    foreach ($states as $state) {
                        echo '<option value="' . $state[DBConfig::TABLE_STATES_ATT_STATE_SHORT_NAME] . '">' . $state[DBConfig::TABLE_STATES_ATT_STATE_NAME] . '</option>';
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
                </select>
                <span class="error"><?php echo form_error('city') ?></span>
            </td>

        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input class="btn btn-default" type="submit" value="Create" name="submit"/></td>
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