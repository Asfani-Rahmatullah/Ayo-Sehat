<?php
require 'Expermit.inc';
if(isset($_GET['kode_dis'])){
    $_SESSION['temp_dis']=intval($_GET['kode_dis']);
    $_SESSION['per']=strval($_GET['per']);
    $_SESSION['bidang']=strval($_GET['bidang']);
    $_SESSION['usname']=strval($_GET['usname']);
}

($_SESSION['temp_dis']);
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
        <li><div class="loggin"><a href="logout.php">Keluar</a></div>
        </li>
        <li><div class="loggin"><a href="profil.php">Profil</a></div>
        <li><div class="loggin"><a href="expert_per_jawaban.php">Dashboard </a></li></div>
        <li><div class="loggin"><a href="list_expert_per.php">Home</a></li></div>
        </li>  
    </ul>
</nav>
<div class="field">
<?php
echo'<p class="tulisan_login">Jawab Pertanyaan</p>';
$temp_per = $_SESSION['per'];
$temp_topik = $_SESSION['bidang'];
$temp_username = $_SESSION['usname'];
echo '<p>Penanya :</p>';
echo "<p>$temp_username</p>";
echo '<p>Topik :</p>';
echo "<p>$temp_topik</p>";
echo '<p>Pertanyaan :</p>';
echo "<p>$temp_per</p>";
echo '<div>';

$sysJawaban='';
$errorJawaban = array();

if (isset($_POST['Post'])) {
    
    require '../validate.inc';

    foreach ($_POST as $key => $value) {
        $isianForm[$key] = $value;
    }
    #($_POST);

    // foreach ($isianForm as $key => $value) {
    //     echo "$key => $value<br>";
    // }
    validateEmpty($errorJawaban, $_POST, 'jawaban_baru');
    if ($errorJawaban) {
        foreach ($errorJawaban as $field => $sysJawaban);
    }
    if ($sysJawaban) {
        formB($sysJawaban);
    }
    else {
            $dbc = new PDO('mysql:host=localhost;dbname=forum','root','');

            $statement = $dbc->prepare("INSERT INTO jawaban (kode_dis,id_user,jawaban)
                                        VALUES (:kode_dis, :id_user, :jawaban)");
            $temp_dis=intval($_SESSION['temp_dis']);
            $temp_id=intval($_SESSION['id']);
            $statement->bindValue(':id_user', $temp_id);
            $statement->bindValue(':jawaban', $_POST['jawaban_baru']);
            $statement->bindValue(':kode_dis', $temp_dis);
            $statement->execute();
            echo 'Jawaban telah ditambah';
    }

}
else 
formB('');

echo '</div>';

    function formB($eJawaban){

        echo '<form action="tambah_jawaban.php"  method="POST">';
        echo '<table>';
        echo '<td><label for="jawaban_baru">Jawaban Anda</label><br></td>';
        echo '<tr>';
        echo "<td><textarea name='jawaban_baru' id='jawaban_baru' rows='5' cols='46' placeholder='Jawaban Anda ..'></textarea></td>";
        echo '</tr>';
        echo '<tr>';
        echo '<td><input type="submit" name="Post" value="Post" class="tombol_login"></td>';
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