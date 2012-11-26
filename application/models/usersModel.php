<?php

/**
 * Uload image 
 * @param array $_FILES Array FILES
 * @return string Image final name
 */
function uploadImage($_FILES)
{
	//TODO: Read from config.ini
	$uploadDirectory=$_SERVER['DOCUMENT_ROOT']."/uploads";	
	$destination = $uploadDirectory."/".$_FILES['photo']['name'];
	$filename = $_FILES['photo']['tmp_name'];
	$path_parts = pathinfo($destination);
	$name=$path_parts['filename'].".".$path_parts['extension'];
	$i=0;
	while(in_array($name,scandir($uploadDirectory)))
	{
		$i++;
		$name=$path_parts['filename']."_".$i.".".$path_parts['extension'];
	}	
	$destination = $uploadDirectory."/".$name;
	move_uploaded_file($filename, $destination);
	return $name;
}

/**
 * White users to .txt file
 * @param string $imageName Image name
 */
function writeToFile($imageName)
{
	foreach($_POST as $value)
	{
		if(is_array($value))
			$value=implode(',',$value);	
		$arrayUser[]=$value;	
	}
	$arrayUser[]=$imageName;
	$textUser=implode('|',$arrayUser);
	file_put_contents("users.txt", $textUser."\r\n", FILE_APPEND);
}

/**
 * Read users from file 
 * @return array: Users array
 */
function readUsersFromFile()
{
	//TODO: Read from config.ini
	$filename="users.txt";
	$usersText=file_get_contents($filename);
	$arrayUsers=explode("\n",$usersText);	
	return $arrayUsers;
}

/**
 * Read user from file to array
 * @param int $id User id: line number
 * @return array: User array
 */
function readUser($id)
{
	$arrayUsers=readUsersFromFile();
	$arrayUser=$arrayUsers[$_GET['id']];
	$arrayUser=explode("|",$arrayUser);
	return $arrayUser;
}


function iniArrayUser()
{
	$arrayUser=array();
	return $arrayUser;
}
