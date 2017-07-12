<h3 class="title"><i class="icon-magic"></i> Manage Wish</h3><br clear="all"/>
<span id="titleDes">Manage all wish</span>
<hr/>
<?php
$this->load->view(SiteConfig::COMPONENT_USER_NAV);
?>
<div class="grey-inner-headings" id="grey-content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>Manage Wish</h2>
            </div>
        </div><!--/row-->
    </div><!--/container-->
</div>
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
<table style="width: 100%">
    <thead>
        <tr>
            <td>Wish Title</td>
            <td>Wish Photo</td>
            <td>Wish Goal Amount</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($wishes as $wi) {
            ?>
            <tr class="wish-list">
                <td><?php echo $wi[DBConfig::TABLE_WISH_ATT_WISH_TITLE] ?></td>
                <td><img width="60" height="60" src="<?php echo base_url() ?>assets/public/wish/<?php echo $wi[DBConfig::TABLE_WISH_ATT_WISH_PHOTO] ?>"/></td>
                <td><?php echo $wi[DBConfig::TABLE_WISH_ATT_WISH_GOAL_AMOUNT] ?></td>
                <td><a href="<?php echo base_url().SiteConfig::CONTROLLER_WISH.SiteConfig::METHOD_WISH_EDIT_WISH.$wi[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>" class="btn btn-info">Edit</a></td>
                <td><a href="<?php echo base_url().SiteConfig::CONTROLLER_WISH.SiteConfig::METHOD_WISH_DELETE_WISH.$wi[DBConfig::TABLE_WISH_ATT_WISH_ID] ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
