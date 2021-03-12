<?php
require 'Expermit.inc';
$dbc = new PDO('mysql:host=localhost;dbname=forum','root','');
$statement = $dbc->prepare("SELECT * FROM user c, jawaban a,diskusi b, topik d WHERE a.id_user = :id AND a.kode_dis = b.kode_dis AND 
                            b.id_user = c.id_user AND b.kode_topik = d.kode_topik GROUP BY b.kode_dis ORDER BY b.kode_dis DESC");
$statement->bindValue(':id', $_SESSION['id']);
$statement->execute();

function jawaban($kode_dis,$conn){
    $jawaban=$conn->prepare("SELECT * FROM jawaban, user 
                             WHERE jawaban.kode_dis = :kode_dis AND jawaban.id_user=user.id_user");
    $jawaban->bindValue(':kode_dis',$kode_dis);
    $jawaban->execute();
    return $jawaban;
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>List Pertanyaan</title>
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
    <h1>Daftar Pertanyaan</h1>
<?php	
if ($statement->rowCount()>0) {
    foreach ($statement as $value) {
        echo "<div class='container2'><span class='topik'>Topik :</span>";
        echo "<p>{$value['bidang']}</p>";
        echo "<span class='topik'>Penanya :</span>";
        echo "<p>  {$value['username']}</p>";
        echo "<span class='topik'>Pertanyaan :</span>";
        echo "<p>  {$value['pertanyaan']}</p></div>";
        $kode_dis=intval($value['kode_dis']);
        $respon = jawaban($kode_dis, $dbc);
        echo "<div class='container3'>";
        foreach ($respon as $row) {
            if ($row['id_user'] == $_SESSION['id']) {
                echo "<p>Direspon oleh :{$row['username']}</p>";
                echo "<p> {$row['jawaban']}</p>";
                $id_jawaban=$row['id_jawaban'];
                echo "<a href='edit_jawaban.php?id_jawaban=$id_jawaban'>Edit Jawaban</a><br>";
                
            }
        }
        echo "</div>";
    }
    
}
else{
    echo "Anda belum menjawab pertanyaan";
}


?>
</div>
</body>
</html>