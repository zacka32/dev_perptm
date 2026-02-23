<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);

if ($_GET['act']=='lupaaksi'){

$nik=$_POST['nik'];

if (empty($nik)){
  echo "<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.5 -->
  <link rel='stylesheet' href='bootstrap/css/bootstrap.css'>
  <!-- Font Awesome -->
    <!-- Theme style -->
  <link rel='stylesheet' href='dist/css/AdminLTE.css'>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
 <link rel='stylesheet' href='dist/css/skins/_all-skins.min.css'>";
  echo "<center> Anda belum mengisikan NIK<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b> </center>";
}
else{
	if(!empty($_POST['kode'])){
		if($_POST['kode']==$_SESSION['captcha_session']){

             
           include "config/koneksi.php";
           include "config/library.php";
           include "phpmailer/class.phpmailer.php";
           include "phpmailer/class.pop3.php";
           
           //new pass
           error_reporting(E_ALL ^ E_NOTICE);
           function rand_string( $length ) {
           $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; 
 
           $size = strlen( $chars );
           for( $i = 0; $i < $length; $i++ ) {
           $str .= $chars[ rand( 0, $size - 1 ) ];
           }
 
           return $str;
           }
           $pass        = rand_string( 8 );
           $newpass     = md5($pass);
           $date1=date('Y-m-d');
           $limit=date('Y-m-d', strtotime('+3 month',strtotime($date1))) ;

           // mysql_query("UPDATE admins set password = '$newpass',
           //                                exprd    = '$limit'
           //                          WHERE nik = '$nik' ");

           $query = $db->prepare("UPDATE admins set password = '$newpass',
                                          exprd    = '$limit'
                                    WHERE nik = '$nik' ");
           $query->execute();
           //$r=$tampil->fetch();

           $message   = 
           "<body style='margin: 10px;'>
            <div style='width: 640px; font-family: Helvetica, sans-serif; font-size: 13px; padding:10px; line-height:150%; border:#eaeaea solid 10px;'>
            <br>
            <strong>Reset Password</strong><br><br><br>
            <b>Nik      : </b>".$nik."<br>
            <b>Password baru          : ".$pass."</b><br>
            <br>
            Silahkan Login kembali menggunakan NIK dan Password diatas. <br>
            <b> Note : Segera rubah password untuk keamanan data !! </b>            
            <br>
            </div>
            </body>";

            $tampil = $db->prepare("SELECT email as penerima FROM admins WHERE nik='$nik'");
            $tampil->execute();
            $r      = $tampil->fetch();


            $mail = new PHPMailer();
            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            //$mail->SMTPAuth = true; // authentication enabled
            //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "10.11.12.14";
            $mail->Port = 25; // or 587
            $mail->IsHTML(true);
            $mail->Username = "horsp@immortal.co.id";
            $mail->Password = "horsp";
    
   

            $email = $r['penerima']; // Recipients email ID
            $mail->AddAddress($email);
            $mail->From = "horsp@immortal.co.id";
            $mail->FromName = "IT Support Immortal Group";
            $mail->IsHTML(true); // send as HTML
            $mail->Subject = "Reset Password SIT";
            $mail->Body = $message; //HTML Body
    
            if(!$mail->Send()){
                echo "Mailer Error: . $mail->ErrorInfo";
            }
            echo "<script>alert('Periksa Email Anda !');
             window.location.href='index.php'</script>";

		}else{
			echo "<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
                  <!-- Bootstrap 3.3.5 -->
                  <link rel='stylesheet' href='bootstrap/css/bootstrap.css'>
                  <!-- Font Awesome -->
                  <!-- Theme style -->
                  <link rel='stylesheet' href='dist/css/AdminLTE.css'>
                  <!-- AdminLTE Skins. Choose a skin from the css/skins
                  folder instead of downloading all of them to reduce the load. -->
                  <link rel='stylesheet' href='dist/css/skins/_all-skins.min.css'>";
			echo "<center>Kode yang Anda masukkan tidak cocok<br />
			      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a></center>";
		}
	}else{
		echo "<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
              <!-- Bootstrap 3.3.5 -->
              <link rel='stylesheet' href='bootstrap/css/bootstrap.css'>
              <!-- Font Awesome -->
              <!-- Theme style -->
              <link rel='stylesheet' href='dist/css/AdminLTE.css'>
              <!-- AdminLTE Skins. Choose a skin from the css/skins
              folder instead of downloading all of them to reduce the load. -->
              <link rel='stylesheet' href='dist/css/skins/_all-skins.min.css'>";

		echo "<center>Anda belum memasukkan kode<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a></center>";
	}
}                              
}
?>
