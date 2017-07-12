<h3 class="title"><i class="icon-envelope"></i> Contact Details</h3><br clear="all"/>
<span id="titleDes">Contact Details</span>
<hr/>
<form enctype="multipart/form-data" id="business-query-form" class="form-a" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

    <?php
    if ($this->session->userdata('success')) {
        ?>
        <div class="alert alert-success">Your query successfully sent</div>
        <?php
    }
    $s['success'] = FALSE;
    $this->session->unset_userdata($s);
    ?>
    <fieldset>								
        <div class="hbox-d">									
            <h2 class="header-e">Main information</h2>
            <div class="helper-b">Fields with * are mandatory</div>
        </div><!-- .hbox-d -->

        <br clear="all"/>

        <div class="fgroup-a">
            <div class="field-a">
                <label for="fl_name">First and last name *</label>
                <span class="focus-wrapper">
                    <input type="text" class="name" id="fl_name" value="<?php echo set_value('name'); ?>" name="name"/>
                    <small class="error"><?php echo form_error('name'); ?></small>
                </span>
            </div>
            <div class="field-a fl-a">
                <label for="email">Email *</label>
                <span class="focus-wrapper">
                    <input type="text" class="email" id="email" value="<?php echo set_value('email'); ?>" name="email"/>
                    <small class="error"><?php echo form_error('email'); ?></small>
                </span>
            </div>
        </div><!-- .fgroup-a -->

        <div class="fgroup-a">
            <div class="field-a">
                <label for="address">Address</label>
                <span class="focus-wrapper"><input type="text" class="address" id="address" value="" name="address"/></span>
            </div>
            <div class="field-a fl-a">
                <label for="phone">Phone</label>
                <span class="focus-wrapper"><input type="tel" class="phone" id="phone" value="" name="phone"/></span>
            </div>
        </div><!-- .fgroup-a -->								
    </fieldset>

    <fieldset>								
        <div class="hbox-d">									
            <h2 class="header-e">Your description</h2>										
        </div><!-- .hbox-d -->									

        <div class="fgroup-a">															
            <div class="field-a fl-b">
                <label for="message">Describe in few words most important features of the project *</label>
                <span class="focus-wrapper">
                    <textarea class="message" cols="40" rows="8" id="message" name="message"><?php echo set_value('message'); ?></textarea>
                    <small class="error"><?php echo form_error('message'); ?></small>
                </span>
            </div>
        </div>
    </fieldset>
    <button name="submitcontact" type="submit" class="btn btn-large btn-success"><span>Send</span></button>	

</form>	