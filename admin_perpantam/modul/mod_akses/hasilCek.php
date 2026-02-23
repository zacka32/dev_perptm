<?php 

include "../../config/koneksi.php";
$params_userid=$_POST['userid'];
$params_modul=$_POST['modul'];

 $tampil1 = $db->prepare("SELECT count(*) hsl from akses where userid='$params_userid' AND modul='$params_modul'");
 $tampil1->execute();
 $r=$tampil1->fetch();

 if(empty($r['hsl'])) {
				$result = "
				<button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-default\">Close</button>
				<button type=\"submit\" class=\"simpanPend btn btn-primary\" name=\"simpanpen\">Save</button>";
 }
 else {
	  
		$result = "User sudah memiliki module ini
		<button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-default\">Close</button>";
  }

echo "$result"; 

?>