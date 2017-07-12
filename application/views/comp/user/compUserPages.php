<?php
$this->load->view(SiteConfig::COMPONENT_USER_NAV);
?>
<div class="grey-inner-headings" id="grey-content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>Pages-user</h2>
            </div>
        </div><!--/row-->
    </div><!--/container-->
</div>
<div id="white-content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h3>Pages I've Joined:</h3>
            </div><!--/row 4-->
        </div><!--/row-->
        <div class="row">
            <div class="span12">
                <div class="hidden-phone" id="filterSection_menu">
                    <ul>
                        <li class="muted">Sort by:</li>
                        <li><a data-filter="" href="javascript:void(0);" class="active">All</a></li>
                        <li><a data-filter="manager" href="javascript:void(0);">Most Populer</a></li>
                        <li><a data-filter="developer" href="javascript:void(0);">Most Visited</a></li>
                        <li><a data-filter="designer" href="javascript:void(0);">Top</a></li>
                    </ul>
                </div>
                <div class="row" id="filterSection">
                    <div class="span3 filterable manager">
                        <div class="opacity-fade border">
                            <a href="#">
                                <img src="<?php echo base_url() ?>assets/public/pages/test.jpg" alt="three" class="img-rounded">
                                <h4>Johnny Doey</h4>
                            </a>
                            <p class="muted-small">CEO / Creative Director</p>
                            
                        </div>
                    </div>
                    <div class="span3 filterable manager">
                        <div class="opacity-fade border">
                            <a href="#">
                                <img src="<?php echo base_url() ?>assets/public/pages/test.jpg" alt="three" class="img-rounded">
                                <h4>Lorrie Kogan</h4>
                            </a><p class="muted-small">CFO</p>
                           
                        </div>
                    </div>
                    
                </div>				
            </div><!--/row 4-->
        </div>
    </div><!--/container-->
</div>