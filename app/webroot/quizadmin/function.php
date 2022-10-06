<?php

session_start();
function demo()
{
   if(isset($_SESSION['name'])|| isset($_COOKIE['name']))
     {
	     $demo=true;
		 return $demo;
	}
}


?>