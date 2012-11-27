<?php 

/**
 * Read config file to array
 * @param string $configFile Config filename
 * @param string $context Context
 * @return array: Config context array
 */
function readConfig($configFile, $context)
{	
// 	Leer el .ini
	$arrayConfigs = parse_ini_file($configFile, true);
	
// 	Obtener las llaves
	$arrayKeys=array_keys($arrayConfigs);
	
// 	Para cada llave
	foreach($arrayKeys as $keys)
	{
// 		Obtener key
// 		Obtener subkey
		$arrayKey=explode(':',$keys);
		if($context == $arrayKey[0])
		{
			$key=$arrayKey[0];
			if(isset($arrayKey[1]))
				$subkey=$arrayKey[1];
		}		
			
	}
	if(isset($subkey))
		$arrayConfig=array_merge($arrayConfigs[$subkey],
								$arrayConfigs[$key.":".$subkey]								 
					 );
	else
		$arrayConfig=$arrayConfigs[$key];
	
	return $arrayConfig;
}