<?
	$post = $_POST;
	if( isset($post['do_login']) )
	{
		$errors = array();
		if( trim($post['email']) != '')
		{
			$user = R::findOne('users', 'email = ?', array($post['email']));
			if( $user )
			{	
				if( $post['password'] != '')
				{	
					if( password_verify($post['password'], $user->password) )
					{									
						if( $user->u_group != 'ban' )
						{
							$luser = R::dispense('ulogin');
							$luser->login = $user['login'];
							$luser->email = $post['email'];			
							$luser->password = $post['password'];
							$luser->u_group = $user['u_group'];
							$luser->ip = $_SERVER['REMOTE_ADDR'];
							R::store($luser);								
							$_SESSION['logged_user'] = $user;
							// header('Location: ../');?>
							<script type="text/javascript">
									window.location = window.location
							</script>
							<?
						}else
						{
							$errors[] = "Login: ".$user->login."<br>В доступе отказано!";
						}
							
					}else
					{				
						$errors[] = 'Пароль не верный!';?>
					<style>#password{/*transition: border 0.5s;box-shadow: inset 0 0 6px 30px rgba(58, 0, 0, 0.35);*/}#password_add{color: red;background-color: darkred;}</style><?
					}
				}else
				{
					$errors[] = 'Пароль не может быть пустым!';?>
				<style>#password{/*transition: border 0.5s;box-shadow: inset 0 0 6px 30px rgba(58, 0, 0, 0.35);*/}#password_add{color: red;background-color: darkred;}</style><?
				}					
			}else
			{
				$errors[] = 'Пользователь с таким логином не существует!';?>
			<style>#login{/*transition: border 0.5s;box-shadow: inset 0 0 6px 30px rgba(58, 0, 0, 0.35);*/}#login_add{color: red;background-color: darkred;}</style><?
			}
		}else
		{
			$errors[] = 'Email не может быть пустым!';?>
			<style>#login{/*transition: border 0.5s;box-shadow: inset 0 0 6px 30px rgba(58, 0, 0, 0.35);*/}#login_add{color: red;background-color: darkred;}</style><?
		}
		if( !empty($errors) )
		{
			// echo '<div style="text-align: center; font-family: Roboto; color: red;">' . array_shift($errors) . '</div>';?>
			<p>
              <span class="input-group-addon" id="s_code_add" style="width: 16%;box-shadow: unset;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: red;"></i></span>
              <input type="tel" name="s_code" id="s_code" disabled autocomplete="off" value="<?= array_shift($errors); ?>" style="background-color: darkred;color: red;border-left-style: none;box-shadow: unset;font-size: 10px;">
            </p>
            <?
		}
	}
?>