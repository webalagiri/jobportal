<?php 
	$server		=	"127.0.0.1";
	$user		=	"root";
	$password	=	"";
	$dbname		=	"ri_jobportal";
	
	$connection	=	mysql_connect($server,$user,$password) or die("not Server not connected"); 
	$database	=	mysql_select_db($dbname) or die("Data base not connected");
?>
                            
						