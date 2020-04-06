<?
$connection = mysqli_connect(
	$config['db']['server'],
	$config['db']['username'],
	$config['db']['password'],
	$config['db']['name']
);

if( $connection == false )
{
	require "errorb.php";
	echo mysqli_connect_error();
	exit();
}

require "rb.php";
session_start(); // ready to go!
?>