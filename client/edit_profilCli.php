<?php
    require 'Clienpermit.inc'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Profil | Client</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    </head>

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
        <p class="tulisan_login">Edit Profil | Client</p>
<?php
echo '<div>';
                
$errorUname = $errorEmail = $errorDes = $errorUsname = $errortPrak = $errorNumber = $errorPw = $errorCpw = array();
$sysUname = $sysUsname = $systPrak = $systDes = $sysEmail = $sysNumber = $sysPw = $sysCpw = '';

$isianForm['nama'] = "";
$isianForm['username']="";
$isianForm['deskripsi']="";
$isianForm['tPrak']="";
$isianForm['emailAddress'] = "";
$isianForm['NomorHP'] = "";
$isianForm['password'] = "";
$isianForm['confirmPassword'] = "";
$dbc = new PDO('mysql:host=localhost;dbname=forum','root','');
$id=intval($_SESSION['id']);
$statement = $dbc->prepare("SELECT * FROM user, dokter WHERE id_user = $id");
$statement->execute();

foreach ($statement as $row)    
    {
        $isianForm['nama']=$row['nama'];
        $isianForm['username']=$row['username'];
        $isianForm['emailAddress']=$row['email'];
        $isianForm['deskripsi']=$row['deskripsi'];
        $isianForm['NomorHP']=$row['no_hp'];
    }

if (isset($_POST['submit'])) {
    
    require '../validate.inc';

    foreach ($_POST as $key => $value) {
        $isianForm[$key] = $value;
    }
    #($_POST);

    // foreach ($isianForm as $key => $value) {
    //     echo "$key => $value<br>";
    // }
    
    validateName($errorUname, $_POST, 'nama');
    UpUsname($errorUsname, $_POST, 'username');
    validateEmpty($errorDes, $_POST, 'deskripsi');
    UpeMail($errorEmail, $_POST,'emailAddress');
    validateNumber($errorNumber, $_POST, 'NomorHP');
    validatePw($errorPw, $_POST, 'password');
    validateCpw($errorCpw, $_POST['password'],  $_POST['confirmPassword'], 'confirmPassword');
    if ($errorUname || $errorDes || $errorUsname || $errorEmail || $errorNumber || $errorPw || $errorCpw) {
        foreach ($errorUname as $field => $sysUname);
        foreach ($errorUsname as $field => $sysUsname);
        foreach ($errorNumber as $field => $sysNumber);
        foreach ($errorDes as $field => $systDes);
        foreach ($errorEmail as $field => $sysEmail);
        foreach ($errorPw as $field => $sysPw);
        foreach ($errorCpw as $field => $sysCpw);
    }
    if ($sysUname || $systDes || $sysUsname || $sysEmail || $sysNumber || $sysPw || $sysCpw) {
        formB($sysUname,$sysUsname,$sysEmail,$sysNumber,$systDes,$sysPw,$sysCpw,$isianForm);
    }
    else {
            $dbc = new PDO('mysql:host=localhost;dbname=forum','root','');

            $statement = $dbc->prepare("UPDATE user SET
                                        nama=:nama, username=:username,password=SHA2(:password,0),no_hp=:no_hp,
                                        email=:email,deskripsi=:deskripsi WHERE id_user = $id");
            
            $statement->bindValue(':nama', $_POST['nama']);
            $statement->bindValue(':username', $_POST['username']);
            $statement->bindValue(':email', $_POST['emailAddress']);
            $statement->bindValue(':password', $_POST['password']);
            $statement->bindValue(':no_hp', $_POST['NomorHP']);
            $statement->bindValue(':deskripsi', $_POST['deskripsi']);
            $statement->execute();
            echo 'Profil Telah Diperbaharui'; 
            echo '<div class="tombol_login tengah"><a href="profil_client.php" class="tengah">Profil</a></div>';
    }

}
elseif (isset($_POST['reset'])) {
    formB('','','','','','','',$isianForm);
}
else formB('','','','','','','',$isianForm);

echo '</div>';

    function formB($uname, $usname, $email, $noTelp, $Des, $pw, $cpw, $isianForm){

        echo '<form action="edit_profilCli.php"  method="POST">';
        echo '<table">';     
        echo '<tr>';
        echo '<td><label for="nama">Nama</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><input type="text" name="nama" id="nama" value="'.$isianForm['nama'].'" placeholder="Nama .."></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label class="peringatan" for="nama">'.$uname.'</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label for="nama">Username</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><input type="text" name="username" id="username" value="'.$isianForm['username'].'" placeholder="Username .."></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label class="peringatan" for="username">'.$usname.'</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label for="emailAddress">Alamat Email</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><input type="text" name="emailAddress" id="emailAddress" value="'.$isianForm['emailAddress'].'" placeholder="Alamat Email .."></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label class="peringatan" for="emailAddress">'.$email.'</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label for="NomorHP">Nomor Handphone</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><input type="text" name="NomorHP" id="NomorHP" value="'.$isianForm['NomorHP'].'" placeholder="Nomor Handphone .."></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label class="peringatan" for="NomorHP">'.$noTelp.'</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label for="deskripsi">Deskripsi Diri</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><textarea name="deskripsi" id="deskripsi" rows="5" cols="46" value="'.$isianForm['deskripsi'].'" placeholder="Deskripsi .."></textarea></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label class="peringatan" for="deskripsi">'.$Des.'</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label for="password">Password</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><input type="password" name="password" id="password" value="'.$isianForm['password'].'" placeholder="Password .."></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label class="peringatan" for="password">'.$pw.'</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label for="confirmPassword">Konfirmasi Password</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><input type="password" name="confirmPassword" id="confirmPassword" value="'.$isianForm['confirmPassword'].'" placeholder="Konfirmasi Password .."></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label class="peringatan" for="confirmPassword">'.$cpw.'</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><input type="submit" name="submit" value="submit" class="tombol_login"><input type="submit" name="reset" value="reset" class="tombol_login"></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td></td>';
        echo '</tr>';
        echo '</table>';
        echo '</form>';
        }


    ?>
    </div>
</div>
</body>
</html>