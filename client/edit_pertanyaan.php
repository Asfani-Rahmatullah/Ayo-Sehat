<?php
require 'Clienpermit.inc';
if(isset($_GET['kode_dis'])){
    $_SESSION['temp_dis']=intval($_GET['kode_dis']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard | Client</title>
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
        <p class="tulisan_login">Edit Pertanyaan</p>
        <?php
echo '<div>';
                
$errorPer = array();
$conn = new PDO('mysql:host=localhost;dbname=forum','root','');
$selper = $conn->prepare("SELECT * FROM diskusi
                WHERE kode_dis = :temp_dis;");
$selper->bindValue('temp_dis',$_SESSION['temp_dis']);
$selper->execute();
$temp_per = '';
foreach ($selper as $isi) {
        $temp_per=$isi['pertanyaan'];
}


$isianForm['pertanyaan']="";
$sysPer='';

if (isset($_POST['Update'])) {
    
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
        formB($sysPer,$temp_per);
    }
    else {
            $dbc = new PDO('mysql:host=localhost;dbname=forum','root','');

            $statement = $dbc->prepare(" UPDATE diskusi SET kode_topik = :kode_topik, pertanyaan = :pertanyaan WHERE kode_dis = :temp_dis");
            
            $topik=intval($_POST['topik']);
            $temp_dis=intval($_SESSION['temp_dis']);
            $statement->bindValue(':kode_topik', $topik);
            $statement->bindValue(':pertanyaan', $_POST['pertanyaan']);
            $statement->bindValue(':temp_dis', $temp_dis);
            $statement->execute();
            echo 'Pertanyaan telah diperbaharui';
    }

}
else 
formB('',$temp_per);

echo '</div>';

    function formB($Per,$temp_per){

        echo '<form action="edit_pertanyaan.php"  method="POST">';
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
        echo "<td><textarea name='pertanyaan' id='pertanyaan' rows='5' cols='46' placeholder='$temp_per'></textarea></td>";
        echo '</tr>';
        echo '<tr>';
        echo "<td><label class='peringatan' for='pertanyaan'>$Per</label></td>";
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><input type="submit" name="Update" value="Update" class="tombol_login"></td>';
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