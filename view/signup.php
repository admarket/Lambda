<!DOCTYPE html>
<html>
  <head>
    <title>Sign Up  - API.com</title>
    <{include file="view/style.php"}>
    <{include file="view/script.php"}>
  </head>
  <body>
    <!--header content-->
    <!-- load head tpl -->
    <div style="background-color:#fff;margin:40px auto;width:400px;
    border:solid 1px #dedede;padding:20px;border-radius:5px;">
      <div style="text-align:center;padding-top:20px;">
          <a  href="/" style="color:#444;"><i class="huge cube icon"></i></a>
          <h2 style="color:#999;">Lambda Cube</h2>
      </div>
        <div class="ui small form segment" style="border:solid 2px #fff;box-shadow:none;">
          <div class="field">
                  <div class="ui labeled input">
                    <div class="ui label"  style="font-size:12px;">
                      http://www.api.com/
                    </div>
                    <input type="text" placeholder="Name, 4-20"  style="font-size:12px;" id="txt-username">

                  </div>

          </div>

          <div class="field">
            <div class="ui left icon  input">
              <input  id="txt-email" placeholder="Email" type="text">
              <i class="mail icon"></i>
            </div>

          </div>

            <div class="field">
              <div class="ui left icon input">
                <input id="txt-password" placeholder="Password, 4 - 20" type="password">
                <i class="lock icon"></i>
              </div>

            </div>
          <div style="padding:20px 0;">
            <div id="msg-all" class="ui red pointing bottom ui label msg"  style="display:none;width:100%;">your password is invalid</div>
            <a  id="btn-signup"  class="ui black button save" style="padding: 10px 20px;
            font-size:24px;background-color:#444;color:#fff;width:100%;line-height:35px;" href="#">
            <i class="checkmark icon"></i>
            </a>

          </div>
        </div>
    </div>
    <script type="text/javascript">
    var email = $.trim($('#txt-email').val());
    var password = $.trim($('#txt-password').val());
    var username = $.trim($('#txt-username').val());


      $('.ui.checkbox').checkbox();
      $('.save').click(function(){

            $.post("<{spUrl c=user a=register}>", {name:username, email:email, password:password},
             function(data, status){
                result = JSON.parse(data);
                if(result.status == 0){
                  alert('yes');
                }else{
                  msg_html = result.message.join('<br/>');
                  $('#msg-all').show();
                  $('#msg-all').html(msg_html);
                }
            });
      });

    </script>>
  </body>
</html>
