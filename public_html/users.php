<?php 

require_once("../application/models/applicationModel.php");
require_once("../application/models/usersModel.php");

$config=readConfig('../application/configs/config.ini', 'production');

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
			$imageName=updateImage($_FILES, $_GET['id'], $config['filename']);
			updateToFile($imageName, $_GET['id'], $config['filename']);
			header ("Location: users.php?action=select");
			exit();
		}
		else
		{
			$arrayUser=readUser($_GET['id'], $config['filename']);			
		}

	case 'insert':
		if($_POST)
		{			
			$imageName=uploadImage($_FILES, $config['uploadDirectory']);
			writeToFile($imageName, $config['filename']);
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
				deleteUser($_GET['id'], $config['filename']);
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
		$arrayUsers=readUsersFromFile($config['filename']);	
		include("../application/views/select.php");
	default:
	break; 
}






