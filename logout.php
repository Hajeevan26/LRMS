<?php
	session_start();
	session_destroy();//to destroy all the session values
	header('Location:index.php');//redirect to index page	
?>
