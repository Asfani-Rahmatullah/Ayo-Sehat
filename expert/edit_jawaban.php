<?php
require 'Expermit.inc';
if(isset($_GET['id_jawaban'])){
    $_SESSION['temp_jawaban']=intval($_GET['id_jawaban']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Jawaban | Expert</title>
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
        <li><div class="loggin"><a href="profil.php">Profil</a></div>
        <li><div class="loggin"><a href="expert_per_jawaban.php">Dashboard </a></li></div>
        <li><div class="loggin"><a href="list_expert_per.php">Home</a></li></div>
        </li>  
    </ul>
</nav>
<div class="field">
        <p class="tulisan_login">Edit Jawaban</p>
        <?php
echo '<div>';
                
$errorPer = array();
$conn = new PDO('mysql:host=localhost;dbname=forum','root','');
$selper = $conn->prepare("SELECT username, bidang, pertanyaan FROM diskusi, jawaban, user, topik
                        WHERE id_jawaban = :temp_jawaban AND jawaban.kode_dis=diskusi.kode_dis 
                        AND diskusi.id_user=user.id_user AND diskusi.kode_topik=topik.kode_topik");
$selper->bindValue('temp_jawaban',$_SESSION['temp_jawaban']);
$selper->execute();
$temp_user = '';
$temp_top = '';
$temp_per = '';
foreach ($selper as $isi) {
        $temp_per=$isi['pertanyaan'];
        $temp_top=$isi['bidang'];
        $temp_user=$isi['username'];
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
    
    validateEmpty($errorPer, $_POST, 'jawaban');
    if ($errorPer) {
        foreach ($errorPer as $field => $sysPer);
    }
    if ($sysPer) {
        formB($sysPer,$temp_per);
    }
    else {
            $dbc = new PDO('mysql:host=localhost;dbname=forum','root','');

            $statement = $dbc->prepare(" UPDATE jawaban SET jawaban = :jawaban, id_user=:id_user WHERE id_jawaban = :temp_jawaban");

            $temp_jawaban=intval($_SESSION['temp_jawaban']);
            $id_user=intval($_SESSION['id']);
            $statement->bindValue(':jawaban', $_POST['jawaban']);
            $statement->bindValue(':temp_jawaban', $temp_jawaban);
            $statement->bindValue(':id_user', $id_user);
            $statement->execute();
            echo 'Jawaban telah diperbaharui';
    }

}
else 
formB('',$temp_top,$temp_user,$temp_per);

echo '</div>';

    function formB($Per,$temp_top,$temp_user,$temp_per){

        echo '<form action="edit_jawaban.php"  method="POST">';
        echo '<table">';     
        echo '<tr>';
        echo "<td><label for='topik'>Topik</label></td>";
        echo '</tr>';
        echo '<tr>';
        echo "<td><label for='topik'>$temp_top</label></td>";
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo "<td><label for='username'>Penanya</label></td>";
        echo '</tr>';
        echo '<tr>';
        echo "<td><label for='username'>$temp_user</label></td>";
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo "<td><label for='partanyaan'>Pertanyaan</label></td>";
        echo '</tr>';
        echo '<tr>';
        echo "<td><label for='pertanyaan'>$temp_per</label></td>";
        echo '</tr>';
        echo '<tr>';
        echo '<td><br></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><label for="pertanyaan">Jawaban Baru</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo "<td><textarea name='jawaban' id='jawaban' rows='5' cols='46' placeholder='Jawaban ..'></textarea></td>";
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