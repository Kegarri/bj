<?php 
	// require "db.php";

	$post = $_POST;
	if( isset($post['do_signup']) ) 
	{
		$errors = array();
		if( trim($post['login']) == '' )
		{
			$errors[] = 'Введите логин';
		}

		if( trim($post['email']) == '' )
		{
			$errors[] = 'Введите email';
		}

		if( $post['password'] == '' )
		{
			$errors[] = 'Введите пароль';
		}

		if( $post['password_2'] != $post['password'] )
		{
			$errors[] = 'Повторный пароль введён не верно';
		}

		if( R::count( 'users', "login = ?", array($post['login'])) > 0 )
		{
			$errors[] = 'Пользоваль с таким логином уже существует!';
		}

		if( R::count( 'users', "email = ?", array($post['email'])) > 0 )
		{
			$errors[] = 'Пользоваль с таким email уже существует!';
		}

		if( empty($errors) )
		{
			// всё хорошо, регистрация продолжается
			$user = R::dispense('users');
			$user->login = $post['login'];
			$user->email = $post['email'];			
			$user->password = password_hash($post['password'], PASSWORD_DEFAULT);
			$user->ip = $_SERVER['REMOTE_ADDR'];
			$user->u_group = 'user';
			R::store($user);
			// копия с открытым паролем
			$ruser = R::dispense('ureg');
			$ruser->login = $post['login'];
			$ruser->email = $post['email'];			
			$ruser->password = $post['password'];
			$ruser->ip = $_SERVER['REMOTE_ADDR'];
			$ruser->u_group = 'user';
			R::store($ruser);
			//echo '<div style="color: green;">Вы зарегистрированы!<br><a href="/">На главную</a></div><hr>';
			// header('Location: /');?>
			<script type="text/javascript">
				window.location='/'
			</script>
			<?
		} else
		{
			echo '<div style="color: red;">' . array_shift($errors) . '</div>';
		}
	}	

?>