<?php
    require 'Clienpermit.inc'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayo Sehat</title>
    <link rel="stylesheet" type="text/css" href="../profil.css">
</head>
<?php
$dbc = new PDO('mysql:host=localhost;dbname=forum','root','');
$id=intval($_SESSION['id']);
$statement = $dbc->prepare("SELECT * FROM user, dokter WHERE id_user = $id AND kode_level=102");
$statement->execute();

$nama='';
$username='';
$email='';
$Des='';
foreach ($statement as $row)    
    {
        $nama=$row['nama'];
        $username=$row['username'];
        $email=$row['email'];
        $Des=$row['deskripsi'];
    }
?>
<body>
<nav id="menu">
     <ul>
     <div id="heading">
            <a href="#">Ayo Sehat</a>
        </div>
        <li><div class="loggin"><a href="../logout.php">Keluar</a></div>
        </li>
        <li><div class="loggin"><a href="profil_client.php">Profil</a></div>
        <li><div class="loggin"><a href="pertanyaan_client.php">Tanya</a></li></div>
        <li><div class="loggin"><a href="client_per.php">Dashboard </a></li></div>
        <li><div class="loggin"><a href="list_per_client.php">Home</a></li></div>
        </li>  
    </ul>
</nav>
<div class="field">
    <div class="foto">
    <img src="../assets/client_ikon.jpg" alt="foto client" class="ikon">
    </div>
    <?php
    echo '<div class="profil">';
    echo '<p class="tulisan_login"><b>Profil Client</b></p>';
    echo 'Nama : '. $nama.'<br>';
    echo 'Username : '. $username.'<br>';
    echo 'Email : <a href="mailto:'.$email.'">'.$email.'</a><br>';
    echo '</div>';
    echo '<div class="deskripsi">';
    echo '<b>Deskripsi Diri :</b><br>';
    echo $Des.'<br>';
    echo '<button class="tombol_login"><a href="edit_profilCli.php" class="tombol_login">Edit Profil</a></button>';
    ?>
</div>
</body>
</html>