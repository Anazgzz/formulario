<?php 

require_once("../application/models/applicationModel.php");
require_once("../application/models/usersModel.php");

$config=readConfig('../application/configs/config.ini', 'testing');

// Inicializaciones
$arrayUser=initArrayUser();


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
			$imageName=updateImage($_FILES, $_GET['id']);
			updateToFile($imageName, $_GET['id']);
			header ("Location: users.php?action=select");
			exit();
		}
		else
		{
			$arrayUser=readUser($_GET['id']);			
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
			include("../application/views/formulario.php");
		}
			
	break;
	case 'delete':
		if($_POST)
		{
			if($_POST['submit']=='si')
			{
				deleteUser($_GET['id']);
				header ("Location: users.php?action=select");
				exit();
			}
			else
			{
				header ("Location: users.php?action=select");
				exit();
			}
				
		}
		else
		{
			include("../application/views/delete.php");
		}
	break;
	case 'select':
		$arrayUsers=readUsersFromFile();	
		include("../application/views/select.php");
	default:
	break; 
}






