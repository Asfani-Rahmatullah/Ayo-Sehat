<?php
require 'Clienpermit.inc';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard | Client</title>
	<link rel="stylesheet" href="../style.css">
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
        <p class="tulisan_login">Ajukan Pertanyaan</p>
        <?php
echo '<div>';
                
$errorPer = array();
$sysPer = '';

$isianForm['pertanyaan']="";

if (isset($_POST['submit'])) {
    
    require '../validate.inc';

    foreach ($_POST as $key => $value) {
        $isianForm[$key] = $value;
    }
    #($_POST);

    // foreach ($isianForm as $key => $value) {
    //     echo "$key => $value<br>";
    // }
    validateEmpty($errorPer, $_POST, 'pertanyaan');
    if ($errorPer) {
        foreach ($errorPer as $field => $sysPer);
    }
    if ($sysPer) {
        formB($sysPer);
    }
    else {
            $dbc = new PDO('mysql:host=localhost;dbname=forum','root','');

            $statement = $dbc->prepare("INSERT INTO diskusi (id_user,kode_topik,pertanyaan)
                                        VALUES (:id_user, :kode_topik, :pertanyaan)");
            
            $topik=intval($_POST['topik']);
            $statement->bindValue(':id_user', $_SESSION['id']);
            $statement->bindValue(':kode_topik', $topik);
            $statement->bindValue(':pertanyaan', $_POST['pertanyaan']);
            $statement->execute();
            echo 'Pertanyaan telah dikirim';
    }

}
else 
formB('');

echo '</div>';

    function formB($Per){

        echo '<form action="pertanyaan_client.php"  method="POST">';
        echo '<table">';     
        echo '<tr>';
        echo '<td><label for="topik">Topik</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><select name="topik" id="topik" class="form_login">
                    <option value=1>Kesehatan Mata</option>
                    <option value=2>Penyakit Dalam</option>
                    <option value=3>Kesehatan Jantung</option>
                    <option value=4>Kesehatan Paru-paru</option>
                    <option value=5>Endokrinolog</option>
                    <option value=6>Kesehatan Kandungan</option>
                    <option value=7>Bedah</option>
                    <option value=8>Kesehatan Anak</option>
                    <option value=9>Kesehatan Saraf</option>
                    <option value=10>Kesehatan Tulang</option>
                    <option value=11>Kesehatan Kulit dan Kelamin</option>
                    <option value=12>Kesehatan Telinga Hidung dan Tenggorokan</option>
                    <option value=13>Kesehatan Gigi</option>
                </select></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label for="pertanyaan">Pertanyaan</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><textarea name="pertanyaan" id="pertanyaan" rows="5" cols="46" placeholder="Pertanyaan .."></textarea></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label class="peringatan" for="pertanyaan">'.$Per.'</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><input type="submit" name="submit" value="submit" class="tombol_login"></td>';
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