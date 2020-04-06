<!-- links -->
<link rel="stylesheet" href="media/css/style.css">
<!-- <link rel="stylesheet" href="media/css/login.css"> -->
<link rel="stylesheet" href="../media/fonts/font-awesome.css" type="text/css">

<!-- scripts -->
<script type="text/javascript" src="media/js/sort.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tabulator/4.1.1/js/tabulator.min.js"></script>

<div id="user_info">
    <p>Имя: 
      <? if( isset($_SESSION['logged_user']) )
          {
            echo $u_login;?> <a href="includes/login/logout.php" class="signup fa fa-sign-out" style="text-decoration: none; color: red"></a><?
          }else
          {
            echo 'Guest ';?><a href="signin.php" class="signup fa fa-sign-in" style="text-decoration: none; color: green"> Вход</a><?
          } ?>
    </p>

    <p>Статус: 
      <? if( isset($_SESSION['logged_user']) )
          {
            echo $u_group;
          }else
          {
            echo "Guest";
          } ?>
    </p>

    <p>Редактирование: 
        <? if( $u_group == 'admin' )
        {
            echo '<span style="color: green">Да</style>';
        }else
        {
            echo '<span style="color: red">Нет</style>';
        } ?>            
    </p>
  
</div>