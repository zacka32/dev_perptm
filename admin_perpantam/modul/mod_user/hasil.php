<!-- 

          <?php   
  session_start();
  include "../../config/koneksi.php";
 
  $userid=$_SESSION['userid'];  
 
  $kategori = $_POST['kategori'];
  $query4 = $db->prepare ("SELECT max(userid) AS last FROM users WHERE userid LIKE '$kategori%'");
  $query4->execute();
  $data  = $query4->fetch();
  $lastNoTransaksi = $data['last'];
  $lastNoUrut = (int) substr($lastNoTransaksi, 2, 3);
  $nextNoUrut = $lastNoUrut + 1;
  $id = $kategori.sprintf('%03s', $nextNoUrut);	
  
           

    ?>



          <script type="text/javascript"> 
          	$(document).ready(function(){
          $("#userid").val($("#id").val());

              });
                    </script> -->