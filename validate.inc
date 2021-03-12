        
<?php
function validateNumber(&$errors, $field_list, $field_number){

    $angkaJml = "/^[0-9]*$/"; //format nomor (nomor)
    $panjang_angka = strlen($field_number);
    //echo $panjang_angka;
    //($field_number);

    if (!isset($field_list[$field_number]) || empty($field_list[$field_number]))
        $errors[$field_number] = 'wajib diisi';

    else if (!preg_match($angkaJml, $field_list[$field_number]))
        $errors[$field_number] = 'hanya mengandung angka';
    else if (strlen($field_list[$field_number]) != 11){
        $errors[$field_number]= 'nomor Handphone harus 11 digit';
    }
}


function validateMail(&$errors, $field_list, $field_mail){

    $email = $field_list[$field_mail];
    $dbc = new PDO('mysql:host=localhost;dbname=forum','root','');		
	$query = $dbc->prepare("SELECT * FROM user WHERE email = :email");
	$query->bindValue(':email', $_POST['emailAddress']);
	$query->execute();
	if ($query->rowCount() > 0){
        $errors[$field_mail] = 'email telah digunakan';
    }
    else if (!isset($field_list[$field_mail]) || empty($field_list[$field_mail]))
        $errors[$field_mail] = 'wajib diisi';
    
    else if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", trim($email)))
        $errors[$field_mail] = 'alamat email tidak valid';
}

function validateName(&$errors, $field_list, $field_name)  {
    
    $pattern = "/^['a-zA-Z'\s]+$/"; // format surname (alfabet) 
   
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))    
        $errors[$field_name] = 'wajib diisi';   
    
    else if (!preg_match($pattern, $field_list[$field_name]))    
        $errors[$field_name] = 'hanya mengandung huruf alfabet';  }


function validatePw(&$errors, $field_list, $field_pw)  {
    //echo 'validate password '.$field_list[$field_pw].'<br>';
    $text = preg_match('@[a-z]@', $field_list[$field_pw]);
    $number = preg_match('@[0-9]@', $field_list[$field_pw]);
   
    if (!isset($field_list[$field_pw]) || empty($field_list[$field_pw]))    
        $errors[$field_pw] = 'wajib diisi';   
    
    else if (!$text || !$number)
        $errors[$field_pw] = 'wajib mengandung huruf dan angka'; 
    else if (strlen($field_list[$field_pw]) < 8)
        $errors[$field_number]= 'minimal 8 karakter';
    }

function validateCpw(&$errors, $pw, $cpw, $field_cpw)  {
   
    if (!isset($cpw) || empty($cpw))    
        $errors[$field_cpw] = 'wajib diisi';   
    
    else if ($pw != $cpw)
        $errors[$field_cpw] = 'password tidak sama';
      }

function validateEmpty(&$errors, $field_list, $field_name)  {
   
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))    
        $errors[$field_name] = 'wajib diisi';   
    
        }
function validateUsname(&$errors, $field_list, $field_name)  {

    $dbc2 = new PDO('mysql:host=localhost;dbname=forum','root','');		
	$query2 = $dbc2->prepare("SELECT * FROM user WHERE username = :username");
	$query2->bindValue(':username', $_POST['username']);
	$query2->execute();

	if ($query2->rowCount() > 0){
        $errors[$field_name] = ' username telah digunakan';
    }
    else if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))    
        $errors[$field_name] = 'wajib diisi';   
    
        }
#Untuk Edit
function UpUsname(&$errors, $field_list, $field_name)  {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))    
        $errors[$field_name] = 'wajib diisi';   
    
        }
function UpeMail(&$errors, $field_list, $field_mail){

    $email = $field_list[$field_mail];
    if (!isset($field_list[$field_mail]) || empty($field_list[$field_mail]))
        $errors[$field_mail] = 'wajib diisi';
    
    else if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", trim($email)))
        $errors[$field_mail] = 'alamat email tidak valid';
}
#Untuk Login
function LogMail(&$errors, $field_list, $field_mail){

    $email = $field_list[$field_mail];
    $dbc = new PDO('mysql:host=localhost;dbname=forum','root','');		
	$query = $dbc->prepare("SELECT * FROM user WHERE email = :email");
	$query->bindValue(':email', $_POST['emailAddress']);
	$query->execute();
	if ($query->rowCount() == 0){
        $errors[$field_mail] = 'email tidak terdaftar';
    }
    else if (!isset($field_list[$field_mail]) || empty($field_list[$field_mail]))
        $errors[$field_mail] = 'wajib diisi';
    
    else if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", trim($email)))
        $errors[$field_mail] = 'alamat email tidak valid';
}
function LogPw(&$errors, $field_list, $field_pw)  {
    $dbc = new PDO('mysql:host=localhost;dbname=forum','root','');		
	$query = $dbc->prepare("SELECT * FROM user WHERE email = :email AND password = SHA2(:password, 0)");
    $query->bindValue(':email', $_POST['emailAddress']);
	$query->bindValue(':password', $_POST['password']);
    $query->execute();
    if ($query->rowCount() == 0){
        $errors[$field_pw] = 'password salah';
    }
    //echo 'validate password '.$field_list[$field_pw].'<br>';
    $text = preg_match('@[a-z]@', $field_list[$field_pw]);
    $number = preg_match('@[0-9]@', $field_list[$field_pw]);
   
    if (!isset($field_list[$field_pw]) || empty($field_list[$field_pw]))    
        $errors[$field_pw] = 'wajib diisi';   
    
    else if (!$text || !$number)
        $errors[$field_pw] = 'wajib mengandung huruf dan angka'; 
    else if (strlen($field_list[$field_pw]) < 8)
        $errors[$field_number]= 'minimal 8 karakter';
    }

?>