<?php
	session_start();
	if (!isset($_SESSION['kode_level']) || $_SESSION['kode_level'] != '101'){
		//user akan diarahkan ke halaman login untuk authorization
		header("Location: http://{$_SERVER['HTTP_HOST']}/Ayo Sehat/login.php");
		exit();
}
?>