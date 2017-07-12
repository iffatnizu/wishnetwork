 
<div class="grey-inner-headings" id="grey-content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>Messaging</h2>
            </div>
        </div><!--/row-->
    </div><!--/container-->
</div>
<div id="white-content">
    <div class="container">
        <div class="row">
            <div class="span3">
                <div class="sidebar-wrap">
                    <div class="widgetcontent usermenu">
                        <h4>  
                            INBOX 
                        </h4>
                        <ul class="message-menu">
<!--                            <li><a href="javascript:;"> <i class="icon-envelope"></i>  Inbox </a></li>
                            <li><a href="javascript:;" onclick="loadSentMsg()"> <i class="icon-plane"></i>   Sent Messages  </a></li>-->
                            <li><a id="conversation" href="<?php echo base_url() . SiteConfig::CONTROLLER_MESSAGES; ?>"> <i class="icon-user"></i>   Conversations  </a></li>
                        </ul>
                    </div>
                </div>
            </div><!--/span 3-->
            <div class="span9">
                <div id="conversationMsg">
                    <h4>You have <?php echo $conversation['size']; ?>  conversation</h4>
                    <?php
                    //debugPrint($conversation['object']);
                    foreach ($conversation['object'] as $row) {
                        ?>
                        <div class="alert alert-info" style="padding-left:6px;">

                            <?php
                            $img = base_url() . 'assets/public/profile/' . $row['details']['userProfilePic'];
                            $name = $row['details']['userFirstName'];
                            $id = $row['details']['userId'];
                            ?>

                            <a href="javascript:;" onclick="chatWith('<?php echo $id; ?>', '<?php echo $name ?>')"><img style="margin-right:5px;" width="50" height="60" src="<?php echo $img ?>" alt="user"/> Conversation with <?php echo $name ?> </a>

                        </div>
    <?php
}
?>
                </div>
                <div id="currentChat">
                    <h4 id="chatTitle"></h4>
                    <div id="ajax-chatarea">

                    </div>
                    <div id="sendArea" style="display: none;">
                        <form onsubmit="return sendMessage('<?php echo encode($id); ?>')" method="POST">
                            <textarea name="msgBox" style="width: 853px; height: 59px;"></textarea> 
                            <input class="btn btn-info" type="submit" name="send" value="Send"/>
                        </form>
                    </div>
                </div>
            </div><!--/span 9-->
        </div><!--/row-->
    </div><!--/container-->
</div>
