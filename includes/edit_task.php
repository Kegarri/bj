<?
// Создание записи
$post = $_POST;
if( isset($post['do_add']) )
{
	$errors = array();
	if( trim($post['new_task']) != '' )
	{
		if( $post['login'] != '' )
		{
			if ( trim($post['u_email']) != '' )
			{
				if( R::count( 'tasks', "task = ?", array($post['new_task'])) <= 0 )
				{	
					$new_task = R::xdispense('tasks');
					$new_task->status = $post['select_checked'];
					$new_task->name = $u_login; // тут что-то не так
					$new_task->email = $u_email;						
					$new_task->task = $post['new_task'];
					$new_task->ip = $_SERVER['REMOTE_ADDR'];
					R::store($new_task);
					?>
					<tbody>
						<tr>
							<td colspan="6" id="table_complete"><?= 'Задача успешно добавлена' ?></td>
						</tr>
					</tbody>

					<script type="text/javascript">
						window.location='/'
					</script>
					<?
				}else
				{
					$errors[] = 'Такая задача уже существует!';?>
				<style>#new_task{box-shadow: inset 0 0 6px 30px rgba(100, 0, 0, 0.35);}</style><?
				}
			}else
			{
				$errors[] = 'Поле с почтой пустует...';
			}

		}else
		{
			$errors[] = 'Поле с именем не может быть пустым ('.var_dump($post['login']).')';
		}
	}else
	{
		$errors[] = 'Поле task не может быть пустым';
	}
	if( !empty($errors) )
	{
		?>
		<tbody>
			<tr>
				<td colspan="6" id="table_error"><?= array_shift($errors); ?></td>
			</tr>
		</tbody>
        <?
	}
}


// Редактирование
if( isset($post['do_edit']) ) 
{
	$a_errors = array();
	if( $_POST['select_task'] == 'выбор задачи' )
		{
			$a_errors[] = 'Не выбрана задача';
		}
	if( $_POST['new_task'] == '' )
		{
			$a_errors[] = 'Не введена задача';
		}
	if( $_POST['select_checked'] == 'status' )
		{
			$a_errors[] = 'Не выбран статус';
		}
	if( empty($a_errors) )
		{
		    // получаем id нужной задачи исходя из её названия
		    $select_task = R::getCol("SELECT id FROM `tasks` WHERE task = '".$_POST['select_task']."'");
		    // загружаем выбранную задачу в переменную
		    $edit_task = R::load('tasks', $select_task[0]);
		    // редактируем задачу
		    $edit_task->task = $_POST['new_task'];
		    $edit_task->status = $_POST['select_checked'];
		    // сохраняем
		    R::store($edit_task);?>
		    <tbody>
				<tr>
					<td colspan="6" id="table_complete">Задача изменена!</td>
				</tr>
			</tbody>
		    <script type="text/javascript">
				window.location='/'
			</script>
			<?
		}else
	    {
		    //вывести ошибку
		    ?>
			<tbody>
				<tr>
					<td colspan="6" id="table_error"><?= $a_errors['0']; ?></td>
				</tr>
			</tbody>
            <?
		    // echo '<center><span style="color: red; font-weight: bold; margin-bottom: 10px; display: block;">' . $a_errors['0'] . '</span></center>';
	    }
}

// Удаление
if( isset($_POST['do_del']) )
{
	$a_errors = array();
	if( $_POST['select_task'] == 'выбор задачи' )
	{
		$a_errors[] = 'Задача не выбрана';
	}

	if( empty($a_errors) )
	{
		$select_task = R::getCol("SELECT id FROM `tasks` WHERE task = '".$_POST['select_task']."'");
		$del_cat = R::load('tasks', $select_task[0]);
		// удаляем
		R::trash($del_cat);
		echo '<center><span style="color: green; font-weight: bold; margin-bottom: 10px; display: block;">Задача удалена!</span></center>';
	}else
	{
		//вывести ошибку
		echo '<center><span style="color: red; font-weight: bold; margin-bottom: 10px; display: block;">' . $a_errors['0'] . '</span></center>';
	}
}
?>