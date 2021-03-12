<?php
    require 'Expermit.inc'
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
$statement = $dbc->prepare("SELECT * FROM user, dokter WHERE id_user = $id AND user.kode_dr=dokter.kode_dr");
$statement->execute();

$nama='';
$username='';
$email='';
$Spesialis='';
$tPrak='';
$Des='';
foreach ($statement as $row)    
    {
        $nama=$row['nama'];
        $username=$row['username'];
        $email=$row['email'];
        $Spesialis=$row['spesialist'];
        $tPrak=$row['tempat_praktik'];
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
        <li><div class="loggin"><a href="profil.php">Profil</a></div>
        <li><div class="loggin"><a href="expert_per_jawaban.php">Dashboard </a></li></div>
        <li><div class="loggin"><a href="list_expert_per.php">Home</a></li></div>
        </li>  
    </ul>
</nav>
<div class="field">
    <div class="foto">
    <img src="../assets/dokter_ikon.jpg" alt="foto dokter" class="ikon">
    </div>
    <?php
    echo '<div class="profil">';
    echo '<p class="tulisan_login"><b>Profil Dokter</b></p>';
    echo 'Nama : '. $nama.'<br>';
    echo 'Username : '. $username.'<br>';
    echo 'Email : <a href=href="mailto:'.$email.'">'.$email.'</a><br>';
    echo 'Spesialis : '.$Spesialis.'<br>';
    echo 'Tempat Praktik : '.$tPrak.'<br>';
    echo '</div>';
    echo '<div class="deskripsi">';
    echo '<b>Deskripsi Dokter :</b><br>';
    echo $Des.'<br>';
    echo '<button class="tombol_login"><a href="edit_profilEx.php" class="tombol_login">Edit Profil</a></button>';
    ?>
</div>
</body>
</html>