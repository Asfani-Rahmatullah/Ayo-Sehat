<?php
session_start();
$dbc = new PDO('mysql:host=localhost;dbname=forum','root','');
	//require 'adminPermission.inc';
	if(isset($_POST['Login'])){
		function checkPassword($email, $password){
			$dbc = new PDO('mysql:host=localhost;dbname=forum','root','');
			$query = $dbc->prepare("SELECT * FROM user WHERE email = :email AND password = SHA2(:password, 0)");
			$query->bindValue(':email', $_POST['emailAddress']);
			$query->bindValue(':password', $_POST['password']);
            $query->execute();
			return $query->rowCount() > 0;
		}
		if (checkPassword($_POST['emailAddress'], $_POST['password'])){

            $query = $dbc->prepare("SELECT * FROM user WHERE email = :email AND password = SHA2(:password, 0)");
            $query->bindValue(':email', $_POST['emailAddress']);
			$query->bindValue(':password', $_POST['password']);
            $query->execute();
            
            foreach ($query as $row)    
                {
                    $id=$row['id_user'];
                    $level=$row['kode_level'];
                }
            $_SESSION['id'] = intval($id);
            $_SESSION['kode_level'] = intval($level);
            if ($level=='101') {
                header("Location: http://{$_SERVER['HTTP_HOST']}/Ayo Sehat/expert/profil.php");
                exit();
            }
            else if($level=='102'){
                header("Location: http://{$_SERVER['HTTP_HOST']}/Ayo Sehat/client/list_per_client.php");
                exit();
            }
            
            #header('Location: http://localhost/TM 4/private1.php');
        }
        else {
            header("Location: http://{$_SERVER['HTTP_HOST']}/Ayo Sehat/login.php?login-gagal");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Utama</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<nav id="menu">
     <ul>
        <div id="heading">
            <a href="#">Ayo Sehat</a>
        </div>
        <li><div class="loggin"><a href="login.php">Masuk</a></div>
        </li>
        <li><div class="loggin"><a href="#">Mendaftar</a></div>
            <ul>
                <li> <a href="regisclient.php">Client</a></li>
                <li> <a href="regisex.php">Expert </a></li>
            </ul>
        </li>  
    </ul>
</nav>
<div class="field">
        <p class="tulisan_login">Masuk</p>
<?php
echo '<div>';
echo '</div>';
echo '<form action="login.php"  method="POST">';
echo '<table">';
echo '<tr>';
echo '<td><label for="emailAddress">Alamat Email</label></td>';
echo '</tr>';
echo '<tr>';
echo '<td><input type="text" name="emailAddress" id="emailAddress" placeholder="Alamat Email .."></td>';
echo '</tr>';
echo '<tr>';
echo '<td><br></td>';
echo '</tr>';
echo '<tr>';
echo '<td><label for="password">Password</label></td>';
echo '</tr>';
echo '<tr>';
echo '<td><input type="password" name="password" id="password" placeholder="Password .."></td>';
echo '</tr>';
echo '<tr>';
echo '<td><br></td>';
echo '</tr>';
if (isset($_GET['login-gagal'])) {
    echo '<tr>';
    echo '<td><p class="peringatanLog">Proses Gagal<br> Silahkan Masukkan email dan password dengan benar</p></td>';
    echo '</tr>';
}
echo '<tr>';
echo '<td><br></td>';
echo '</tr>';
echo '<tr>';
echo '<td><input type="submit" name="Login" value="Login" class="tombol_login"></td>';
echo '</tr>';
echo '<tr>';
echo '</tr>';
echo '</table>';
echo '</form>';
?>
    <!--<form name="myForm" action="profil.php" method="POST" >  

        <label>Email :</label>
        <input type="text" name="email" class="form_login" placeholder="Email..">

        <label>Password</label>
        <input type="password" name="password" class="form_login" placeholder="Password ..">
    
        <input type="submit" class="tombol_login" value="Login" name="submit">
        <br>
        <br>
        <center>
			<a class="link" href="regisclient.php">Sudah punya akun ?</a>
        </center>
    </form>
    -->
    </div>
</div>
</body>
</html>