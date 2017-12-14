<?php 
session_start();

if(isset($_SESSION['ID'])){ 
	header('location:../index.php?source=postproperty');
	exit();
}else{
	header('location:../index.php?source=loginandregister');
	exit();
}

	?>