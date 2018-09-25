<?php
	// Open file .env
	$file = fopen('../../.env', 'r');

	if($file) {
		while(!feof($file)){
	        $line = fgets($file, 4096);
	        $str_arr = explode('=', $line);

	        // Get db config
	        if ($str_arr[0] == "DB_CONNECTION") $conn = trim($str_arr[1]);
	        if ($str_arr[0] == "DB_HOST") $host = trim($str_arr[1]);
	        if ($str_arr[0] == "DB_PORT") $port = trim($str_arr[1]);
	        if ($str_arr[0] == "DB_DATABASE") $db = trim($str_arr[1]);
	        if ($str_arr[0] == "DB_USERNAME") $user = trim($str_arr[1]);
	        if ($str_arr[0] == "DB_PASSWORD") $pwd = trim($str_arr[1]);
	    }

	    fclose($file);
	}

	// Set connect db
	$db = new PDO($conn. ":host=" .$host ."; dbname=" .$db. "; charset=utf8", $user, $pwd);
    $db->exec("set names utf8");
    $db->exec("COLLATE utf8_general_ci");