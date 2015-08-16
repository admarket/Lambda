<!DOCTYPE html>
<html>
  <head>
    <title>Sign In - API.com</title>
    <{include file="view/style.php"}>
    <{include file="view/script.php"}>
  </head>
  <body>
    <!--header content-->
    <!-- load head tpl -->
    <div style="border:solid 1px #ddd;border-radius:5px;background-color:#fff;margin:80px auto 0 auto;width:330px;padding:20px;">
        <div style="text-align:center;padding-top:20px;">
            <a  href="/" style="color:#444;"><i class="huge cube icon"></i></a>
            <h2 style="color:#444;">Lambda Cube</h2>
        </div>
        <div class="ui small form segment" style="border:solid 2px #fff;box-shadow:none;">
          <div class="one fields">
              <div class="field " style="width:100%;font-size:14px;margin:10px 0;">

                  <div class="ui left icon  input">
                    <input  id="txt-email" placeholder="Email" type="text">
                    <i class="mail icon"></i>
                  </div>
              </div>

          </div>

          <div class="one fields" >
              <div class="field" style="width:100%;font-size:14px;margin:10px 0;">

                  <div class="ui left icon input">
                    <input id="txt-password" placeholder="Password" type="password">
                    <i class="lock icon"></i>
                  </div>

              </div>
          </div>
          <div style="padding:10px 0;">
              <a  id="btn-login"  class="ui black button" style="padding: 10px 20px;
              font-size:24px;background-color:#444;color:#fff;width:100%;" href="#">
              <i class="checkmark icon"></i>
              </a>
          </div>
        </div>
    </div>
    <script src="/js/jquery.message.js"></script>
    <script type="text/javascript">
    init();
    function init(){
      $('.ui.checkbox').checkbox();
      var CookieStr = document.cookie;
      if(CookieStr.indexOf('email')>=0){
        var GetName = '';
        if(CookieStr.indexOf('=')>=0&&CookieStr.indexOf(';')>=0){
          GetName =CookieStr.split('=')[1].split(';')[0]; //get cookie
        }

         $("#txt-email").val(GetName);
      }
    }

    function login(){
       $("#btn-login").attr('class', 'ui disabled loading blue small submit button');
          $.post("<{spUrl c=user a=login}>", { email: $("#txt-email").val(), password: $("#txt-password").val() },
           function(data){
             result = JSON.parse(data);
             if(result.status == 0){
              $.msg("Email or password successful","color:green;");
              window.location.href = "<{spUrl c=user a=dashboard}>";

             }else{
              $.msg("Email or password error！");

             }
             $("#btn-login").attr('class', 'ui blue small submit button');
           });
    }
      $("#btn-login").click(function(){
         login();
      });
    document.onkeydown=function(event){
      e = event ? event :(window.event ? window.event : null);
      if(e.keyCode==13){
        login();
      }
     }
    </script>
  </body>
</html>
