<?php
	if(isset($_POST['Logout'])){
		session_start();
        session_unset();
        header("Location: http://{$_SERVER['HTTP_HOST']}/Ayo Sehat/index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Utama</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
<nav id="menu">
     <ul>
        <div id="heading">
            <a href="#">Ayo Sehat</a>
        </div>
    </ul>
</nav>
<div class="field">
<?php
echo '<div>';
echo '</div>';
echo '<form action="logout.php"  method="POST">';
echo '<input type="submit" name="Logout" value="Log Out ?" class="tombol_login"></td>';
echo '</form>';
?>
</div>
</div>
</body>
</html>