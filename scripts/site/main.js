function getCityByState(id)
{
    $.ajax({
        type: "POST",
        url: base_url + "user/getCity",
        data: {
            "id": id
        },
        success: function(response)
        {
            //alert(response);
            $("select[name=city]").html("");
            var obj = $.parseJSON(response);
            $.each(obj, function(i, v) {
                var element = '<option value="' + v.cityId + '">' + v.cityName + '</option>';
                $("select[name=city]").append(element);
            })
        }
    });
}

var wishnetwork = {
    sendwishcomment: function(id)
    {
        var comment = $("textarea[name=wish-comments]");

        if ($.trim(comment.val()) == "")
        {
            comment.css({
                "border": "1px solid red"
            });
        }
        else
        {
            comment.css({
                "border": "1px solid #ccc"
            });

            $.ajax({
                type: "POST",
                url: base_url + "wish/commentOnWish",
                data: {
                    "comment": comment.val(),
                    "wishId": id,
                },
                success: function(res)
                {
                    var obj = $.parseJSON(res);

                    var htm = '<div class="well comment alert alert-info"><img src="' + base_url + 'assets/public/profile/' + obj.userProfilePic + '" alt="post"/><a href="javascript:;">' + obj.userFirstName + '</a><p>' + obj.comments + '</p><small>' + obj.time + '</small></div>';

                    $("div[id=ajax-content]").prepend(htm);

                    comment.val("");
                }
            })

            //alert(comment.val());
        }
    },
    border: function()
    {
        $("div[id=user-bio]").css({
            "border": "1px solid #ccc"
        })
    },
    noborder: function()
    {
        $("div[id=user-bio]").css({
            "border": "none"
        })
    },
    updateBio: function()
    {
        var bio = $("div[id=user-bio]").html();
        $.ajax({
            type: "POST",
            url: base_url + "user/updateBio",
            data: {
                "bio": bio,
            },
            success: function(res)
            {
                if (res == '1')
                {
                    var htm = '<div class="alert alert-success">Bio successfully updated</div>';
                    $("div[id=ajax-content]").html(htm);

                    setTimeout(function() {
                        $("div[id=ajax-content]").html('');
                    }, 3000)
                }
            }
        })
    }
}

function editComments(commentId, userId)
{
    $("a[id=a-" + commentId + "]").hide();
    var txt = $("p[id=" + commentId + "]").text();
    $("p[id=" + commentId + "]").html("");
    var edit = '<textarea style="height:41px;width:65%;margin-right:5px;" id="edit-' + commentId + '">' + txt + '</textarea><a class="btn btn-small btn-info" onclick="updateComment(\'' + commentId + '\',\'' + userId + '\')">Update</a> <a class="btn btn-small btn-warning" onclick="closeEdit(\'' + commentId + '\')"><i class="icon-remove"></i></a>';
    $("p[id=" + commentId + "]").html(edit);
}

function closeEdit(commentId)
{
    var updateTxt = $("textarea[id=edit-" + commentId + "]").val();
    $("a[id=a-" + commentId + "]").show();
    $("p[id=" + commentId + "]").html("");
    //var edit = '<textarea style="height:41px;width:65%;margin-right:5px;" id="edit-'+commentId+'">'+txt+'</textarea><a class="btn btn-small btn-info">Update</a> <a class="btn btn-small btn-warning" onclick="closeEdit(\''+commentId+'\')"><i class="icon-remove"></i></a>';
    $("p[id=" + commentId + "]").html(updateTxt);
}

function updateComment(commentId, userId)
{
    var updateTxt = $("textarea[id=edit-" + commentId + "]").val();
    if ($.trim(updateTxt) != "")
    {
        $.ajax({
            type: "POST",
            url: base_url + "wish/updateCommment",
            data: {
                "commentId": commentId,
                "userId": userId,
                "updateTxt": updateTxt
            },
            success: function(res)
            {
                alert(res);
                closeEdit(commentId);
            }
        })
    }
}
function deleteComment(commentId, wishId)
{
    var r = confirm('Are you sure ?');
    if (r == true) {
        $.ajax({
            type: "POST",
            url: base_url + "wish/deleteCommment",
            data: {
                "commentId": commentId,
                "wishId": wishId
            },
            success: function(res)
            {
                if (res == '1')
                {
                    $("div[id=well-" + commentId + "]").slideUp();
                }
            }
        })
    }
}

function sendMessage(str)
{
    var msg = $("textarea[name=msgBox]");
    if ($.trim(msg.val()) == "")
    {
        msg.css({
            "border": "1px solid red"
        })
        msg.attr("placeholder", "Please Write Something....")
    }
    else {
        $.ajax({
            type: "POST",
            url: base_url + "messages/sendMsg",
            data: {
                "msg": msg.val(),
                "str": str,
                "submit": "submit"
            },
            success: function(res)
            {
                if (res == '1')
                {
                    msg.val("");
                    $("div[class=msgresult]").html('<div class="alert alert-success">Message successfully sent</a>');

                    setTimeout(function() {
                        $("div[class=msgresult]").html("");
                    }, 3000)
                }
            }
        })
    }
    return false;
}
startChat = false;

function chatWith(id, name)
{
    $("div[id=conversationMsg]").hide();
    $("div[id=currentChat]").show();

    $("h4[id=chatTitle]").html("Chat with " + name +' <small id="loader"><br/> Loading...... </small>');

    startChat = true;

    loadChat(id);
}
function loadChat(id)
{
    if (startChat == true)
    {
        setInterval(function() {
            $.ajax({
                type: "GET",
                url: base_url + "messages/loadChat",
                data: {
                    "id": id
                },
                success: function(res)
                {
                    $("small[id=loader]").hide();
                    $("div[id=ajax-chatarea]").empty();
                    var obj = $.parseJSON(res);

                    $.each(obj, function(i, v) {
                        var htm = '<div class="alert alert-info" style="padding-left:6px;margin-bottom:4px;"><img width="50" height="60" src="' + base_url + 'assets/public/profile/' + v.from.userProfilePic + '" alt="user"/> ' + v.message + '</div>';

                        $("div[id=ajax-chatarea]").append(htm);  
                    })
                    
                    $("div[id=sendArea]").show();
                }
            })
        },4000)

    }
}

