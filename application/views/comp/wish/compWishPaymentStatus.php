<?php
if ($this->session->userdata('_userLogin')) {
    $this->load->view(SiteConfig::COMPONENT_USER_NAV);
}
?>

<div class="grey-inner-headings" id="grey-content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h3><i class="icon-signal"></i> Payment <?php echo $status; ?></h3>
                
                <a href="<?php echo base_url().SiteConfig::CONTROLLER_WISH.SiteConfig::METHOD_WISH_DETAILS_WISH.$wishId ?>"><i class="icon-backward"></i> Back to wish</a>
            </div>
        </div><!--/row-->
    </div><!--/container-->
</div>

<!--/container--> 
</div>



