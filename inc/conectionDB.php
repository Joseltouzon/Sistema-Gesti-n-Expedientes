<?php
	if($_GET['admin']!='ok'){
		error_reporting(0);	
	}

	if($_SERVER['HTTP_HOST']!='localhost:8888'){
		// prod
		define('DB_SERVER','localhost');
		define('DB_USER','c1721188_exped');
		define('DB_PASSWORD','16vegotiGU');
		define('DB_NAME','c1721188_exped');
	}else{
		// dev
		define('DB_SERVER','localhost');
		define('DB_USER','root');
		define('DB_PASSWORD','root');
		define('DB_NAME','expedientes');
	}



	class DB_con{
	 function __construct(){
	  		$conn = mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die('error connecting to server'.mysql_error());
	 		mysql_select_db(DB_NAME, $conn) or die('error connecting to database->'.mysql_error());
	 	}
	}
?>