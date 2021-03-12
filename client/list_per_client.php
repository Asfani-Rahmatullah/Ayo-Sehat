<?php
require 'Clienpermit.inc';
function jawaban($kode_dis,$conn){
    $jawaban=$conn->prepare("SELECT jawaban, username FROM diskusi, jawaban, user 
                             WHERE jawaban.kode_dis = :kode_dis AND jawaban.id_user=user.id_user AND jawaban.kode_dis = diskusi.kode_dis");
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
	<title>Ayo Sehat</title>
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
<h1>Daftar Pertanyaan</h1>
<?php
$dbc = new PDO('mysql:host=localhost;dbname=forum','root','');	
$query = $dbc->prepare("SELECT username, kode_dis, diskusi.kode_topik, bidang, pertanyaan FROM diskusi, topik, user 
                        WHERE  diskusi.id_user = user.id_user AND diskusi.kode_topik = topik.kode_topik ORDER BY kode_dis DESC");
$query->execute();
foreach ($query as $row) {
    echo "<div class='container2'><span class='topik'>Topik :</span>";
    echo "<p>{$row['bidang']}</p>";
    echo "<span class='topik'>Penanya :</span>";
    echo "<p>  {$row['username']}</p>";
    echo "<span class='topik'>Pertanyaan :</span>";
    echo "<p>  {$row['pertanyaan']}</p></div>";
    echo "<div class=container3>";
    $respon = jawaban($row['kode_dis'], $dbc);
    if ($respon->rowCount() >= 1 ) {
        echo "<li class='daftar'>";
        foreach ($respon as $row2) {
            echo "<p>Direspon oleh :{$row2['username']}</p>";
            echo "<p> {$row2['jawaban']}</p>";
        }
        echo "</li>";
        
    } 
    else {
        echo "<li class='daftar'>Belum ada Respon</li>";
    }
    
    echo "</div><br>";
}
?>
</div>
</div>
</body>
</html>