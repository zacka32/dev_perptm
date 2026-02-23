<?php
session_start();
$userid=$_SESSION['userid'];	
$folder="modul/mod_user";
$moduleAkses='user';
$module="user";
$aksi="modul/mod_user/aksi_user.php";
switch($_GET['act']){
  // Tampil Modul
  default:
  if (hakakses($userid,$moduleAkses,'lihat')) {
  ?>
	<section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <div class="col-xl-6 pull-left"><h3 class="box-title">Data User </h3> 
          </div>
          <div class="col-xl-3 pull-right">
            <?php 
            if (hakakses($userid,$moduleAkses,'buat')) { ?>
            <a href="?module=user&act=tambahuser" class="btn btn-block btn-success pull-right" title="Klik untuk tambah data" data-tt="tooltip" data-placement="top"><b><i class="fa fa-fw fa-user-plus" ></i>Add</b></b></a>
            <?php  } ?> 
          </div>
          <div class="col-xl-3 pull-right"style="margin-right: 3px;">
      
          </div>
        </div>
        
        <!-- Custom Tabs -->
        <div class="box-body">
          <!-- <table id="example" class="" cellspacing="0" width="100%"> -->
          <table id="tbl_user" class="display table table-bordered table-striped " width="100%">
          <thead>
            <tr class="color_header"> 
              <th>User ID</th>
              <th>Nama </th>
              <th>No Hp</th>
              <th>Email</th>
              <!-- <th>Point</th> -->
              <!-- <th>Kategori</th>   -->
              <th>Status</th>  
            <th width='10%'>Aksi</th>
            </tr>
          </thead>
          
          <tbody>
          <?php
            $tampil = $db->prepare("SELECT * FROM users");
            $tampil->execute();
            while ($r=$tampil->fetch()){ 
              $id = $r['userid'];
              // $id=  $r['userid']; 
              // $button='';
            // if($r['l_status']=='A'){
            //   // $status =  'Pending';
            //   $status = '<span class="label label-warning">Baru</span>';
            //   $button .= '<a href='.$aksi.'?module=polling&act=publish&id='.$id.' class="btn-sm btn-success" 
            //               style="width: 20px;" title="Klik untuk Publish" data-tt="tooltip" data-placement="top">
            //               <i class="fa fa-thumbs-o-up"></i></a>';
            //   $button .= '<a href='.$aksi.'?module=polling&act=delete&id='.$id.' class="btn-sm btn-danger" 
            //               style="width: 20px;" title="Klik untuk delete" data-tt="tooltip" data-placement="top">
            //               <i class="fa fa-trash-o"></i></a>';
            // } else if ($r['l_status']=='C') {
            //   // $status = 'Complite';
            //     $status = '<span class="label label-info">Confirm</span>';
            //     $button .= '<a href='.$aksi.'?module=polling&act=stop&id='.$id.' class="btn-sm btn-warning" 
            //               style="width: 20px;" title="Klik untuk Stop Publish" data-tt="tooltip" data-placement="top">
            //               <i class="fa fa-pause"></i></a>';
            // } 
            // else 
            $class = ' ';
            if ($r['l_status']=='A') {
              $class = 'red';
                $status = '<span class="label label-warning">Belum Aktif/Baru</span>';
                // $button .= '<a href=?module=polling&act=stop&id='.$id.'" class="btn-sm btn-warning" 
                //           style="width: 20px;" title="Klik untuk Stop Publish" data-tt="tooltip" data-placement="top">
                //           <i class="fa fa-pause"></i></a>';
            }else if($r['l_status']=='C') {
               // $status = 'Belum Diisi';
                $status = '<span class="label label-success">Aktif</span>';
                // $button .='';
            }  else if($r['l_status']=='D') {
              // $status = 'Belum Diisi';
               $status = '<span class="label label-danger">Delete</span>';
               // $button .='';
           }      
              echo "<tr>
              
                    <td>$r[userid]</td>
                    <td>$r[nama_lengkap]</td>
                    <td>$r[no_hp]</td>
                    <td>$r[email]</td>
        
                    <td>$status</td>
                    <td>";
                    
                    echo '
                    <a href="?module=user&act=view&userid='.$id.'" 
                     class="btn-sm btn-info" style="width: 20px;" title="Klik untuk liat detail" 
                     data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-search-plus"></i>View</a>
                   ';
              
                  // echo $button;
              echo "</td></tr>";
            }
            ?>
          </tbody>
          </table>
          
        </div>
        <!-- col -->
      </div>
      </div>
      
    </div>    
  </section>
  
  <script type="text/javascript">
 
  function hapususer(no_user) {
    if (confirm("Apakah Anda yakin ingin menghapus ini")) {
        var userid = <?php echo "$_SESSION[userid]"; ?>; 
            var dataString = 'userid='+userid+'&user_id='+no_user;
        $.ajax({
            type:'POST',
            data:dataString,
            url:'modul/mod_user/aksi_user.php?module=user&act=hapususer',
            success:function(data) {
              location.reload(true);        
            }
        });
    } else {  // if dialog
          return false;
        }
  }
  </script>
<?php }else{
    echo "<script>alert('Anda Tidak Memiliki Akses !');
            window.location.href='?module=home'</script>";
  }
    break;  
    case "tambahuser":
      if (hakakses($userid,$moduleAkses,'buat')) {
include "tambah.php";
      }else{
        echo "<script>alert('Anda Tidak Memiliki Akses !');
                 window.location.href='?module=home'</script>";
      }
  break;  
   
case "tambah":
  if (hakakses($userid,$moduleAkses,'buat')) {
  ?>
<section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <div class="col-xl-6 pull-left"><h3 class="box-title" style="color: #2b31e2;">Entry User</h3>  
        </div>
      </div>
        <form autocomplete="off" class="simpanhtml" onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}" action="<?php echo"$aksi?module=user&act=input";?>" enctype="multipart/form-data" method="POST" class="">
        <!-- Custom Tabs -->
        <div class="box-body">
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Kategori</label>
              <div style="background:#fff;" class="input-group col-md-5">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                <select class="form-control select2" name="kategori" id="kategori" required>
                    <?php  echo '<option value="">Pilih</option>';
                      $s3=$db->prepare("SELECT * FROM kategori");
                          $s3->execute();        
                      while($r3=$s3->fetch()){
                          echo "<option value='" . $r3['kategori'] . "'>" . $r3['kategori'] . "</option>";         
                      } 
                    ?>
                  </select>
                  
              </div>
          </div>
          
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Nama Merchant</label>
              <div style="background:#fff;" class="input-group col-md-5">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  <select class="form-control select2" name="id_merchant" id="id_merchant">
                    <?php  echo '<option value="">Pilih</option>';
                      $s3=$db->prepare("SELECT * FROM master_merchant");
                          $s3->execute();        
                      while($r3=$s3->fetch()){
                          echo "<option value='" . $r3['id_merchant'] . "'>" . $r3['id_merchant'] . "-" . $r3['nama_merchant'] . "</option>";         
                      } 
                    ?>
                  </select>
              </div>
          </div>
 
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Username</label>
              <div style="background:#fff;" class="input-group col-md-3">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control"  name="userid" id="userid" required="required" >
              </div>
          </div>
        
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
              <div style="background:#fff;" class="input-group col-md-3">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" name="password" id="password" required="required" >
              </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Nama Lengkap</label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required="required" >
                
              </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">No Hp</label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control"  name="no_hp" id="no_hp" required="required" >
                
              </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Email</label>
              <div style="background:#fff;" class="input-group col-md-5">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  <input type="email" class="form-control" name="email" id="email" required="required" >
                
              </div>
          </div>
          </div>
          <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Propinsi</label>
                <div style="background:#fff;" class="input-group col-md-8">
                  <span class="input-group-addon"><i class="fa fa-bars fa-fw"></i></span>
                  <select class="form-control select2" name="lokasi_prov" id="provinsi" required>
                    <?php  echo '<option value="">Pilih</option>';
                      $sh=$db->prepare("SELECT * FROM provinsi WHERE l_status='Y' ORDER BY nama ASC");
                          $sh->execute();        
                      while($ro=$sh->fetch()){
                          echo "<option value='" . $ro['id_prov'] . "'>" . $ro['nama'] . "</option>";         
                      } 
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Kabupaten</label>
                <div style="background:#fff;" class="input-group col-md-8">
                  <span class="input-group-addon"><i class="fa fa-bars fa-fw"></i></span>
                  <select class="form-control select2" name="lokasi" id="kabupaten" required>
                    
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Kecamatan</label>
                <div style="background:#fff;" class="input-group col-md-8">
                  <span class="input-group-addon"><i class="fa fa-bars fa-fw"></i></span>
                  <select class="form-control select2" name="lokasi_kec" id="kecamatan" required>
                    
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Kelurahan</label>
                <div style="background:#fff;" class="input-group col-md-8">
                  <span class="input-group-addon"><i class="fa fa-bars fa-fw"></i></span>
                  <select class="form-control select2" name="lokasi_kel" id="kelurahan" required>
                    
                  </select>
                </div>
              </div>
         
          
        <div class="box-footer">
          <button type="reset" class="btn btn-default" onclick="self.history.back()">Batal</button>
          <button  type="submit" class="btn btn-info pull-right" id=""><i class="fa fa-fw fa-save"></i> Simpan</button>
         </div>
        
      </div>
      </div>
      
    </div>
   
  </section>
  <script type="text/javascript">
	$(document).ready(function(){
      	$("#provinsi").change(function(){
      	var provinsi = $("#provinsi").val();
          	$.ajax({
          		type: 'POST',
                url: "modul/mod_pengiriman/aksi_pengiriman.php?module=pengiriman&act=kabupaten",
              	data: {provinsi: provinsi},
              	cache: false,
              	success: function(msg){
                  $("#kabupaten").html(msg);
                }
            });
        });
 
        $("#kabupaten").change(function(){
      	var kabupaten = $("#kabupaten").val();
          	$.ajax({
          		type: 'POST',
                url: "modul/mod_pengiriman/get_kecamatan.php",
              	data: {kabupaten: kabupaten},
              	cache: false,
              	success: function(msg){
                  $("#kecamatan").html(msg);
                  // console.log(msg);
                }
            });
            // hasil();
        });
 
        $("#kecamatan").change(function(){
      	var kecamatan = $("#kecamatan").val();
          	$.ajax({
          		type: 'POST',
                url: "modul/mod_pengiriman/get_kelurahan.php",
              	data: {kecamatan: kecamatan},
              	cache: false,
              	success: function(msg){
                  $("#kelurahan").html(msg);
                }
            });
        });
     });
</script>
<?php
  }else{
      echo "<script>alert('Anda Tidak Memiliki Akses !');
               window.location.href='?module=home'</script>";
    }
break;  
case "view":
   include "view.php";
break;  
case "approve":
 
  break;
}
?>
<script type="text/javascript">
    $(document).ready(function() { 
		 $('.form-horizontal').on('submit',function() {
			 
			var self = $(this),
			button = self.find('input[type="submit"], button'),
			submitValue = button.data('submit-value');
			
			button.attr('disabled', 'disabled').val((submitValue) ? submitValue : 'Please wait ..');
		
			 // return false;
		});
    $('#tbl_user').DataTable( {
    "drawCallback": function( settings ) {
    $('[data-tt="tooltip"]').tooltip();
    },
    "order": [[ 0, "desc" ]],
    "deferRender": true,
    "processing": true,
    // "serverSide": true,
    "responsive":true,
    // "scrollX": true,
    // "ajax": "modul/mod_user/load_data.php?act=listpo",
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    
  } );
	}); 
 </script>
