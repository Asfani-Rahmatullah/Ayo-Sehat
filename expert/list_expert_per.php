<?php
require 'Expermit.inc';
function jawaban($kode_dis,$conn){
    $jawaban=$conn->prepare("SELECT jawaban, username FROM diskusi, jawaban, user 
                             WHERE jawaban.kode_dis = :kode_dis AND jawaban.id_user=user.id_user AND jawaban.kode_dis=diskusi.kode_dis");
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
$dbc = new PDO('mysql:host=localhost;dbname=forum','root','');	
$query = $dbc->prepare("SELECT username, kode_dis, diskusi.kode_topik, bidang, pertanyaan FROM diskusi, topik, user 
                        WHERE diskusi.kode_topik = topik.kode_topik AND diskusi.id_user=user.id_user ORDER BY kode_dis DESC");
$query->execute();
if ($query->rowCount()>0) {
    foreach ($query as $row) {
        echo "<div class='container2'><span class='topik'>Topik :</span>";
        echo "<p>{$row['bidang']}</p>";
        echo "<span class='topik'>Penanya :</span>";
        echo "<p>  {$row['username']}</p>";
        echo "<span class='topik'>Pertanyaan :</span>";
        echo "<p>  {$row['pertanyaan']}</p></div>";
        $bidang=$row['bidang'];
        $usname=$row['username'];
        $per=$row['pertanyaan'];
        $kode_dis=intval($row['kode_dis']);
        $respon = jawaban($row['kode_dis'], $dbc);
        echo "<div class='container3'>";
        if ($respon->rowCount() >= 1 ) {
            foreach ($respon as $row2) {
                echo "<p>Direspon oleh :{$row2['username']}</p>";
                echo "<p> {$row2['jawaban']}</p>";
            }
            echo "<a href='tambah_jawaban.php?kode_dis=$kode_dis&bidang=$bidang&usname=$usname&per=$per'>Jawab Pertanyaan</a>";
            
        } 
        else {
            echo "<li class='daftar'>Belum ada Respon<br>";
            echo "<a href='tambah_jawaban.php?kode_dis=$kode_dis&bidang=$bidang&usname=$usname&per=$per'>Jawab Pertanyaan</a>";
            echo "</li>";
        }
        echo "</div><br>";
    }
} else {
    echo 'Belum ada pertanyaan'; 
}


?>
</div>
</body>
</html>