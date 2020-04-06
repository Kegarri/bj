<?
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
<title>Регистрация</title>
<meta charset="utf-8">
<link rel="stylesheet" href="media/css/signup.css">
<link rel="stylesheet" href="media/fonts/font-awesome.css" type="text/css">
<div id="form">
<form action="signup.php" method="POST" class="login">
  <? require "includes/signup.php" ?>
  <div class="dws-input"> 
    <i id="fa-user" class="fa fa-user"></i>
      <input type="text" name="login" onkeyup="checkParams()" id="login" autocomplete="off" placeholder="login" value="<?php echo @$post['login']; ?>" style="border-radius: 5px 5px 0 0; border-top: 2px solid #6ee9fd;">
  </div>
  <div class="dws-input">
    <i id="fa-email"></i>
    <input type="hidden" name="email" onkeyup="checkParams()" id="email" autocomplete="off" placeholder="name@expample.com" value="<?php echo @$post['email']; ?>" style="border-left: 1px solid #6ee9fd; border-right: 1px solid #6ee9fd;">
  </div>
  <div class="dws-input">
    <i id="fa-pass"></i>
    <input type="hidden" name="password" onkeyup="checkParams()" onChange="checkPasswordMatch();" id="password" autocomplete="off" placeholder="••••••" value="<?php echo @$post['passwrd']; ?>" style="border-left: 1px solid #6ee9fd; border-right: 1px solid #6ee9fd;">
  </div>
  <div class="dws-input">
    <i id="fa-pass2"></i>
    <input type="hidden" target="_self" name="password_2" onkeyup="checkParams()" id="password_2" autocomplete="off" placeholder="••••••" value="<?php echo @$post['passwrd_2']; ?>">
  </div>
  
  <input class="dws-cencel" type="submit" id="cencel" value="Отмена" onClick="window.location='/'" style="border-radius: 0 0 5px 5px;">

  <input class="dws-submit" type="hidden" onkeyup="checkParams()" id="button" disabled="disabled" name="do_signup" value="Отправить" style="border-radius: 0 0 5px 5px;">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  <script type="text/javascript">
        function checkParams() {
            var login = $('#login').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var password_2 = $('#password_2').val();

            if(login.length >= 4){
              $('#email').removeAttr('disabled').attr('type', 'email') && $('#fa-email').attr('class', 'fa fa-envelope');
            }else{
              $('#email').val('').attr('type', 'hidden').attr('disabled', 'disabled') && $('#fa-email').attr('class', '');
            }
            if(email.length >= 5){
              $('#password').removeAttr('disabled').attr('type', 'password') && $('#fa-pass').attr('class', 'fa fa-lock');
            }else{
              $('#password').val('').attr('type', 'hidden').attr('disabled', 'disabled') && $('#fa-pass').attr('class', '');
            }
            if(password.length >= 8){
              $('#password_2').removeAttr('disabled').attr('type', 'password') && $('#fa-pass2').attr('class', 'fa fa-lock');
            }else{
              $('#password_2').val('').attr('type', 'hidden').attr('disabled', 'disabled') && $('#fa-pass2').attr('class', '');
            }

            if(login.length >= 4 && email.length >= 5 && password.length >= 8 && password_2.length == password.length ) {
                $('#button').removeAttr('disabled') && $('#button').attr('type', 'submit');
                $('#cencel').attr('type', 'hidden') && $('#cencel').attr('disabled', 'disabled');
            } else {
                $('#button').attr('disabled', 'disabled');
                $('#cencel').attr('type', 'button') && $('#cencel').removeAttr('disabled')
            }
        }
        function checkPasswordMatch() {
        var password = $("#password").val();
        var confirmPassword = $("#password_2").val();

        if (password != confirmPassword){
            $('#password_2').attr('target', '_self') && $('#button').attr('type', 'hidden');
        }
        else{
            $('#password_2').attr('target', '_blank');
        }
    }

    $(document).ready(function () {
       $("#password, #password_2").keyup(checkPasswordMatch);
    });
    </script>
</form>

</div>