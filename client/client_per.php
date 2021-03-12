<?php
require 'Clienpermit.inc';
function jawaban($kode_dis,$conn){
    $jawaban=$conn->prepare("SELECT jawaban, username FROM diskusi, jawaban, user 
                             WHERE jawaban.kode_dis = :kode_dis AND jawaban.id_user=user.id_user AND jawaban.kode_dis=diskusi.kode_dis");
    $jawaban->bindValue(':kode_dis',$kode_dis);
    $jawaban->execute();
    return $jawaban;
   
}
function getReply($idTopic, $conn){
    $reply = $conn->prepare("SELECT * FROM reply, user where id_topic = :idTopic AND user.id_user = reply.id_user");
    $reply->bindValue(':idTopic',$idTopic);
    $reply->execute();

    return $reply;
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
        <li><div class="loggin"><a href="profil_client.php">Profil</a></div>
        <li><div class="loggin"><a href="pertanyaan_client.php">Tanya</a></li></div>
        <li><div class="loggin"><a href="client_per.php">Dashboard </a></li></div>
        <li><div class="loggin"><a href="list_per_client.php">Home</a></li></div>
        </li>  
    </ul>
</nav>
<h1>Daftar Pertanyaan Anda</h1>
<?php
$dbc = new PDO('mysql:host=localhost;dbname=forum','root','');	
$query = $dbc->prepare("SELECT username, kode_dis, diskusi.kode_topik, bidang, pertanyaan FROM diskusi, topik, user 
                        WHERE  user.id_user={$_SESSION['id']} AND diskusi.kode_topik = topik.kode_topik AND diskusi.id_user=user.id_user ORDER BY kode_dis DESC");
$query->execute();
if ($query->rowCount()>0) {
    foreach ($query as $row) {
        echo "<div class='container2'><span class='topik'>Topik :</span>";
        echo "<p>{$row['bidang']}</p>";
        echo "<span class='topik'>Penanya :</span>";
        echo "<p>  {$row['username']}</p>";
        echo "<span class='topik'>Pertanyaan :</span>";
        echo "<p>  {$row['pertanyaan']}</p>";
        $kode_dis=intval($row['kode_dis']);
        echo "<a href='edit_pertanyaan.php?kode_dis=$kode_dis'>Edit Pertanyaan</a></div>";
        $respon = jawaban($row['kode_dis'], $dbc);
        echo "<div class=container3>";
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
} else {
    echo '<h3>Anda belum pernah mengajukan pertanyaan</h3>'; 
    echo '<div class="tombol_login tengah"><a href="pertanyaan_client.php" class="tengah">Ajukan Pertanyaan ?</a></div>';
}


?>
</div>
</body>
</html>