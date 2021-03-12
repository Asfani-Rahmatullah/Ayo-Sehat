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
        <p class="tulisan_login">Daftar Sebagai Expert</p>
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

if (isset($_POST['submit'])) {
    
    require 'validate.inc';

    foreach ($_POST as $key => $value) {
        $isianForm[$key] = $value;
    }
    #($_POST);

    // foreach ($isianForm as $key => $value) {
    //     echo "$key => $value<br>";
    // }
    
    validateName($errorUname, $_POST, 'nama');
    validateUsname($errorUsname, $_POST, 'username');
    validateEmpty($errortPrak, $_POST, 'tPrak');
    validateEmpty($errorDes, $_POST, 'deskripsi');
    validateMail($errorEmail, $_POST,'emailAddress');
    validateNumber($errorNumber, $_POST, 'NomorHP');
    validatePw($errorPw, $_POST, 'password');
    validateCpw($errorCpw, $_POST['password'],  $_POST['confirmPassword'], 'confirmPassword');
    if ($errorUname || $errorDes || $errorUsname || $errorEmail || $errortPrak || $errorNumber || $errorPw || $errorCpw) {
        foreach ($errorUname as $field => $sysUname);
        foreach ($errorUsname as $field => $sysUsname);
        foreach ($errorNumber as $field => $sysNumber);
        foreach ($errortPrak as $field => $systPrak);
        foreach ($errorDes as $field => $systDes);
        foreach ($errorEmail as $field => $sysEmail);
        foreach ($errorPw as $field => $sysPw);
        foreach ($errorCpw as $field => $sysCpw);
    }
    if ($sysUname || $systDes || $sysUsname || $systPrak || $sysEmail || $sysNumber || $sysPw || $sysCpw) {
        formB($sysUname,$sysUsname,$sysEmail,$sysNumber,$systPrak,$systDes,$sysPw,$sysCpw,$isianForm);
        $isianForm['spesialis'] = intval($isianForm['spesialis']);
    }
    else {
            $dbc = new PDO('mysql:host=localhost;dbname=forum','root','');

            $statement = $dbc->prepare("INSERT INTO user (kode_level,kode_dr,nama,username,password,no_hp,email,tempat_praktik,deskripsi)
                                        VALUES (:kode_level, :kode_dr, :nama, :username, SHA2(:password,0), :no_hp, :email, :tPrak, :deskripsi)");
            
            $isianForm['spesialis'] = intval($isianForm['spesialis']);
            $statement->bindValue(':kode_level', 101);
            $statement->bindValue(':kode_dr', $_POST['spesialis']);
            $statement->bindValue(':nama', $_POST['nama']);
            $statement->bindValue(':username', $_POST['username']);
            $statement->bindValue(':email', $_POST['emailAddress']);
            $statement->bindValue(':password', $_POST['password']);
            $statement->bindValue(':no_hp', $_POST['NomorHP']);
            $statement->bindValue(':tPrak', $_POST['tPrak']);
            $statement->bindValue(':deskripsi', $_POST['deskripsi']);
            $statement->execute();
            echo 'Selamat Anda Telah terdaftar sebagai Expert'; 
            echo '<div class="tombol_login tengah"><a href="login.php" class="tengah">Login</a></div>';
    }

}
elseif (isset($_POST['reset'])) {
    formB('','','','','','','','',$isianForm);
}
else formB('','','','','','','','',$isianForm);

echo '</div>';

    function formB($uname, $usname, $email, $noTelp, $tPrak, $Des, $pw, $cpw, $isianForm){

        echo '<form action="regisex.php"  method="POST">';
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
        echo '<td><label for="spesialis">Spesialis</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><select name="spesialis" id="spesialis" class="form_login">
                    <option value=10101>Mata</option>
                    <option value=10102>Penyakit Dalam</option>
                    <option value=10103>Jantung</option>
                    <option value=10104>Paru-paru</option>
                    <option value=10105>Endokrinolog</option>
                    <option value=10106>Kandungan</option>
                    <option value=10107>Bedah</option>
                    <option value=10108>Anak</option>
                    <option value=10109>Saraf</option>
                    <option value=10110>Tulang</option>
                    <option value=10111>Kulit dan Kelamin</option>
                    <option value=10112>Telinga Hidung dan Tenggorokan</option>
                    <option value=10113>Gigi</option>
                </select></td>';
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
        echo '</tr>';
        echo '<td><label for="tPrak">Tempat Praktik</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><input type="text" name="tPrak" id="tPrak" value="'.$isianForm['tPrak'].'" placeholder="Tempat Praktik .."></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label class="peringatan" for="tPrak">'.$tPrak.'</label></td>';
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