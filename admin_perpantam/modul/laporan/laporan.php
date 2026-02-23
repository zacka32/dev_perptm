<?php
session_start();
$userid=$_SESSION['userid'];	
$folder="modul/laporan";
$moduleAkses='laporan';
$module="laporan";
$aksi="modul/laporan/aksi_laporan.php";
switch($_GET['act']){
  // Tampil Modul
  default:
  if (hakakses($userid,$moduleAkses,'lihat')) {
  ?>
 
<style>
  .select2-container {
    width: 100% !important;
}

  </style>
	<section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <div class="col-xl-6 pull-left"><h3 class="box-title">laporan Masuk </h3> 
          </div>
          <div class="col-xl-3 pull-right">
            
          </div>
          <div class="col-xl-3 pull-right"style="margin-right: 3px;">
      
          </div>
        </div>
        
        <!-- Custom Tabs -->
        <div class="box-body">
          <div class="row">
  <div class="col-md-3">
      <label>Tanggal Mulai</label>
      <input type="date" id="tgl_mulai" class="form-control">
  </div>
  <div class="col-md-3">
      <label>Tanggal Akhir</label>
      <input type="date" id="tgl_akhir" class="form-control">
  </div>
  <div class="col-md-2">
      <label>&nbsp;</label>
      <button id="btnFilter" class="btn btn-primary form-control">Filter</button>
  </div>
</div>
<br>

          <!-- <table id="example" class="" cellspacing="0" width="100%"> -->
          <table id="tbl_order" class="display table table-blaporaned table-striped " width="100%">
          <thead>
            <tr class="color_header"> 
              <th>No</th>
              <th>Nama</th>
              <th>Tanggal laporan </th>
              <th>Pembayaran </th>
              <th> Status laporan </th>
            <th width='10%'>Aksi</th>
            </tr>
          </thead>
          <?php 
               $query = $db->prepare("SELECT a.*, b.nama_lengkap FROM pesanan a left join customer b on a.id_customer=b.id ORDER BY a.waktu_pesanan ");
               $query->execute();
                while($r = $query->fetch()) { 
                  if($r['status_pesanan']=='paid') {
                    $class= 'label label-success';
                  } else if($r['status_pesanan']=='completed') {
                    $class= 'label label-success';
                  } else if($r['status_pesanan']=='pending') {
                    $class= 'label label-warning'; }
                  else {
                     $class= 'label label-danger';
                  }

                  echo "<tr>
                  <td>$r[id]</td>
                        <td>$r[nama_lengkap]</td>"; ?>
                        <td><?= date('d M Y', strtotime($r['waktu_pesanan'])); ?></td>
<?php echo "
                        <td>$r[metode_pembayaran]</td>
                        <td><span class='$class'>$r[status_pesanan]</span></td>
                        <td>";
                  echo '<a href="#" data-target="#view-modal5" data-toggle="modal" data-id='.$r['id'].' id="getUser5" data-whatever="@mdo" class="btn-sm btn-info" style="width: 20px;" title="Klik untuk liat detail" data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-search-plus"></i></a>
                  <a href="#" data-target="#view-edit" data-toggle="modal" data-id='.$r['id'].' id="getEdit" data-whatever="@mdo" class="btn-sm btn-warning" style="width: 20px;" title="Klik untuk liat edit Status" data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-edit"></i></a>
                  </td>
                  
                  </td>
                  </tr>
                  ';
                }
         ?>  
          <tbody>
          </tbody>
          </table>
          
        </div>
        <!-- col -->
      </div>
      </div>
      
    </div>    
  </section>
  <script>
$(document).ready(function() {

    var table = $('#tbl_order').DataTable({
        order: [[0, "desc"]],
        deferRender: true,
        responsive: true,
        dom: 'Blfrtip', // BUTTONS muncul
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Data Laporan',
                text: 'Export Excel'
            }
        ],
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],

        // Tooltip after load
        drawCallback: function(settings) {
            $('[data-tt="tooltip"]').tooltip();
        }
    });

    // 🔍 FILTER TANGGAL MULAI - TANGGAL AKHIR
    $('#btnFilter').on('click', function () {
        var tglMulai = $('#tgl_mulai').val();
        var tglAkhir = $('#tgl_akhir').val();

        if (tglMulai === "" || tglAkhir === "") {
            alert("Tanggal mulai dan tanggal akhir wajib diisi");
            return;
        }

        // Format agar sesuai DataTables
        var mulai = new Date(tglMulai);
        var akhir = new Date(tglAkhir);

        // Gunakan custom filter DataTables
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var tglData = new Date(data[2]); // kolom tanggal laporan index ke-2

                if (tglData >= mulai && tglData <= akhir) {
                    return true;
                }
                return false;
            }
        );

        table.draw();
        $.fn.dataTable.ext.search.pop(); // reset agar tidak numpuk
    });

});


 
  function hapuslaporan(no_laporan) {
    if (confirm("Apakah Anda yakin ingin menghapus ini")) {
        var userid = <?php echo "$_SESSION[userid]"; ?>; 
            var dataString = 'userid='+userid+'&laporan_id='+no_laporan;
        $.ajax({
            type:'POST',
            data:dataString,
            url:'modul/laporan/aksi_laporan.php?module=laporan&act=hapuslaporan',
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
  case "editlaporan":
      if (hakakses($userid,'laporan','edit')) {
          $id = encrypt_decrypt('decrypt',$_GET['id']);
          $ed=$db->prepare("SELECT * FROM laporan WHERE id_laporan='$id'");
          $ed->execute();        
          $e=$ed->fetch();
    ?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <div class="col-xl-6 pull-left"><h3 class="box-title" style="color: #2b31e2;">Edit laporan</h3>  
        </div>
      </div>
        <form autocomplete="off" class="simpanhtml" onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}" action="<?php echo"$aksi?module=laporan&act=update";?>" enctype="multipart/form-data" method="POST" class="">
        <!-- Custom Tabs -->
        <div class="box-body">
          
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Nama laporan</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" value="<?php echo $e['nama_laporan'];?>"  name="nama_laporan" id="nama_laporan" required="required" >
                  <input type="hidden" class="form-control" value="<?php echo $e['id_laporan'];?>"  name="id_laporan">
              </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Status</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                <select name="l_status" class="form-control" required>
                  <?php 
                  if($e['l_status']=='A' ){
                        echo '<option value="A" selected >Aktif</option>';
                        echo '<option value="D" >Delete</option>';
                  }elseif($e['l_status']=='D' ) {
                    echo '<option value="D" selected >Delete</option>';
                    echo '<option value="A" >Aktif</option>';
                  } 
                ?>
									
									</select>	
              </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Title</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" value="<?php echo $e['title'];?>"  name="title" id="title"  >
              </div>
          </div>
          <!-- <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">URL</label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" value="<?php echo $e['url'];?>"  name="url" id="url" required="required" >
              </div>
          </div> -->
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Posisi</label>
              <div style="background:#fff;" class="input-group col-md-8">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  <select name="posisi" class="form-control" required>
										<?php  echo '<option value="" >Pilih Posisi</option>';
                    $sh=$db->prepare("SELECT * FROM master_posisi_laporan  laporan BY urutan ASC");
                    $sh->execute();        
                    while($ro=$sh->fetch()){
                       echo "<option value='" . $ro['nama'] . "'>" . $ro['nama'] . "  - - - " . $ro['ukuran'] . "</option>";                              
                    } 
                    ?>
									</select>	
                
              </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Deskripsi</label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" value="<?php echo $e['deskripsi'];?>"  
                  name="deskripsi" id="deskripsi" >
                
              </div>
          </div>
          <!-- <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Tgl Mulai</label>
              <div style="background:#fff;" class="input-group col-md-3">
                <span class="input-group-addon"><b>              <i class="fa fa-calendar"></i></b></span>
                  <input type="date" class="form-control" value="<?php echo $e['mulai'];?>"  name="mulai" id="mulai" >
                
              </div>
          </div> -->
          <!-- <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Tgl Akhir</label>
              <div style="background:#fff;" class="input-group col-md-3">
                <span class="input-group-addon"><b>              <i class="fa fa-calendar"></i></b></span>
                  <input type="date" class="form-control" value="<?php echo $e['akhir'];?>"  name="akhir" id="akhir" >
                
              </div>
          </div> -->
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Gambar Lama</label>
              <div style="background:#fff;" class="input-group col-md-3">
                <span class="input-group-addon"><b>              <i class="fa fa-calendar"></i></b></span>
                  <img src='gambar/<?php echo $e['gambar'];?>' width='300' >
                
              </div>
          </div>
          <hr>
          Jika Ingin Ganti Pilih gambar lagi, jika tidak kosongkan saja
          
          <div class="wrap-custom-file">
            <input type="file" name="image1"  id="image1" accept=".gif, .jpg, .png" />
            <label for="image1">
              <span>Select Image One</span>
              <i class="fa fa-plus-circle"></i>
            </label>
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
<?php
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
          <div class="col-xl-6 pull-left"><h3 class="box-title" style="color: #2b31e2;">Entry laporan</h3>  
        </div>
      </div>
        <form autocomplete="off" class="simpanhtml" onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}" action="<?php echo"$aksi?module=laporan&act=input";?>" enctype="multipart/form-data" method="POST" class="">
        <!-- Custom Tabs -->
        <div class="box-body">
          
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Nama laporan</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control"  name="nama_laporan" id="nama_laporan" required="required" >
              </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Title</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control"  name="title" id="title"  >
              </div>
          </div>
         
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Posisi</label>
              <div style="background:#fff;" class="input-group col-md-8">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  <select name="posisi" class="form-control" required>
                 <?php  echo '<option value="" >Pilih Posisi</option>';
                    $sh=$db->prepare("SELECT * FROM master_posisi_laporan  laporan BY urutan ASC");
                    $sh->execute();        
                    while($ro=$sh->fetch()){
                        echo "<option value='" . $ro['nama'] . "'>" . $ro['nama'] . "  - - - " . $ro['ukuran'] . "</option>";   
                                           
                    } 
                    ?>
									</select>	
									</select>	
                
              </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Deskripsi</label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control"  name="deskripsi" id="deskripsi" >
                
              </div>
          </div>
         
          <div class="wrap-custom-file">
            <input type="file" name="image1" id="image1" accept=".gif, .jpg, .png" required="required"  />
            <label for="image1">
              <span>Select Image One</span>
              <i class="fa fa-plus-circle"></i>
            </label>
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
  
<?php
  }else{
      echo "<script>alert('Anda Tidak Memiliki Akses !');
               window.location.href='?module=home'</script>";
    }
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
   

     //get  history
  $(document).on('click', '#getUser5', function(e){
     e.preventDefault();
  
     var uid = $(this).data('id'); // get id of clicked row
     //alert(uid);
     //$('#dynamic-content').html(''); // leave this div blank
     //$('#modal-loader').show();      // load ajax loader on button click
 
     $.ajax({
          url: 'modul/laporan/aksi_laporan.php?module=laporan&act=showdata',
          type: 'POST',
          data: 'id='+uid,
          dataType: 'html'
     })
     .done(function(data){
          //console.log(data); 
          $('#dynamic-content5').html(''); // blank before load.
          $('#dynamic-content5').html(data); // load here
          
     })
     .fail(function(){
          $('#dynamic-content5').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          //$('#modal-loader').hide();
     });

    });


     $(document).on('click', '#getEdit', function(e){
     e.preventDefault();
  
     var uid = $(this).data('id'); // get id of clicked row
     //alert(uid);
     //$('#dynamic-content').html(''); // leave this div blank
     //$('#modal-loader').show();      // load ajax loader on button click
 
     $.ajax({
          url: 'modul/laporan/editdata.php',
          type: 'POST',
          data: 'id='+uid,
          dataType: 'html'
     })
     .done(function(data){
          //console.log(data); 
          $('#dynamic-edit').html(''); // blank before load.
          $('#dynamic-edit').html(data); // load here
          
     })
     .fail(function(){
          $('#dynamic-edit').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          //$('#modal-loader').hide();
     });

    });
   
	}); 
 </script>
 
<!-- modal untuk show data detail  -->
            <div class='modal fade' id='view-modal5'   aria-labelledby='myModalLabel'>
              <div class='modal-dialog modal-lg' role='document'>
              <div class='modal-content'>
              <div class='modal-header'>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <h4 class='modal-title'>Detail laporan</h4>
               
              </div>
              <div class='modal-body'>
              <div id='dynamic-content5'>
              </div>                
              <div class='box-footer'>
              </div>
              </div>
              </div>
              </div>
            </div>

  <!-- modal untuk show data edit  -->
            <div class='modal fade' id='view-edit'   aria-labelledby='myModalLabel'>
              <div class='modal-dialog modal-sm' role='document'>
              <div class='modal-content'>
              <div class='modal-header'>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <h4 class='modal-title'>Edit Pembayaran</h4>
               
              </div>
              <div class='modal-body'>
              <div id='dynamic-edit'>

              </div>                
              <div class='box-footer'>
              </div>
              </div>
              </div>
              </div>
            </div>
