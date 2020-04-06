<?php
require "includes/config.php";

if( $_SESSION['logged_user'])
{
  $login = $_SESSION['logged_user']->login;
} else
{
  $login = 'guest';
}
ob_start();
?>


<? require "includes/header.php" ?>

<table class="sort" align="center">
<? require 'includes/edit_task.php'; ?>
	<thead>
		<tr>
			<td>ID</td>
			<? if( $u_group == 'admin' ){ ?>
			<td>Status</td>
			<?} ?>
			<td>Name</td>
			<td>Email</td>
			<td>Task</td>
			<td>Date</td>
		</tr>
	</thead>
<tbody>

<?
 if($query->num_rows > 0){ ?>
     <? while($row = $query->fetch_assoc()){ ?>
         
	<tr>
		<td style="text-align:center;"><?= $row['id'] ?></td>
		<? if( $u_group == 'admin' ){ ?>
        <td><input type="checkbox" <? if( $row['status'] == 'checked' ){ echo $row['status'];}else{ echo ""; } ?>></td>
        <?} ?>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['task'] ?></td>
        <td><?= $row['pubdate'] ?></td>
	</tr>
	<tr>
		<td colspan="6">
			<?}} ?>
    <!-- отображаем ссылки на страницы -->
    <?= $pagination->createLinks(); ?>
<?  ?>
		</td>
	</tr>
</tbody>


	
<tbody>
	<tr>
		<td></td>
		<form method="POST" name="add_task" id="add_task">
			<? if( $u_group == 'admin' ){ ?>
			<td style="padding: 0" >
				<select name="select_checked" id="select_checked">
					<option value="status">status</option>
					<option>checked</option>
					<option>unchecked</option>
				</select>
			</td>
			<?} ?>
			<td style="padding: 0">
				<!-- Если у input стоит значение disabled, то данные из этого поля не передаются в форму -->
				<!-- видимое поле, которое не передаётся -->
				<input type="text" id="name" placeholder="<?= $u_login ?>" value="<?= $u_login ?>" disabled>
				<!-- невидимое поле которое передаётся -->
				<input type="hidden" id="name" name="login" placeholder="<?= $u_login ?>" value="<?= $u_login ?>">
			</td>

			<!-- email -->
			<? if( isset($_SESSION['logged_user']) )
				{ ?>
					<td style="padding: 0;">
						<input type="hidden" id="email" name="u_email" placeholder="<?= $u_email ?>" value="<?= $u_email ?>">
						<select name="select_task" id="select_task">
					
							<option value="выбор задачи">выбор задачи</option>
							<? foreach ( $todo_list as $todo ) { ?>
							<option >
								<?= $todo['task'] ?>
							</option>
							<? } ?>
					
						</select>
					</td>
			
			<?	}else
				{ ?>
					<td style="padding: 0">
						<input type="text" id="email" placeholder="gu@e.st" value="gu@e.st" disabled>
						<input type="hidden" id="email" name="u_email" placeholder="<?= $u_email ?>" value="<?= $u_email ?>">
					</td>						
			<?	} ?>

			<!-- Поле ввода -->
			<td style="padding: 0"><input type="text" name="new_task" id="new_task" placeholder="начните вводить..." autocomplete="off"></td>

			<!-- Кнопки -->
			<td id="cell_buttons">
				
				<? if( isset($_SESSION['logged_user']) )
					{ ?><button type="submit" id="submit" name="do_add" style="background: rgba(250, 100, 1, 0.49)">
							<i class="fa fa-plus"></i>
						</button><button type="submit" id="submit" name="do_edit" style="background: rgba(1, 100, 1, 0.49)">
							<i class="fa fa-pencil-square-o"></i>
						</button><button type="submit" id="submit" name="do_del" style="background: rgba(100, 1, 1, 0.69)">
							<i class="fa fa-trash-o"></i>
						</button>
				<?	}else
					{ ?>
						<button type="submit" id="submit" name="do_add" style="background: rgba(250, 100, 1, 0.49); width: 100%">
							<i class="fa fa-plus"></i>
						</button>
				<?	} ?>
			</td>
		</form>
	</tr>
</tbody>
</table>