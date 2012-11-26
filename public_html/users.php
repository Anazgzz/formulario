<?php 

require_once("../application/models/applicationModel.php");
require_once("../application/models/usersModel.php");

$config=readConfig('../application/configs/config.ini', 'development');

if(isset($_GET['action']))
	$action=$_GET['action'];
else
	$action='select';

switch($action)
{
	case 'update':
// 		die("esto es update");
		if ($_POST)
		{
			
		}
		else
		{
			$arrayUser=readUser($_GET['id']);
			echo "<pre>";
			print_r($arrayUser);
			echo "</pre>";
		}

	case 'insert':
		if($_POST)
		{			
			$imageName=uploadImage($_FILES);
			writeToFile($imageName);
			header ("Location: users.php?action=select");
			exit();
		}
		else
		{
// 			de finir arrayUser
			
			include("../application/views/formulario.php");
		}
			
	break;
	case 'delete':
	break;
	case 'select':
		$arrayUsers=readUsersFromFile();	
		include("../application/views/select.php");
	default:
	break; 
}






