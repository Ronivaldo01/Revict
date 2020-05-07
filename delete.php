<?php 

	require"banco.php";
	$id = $_GET['id'];
	$pdo = Banco::conectar();
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM usuarios WHERE id = ".$id;
	$d = $pdo->prepare($sql);
	$d->execute();
	 



	
	



