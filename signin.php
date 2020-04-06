<?php
require "includes/config.php"; // подключение конфигурационного файла
if( $_SESSION['logged_user']) // если пользователь авторизован мы получаем его логин и записываем в переменную $login
{
  $login = $_SESSION['logged_user']->login;
  header('Location: ./');
} else
{
  $login = 'guest';
}
?>

<html>
<link rel="stylesheet" href="media/css/quit.css">
<link rel="stylesheet" href="media/fonts/font-awesome.css" type="text/css">
<link rel="stylesheet" href="media/css/login.css">
    
    
    <div id="templatemo_main" style="min-height: max-content;border-radius: 15px 15px 0 0;">
      
        <div id="templatemo_content_login">
        
        <!-- получение статьи из бд -->
        
    <?
      if($_SERVER['REQUEST_URI'] == '/signin.php')
            {?>
          <form class="login" id="form" name="form" method="post" action="">
            <? require 'includes/login/signin.php'; ?>
            <p>
              <span class="input-group-addon" onkeyup="checkParams()" id="login_add"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
              <input type="email" name="email" id="login" onkeyup="checkParams()" autofocus autocomplete="off" placeholder="name@example.com" value="<?= @$post['email']; ?>">
            </p>

            <p>
              <span class="input-group-addon" id="password_add"><i class="fa fa-lock fa-fw" aria-hidden="true"></i></span>
              <input type="password" name="password" id="password" autocomplete="off" placeholder="••••••" value="<?= @$post['passwrd']; ?>">
            </p>
            
            

            <input type="submit" id="signin" name="do_login" value="Вход">
            <input type="button" id="signup" value="Регистрация" onClick="window.location='signup.php'">
          </form>
          <script src="media/assets/scripts/mask.js"></script>
          <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
            <script type="text/javascript">
                function checkParams() {
                    var login = $('#login').val();

                    if(login == 'kegarri'){
                      $('#login').attr('type', 'text');
                    }else{
                      $('#login').attr('type', 'email');
                    }            
                }

                //Красим иконку при :focus
                $('#login').focus(function(){
                    $("#login_add").css({'color' : 'white'});
                    });
                $('#login').focusout(function(){
                      $("#login_add").css({'color' : '#a8a7a8'});
                    });
                $('#s_code').focus(function(){
                      $("#s_code_add").css({'color' : 'white'});
                    });
                $('#s_code').focusout(function(){
                      $("#s_code_add").css({'color' : '#a8a7a8'});
                    });
                $('#password').focus(function(){
                      $("#password_add").css({'color' : 'white'});
                    });
                $('#password').focusout(function(){
                      $("#password_add").css({'color' : '#a8a7a8'});
                    });
            </script>
        <? } ?>
            
        </div>
        
        
    
      <div class="cleaner"></div>
    </div>
    
        
</div>
<div class="cleaner"></div>
</div>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="ajax.js"></script> -->

</body>
</html>