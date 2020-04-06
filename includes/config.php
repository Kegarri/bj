<?
$config = array(
			'db'		=> array(
			'server'	=>	'localhost',
			'username'	=>	'root',
			'password'	=>	'Programmer',
			'name'		=>	'todo'
			)
	);
require "db.php";
require "Pagination.class.php";
//R::setup( 'mysql:host=localhost;dbname=kirigaya','tododo', 'Programmerdb2k18' ); //вкл при загрузке на хост
R::setup( 'mysql:host=localhost;dbname=todo','root', 'Programmer' ); //вкл на локальном серве

// плагин для использовния имени таблицы в camel_case 
R::ext('xdispense', function($table_name)
{
	return R::getRedBean()->dispense($table_name);
});

// параметры пагитатора
$limit = 3;
$offset = !empty($_GET['page'])?(($_GET['page']-1)*$limit):0;

$queryNum = mysqli_query($connection, "SELECT COUNT(*) as id FROM tasks");
$resultNum = $queryNum->fetch_assoc();
$rowCount = $resultNum['id'];

//инициализируем класс pagination
$pagConfig = array(
 'baseURL'=>'/',
 'totalRows'=>$rowCount,
 'perPage'=>$limit
);
$pagination =  new Pagination($pagConfig);

// получение записей
$query = mysqli_query($connection, "SELECT * FROM tasks ORDER BY id DESC LIMIT $offset,$limit");

// забивание данных пользователя в переменные
if( isset($_SESSION['logged_user']) )
{	
	$u_email = $_SESSION['logged_user']->email;
	$u_login = $_SESSION['logged_user']->login;
}else
{
	$u_email = 'gu@e.st';
	$u_login = 'Guest';
}

$u_group = $_SESSION['logged_user']->u_group;
$u_pass = $_SESSION['logged_user']->password;

// автоматическая чистка устаревших данных
$count_login = R::count('ulogin');
if($count_login > 10){
  R::exec('DELETE FROM ulogin WHERE join_date < NOW() - INTERVAL 10 DAY');
}

//Вывод списка задач
$todo_list_q = mysqli_query($connection, "SELECT * FROM `tasks` ORDER BY `id` DESC LIMIT 10");
$todo_list = array();
  while ($todo = mysqli_fetch_assoc($todo_list_q) )
  {
    $todo_list[] = $todo;
  }

//Вывод простых пользователей
$u_list_q = mysqli_query($connection, "SELECT * FROM `users` WHERE `u_group` = 'user' ORDER BY `id` DESC LIMIT 10");
$u_list = array();
  while ($list = mysqli_fetch_assoc($u_list_q) )
  {
    $u_list[] = $list;
  }

?>