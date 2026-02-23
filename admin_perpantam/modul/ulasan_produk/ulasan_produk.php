<?php
session_start();
$userid=$_SESSION['userid'];	
$folder="modul/ulasan_produk";
$moduleAkses='ulasan_produk';
$module="ulasan_produk";
$aksi="modul/ulasan_produk/aksi_ulasan_produk.php";
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
          <div class="col-xl-6 pull-left"><h3 class="box-title">ulasan_produk </h3> 
          </div>
          <div class="col-xl-3 pull-right">
            <!-- <?php 
            if (hakakses($userid,$moduleAkses,'buat')) { ?>
            <a href="?module=ulasan_produk&act=tambah" class="btn btn-block btn-success pull-right" title="Klik untuk tambah data" data-tt="tooltip" data-placement="top"><b><i class="fa fa-fw fa-user-plus" ></i>Add</b></b></a>
            <?php  } ?>  -->
          </div>
          <div class="col-xl-3 pull-right"style="margin-right: 3px;">
      
          </div>
        </div>
        
        <!-- Custom Tabs -->
        <div class="box-body">
          <!-- <table id="example" class="" cellspacing="0" width="100%"> -->
          <table id="tbl_ulasan_produk" class="display table table-bordered table-striped " width="100%">
          <thead>
            <tr class="color_header"> 
              <th>No</th>
              <th>Pesan</th>
              <th>Total Bintang</th>
              <th>Nama Customer </th>
               <th>Ebooks </th>
               <th>gambar </th>
              <th>Tgl Komentar </th>    
              <th>Tampil </th>     
            <th width='25%'>Aksi</th>
            </tr>
          </thead>
          
          <tbody>
          </tbody>
          </table>
          
        </div>
        <!-- col -->
      </div>
      </div>
      
    </div>    
  </section>
  
  <script type="text/javascript">
 
  function hapusulasan_produk(no_ulasan_produk) {
    if (confirm("Apakah Anda yakin ingin menghapus ini")) {
        var userid = <?php echo "$_SESSION[userid]"; ?>; 
            var dataString = 'userid='+userid+'&ulasan_produk_id='+no_ulasan_produk;
        $.ajax({
            type:'POST',
            data:dataString,
            url:'modul/ulasan_produk/aksi_ulasan_produk.php?module=ulasan_produk&act=hapusulasan_produk',
            success:function(data) {
              // location.reload(true);        
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
  case "editulasan_produk":
      if (hakakses($userid,'ulasan_produk','edit')) {
          $id = encrypt_decrypt('decrypt',$_GET['id']);
          $ed=$db->prepare("SELECT * FROM ulasan_produk WHERE id_ulasan_produk='$id'");
          $ed->execute();        
          $e=$ed->fetch();
    ?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <div class="col-xl-6 pull-left"><h3 class="box-title" style="color: #2b31e2;">Edit ulasan_produk</h3>  
        </div>
      </div>
        <form autocomplete="off" class="simpanhtml" onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}" action="<?php echo"$aksi?module=ulasan_produk&act=update";?>" enctype="multipart/form-data" method="POST" class="">
        <!-- Custom Tabs -->
        <div class="box-body">
          
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Nama ulasan_produk</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" value="<?php echo $e['nama_ulasan_produk'];?>"  name="nama_ulasan_produk" id="nama_ulasan_produk" required="required" >
                  <input type="hidden" class="form-control" value="<?php echo $e['id_ulasan_produk'];?>"  name="id_ulasan_produk">
              </div>
          </div>
 
     

           <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Total % ulasan_produk</label>
              <div style="background:#fff;" class="input-group col-md-3">
               
                  <input type="number" class="form-control"  value="<?php echo $e['total_potongan'];?>"   name="total_potongan" max="100" id="total_potongan" required="required" >
                   <span class="input-group-addon"><b>%</b></span>
              </div>
          </div>

           <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Tgl Mulai</label>
              <div style="background:#fff;" class="input-group col-md-3">
                <span class="input-group-addon"><b>              <i class="fa fa-calendar"></i></b></span>
                 <input type="date" class="form-control" name="mulai" id="mulai"
      value="<?php echo $e['mulai'];?>" 
       min="<?php echo date('Y-m-d'); ?>">
              </div>
          </div> 
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Tgl Akhir</label>
              <div style="background:#fff;" class="input-group col-md-3">
                <span class="input-group-addon"><b>              <i class="fa fa-calendar"></i></b></span>
                  <input type="date" class="form-control" name="akhir" id="akhir"
       value="<?php echo $e['akhir'];?>" 
       min="<?php echo date('Y-m-d'); ?>">
              </div>
          </div>
        
       
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Gambar Lama</label>
              <div style="background:#fff;" class="input-group col-md-3">
                <span class="input-group-addon"><b>              <i class="fa fa-calendar"></i></b></span>
                  <img src='../image/bg-images/<?php echo $e['gambar'];?>' width='300' >
                
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
          <div class="col-xl-6 pull-left"><h3 class="box-title" style="color: #2b31e2;">Entry ulasan_produk</h3>  
        </div>
      </div>
        <form autocomplete="off" class="simpanhtml" onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}" action="<?php echo"$aksi?module=ulasan_produk&act=input";?>" enctype="multipart/form-data" method="POST" class="">
        <!-- Custom Tabs -->
        <div class="box-body">
          
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Nama ulasan_produk</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control"  name="nama_ulasan_produk" id="nama_ulasan_produk" required="required" >
              </div>
          </div>
     

           <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Total % ulasan_produk</label>
              <div style="background:#fff;" class="input-group col-md-3">
               
                  <input type="number" class="form-control"  name="total_potongan" max="100" id="total_potongan" required="required" >
                   <span class="input-group-addon"><b>%</b></span>
              </div>
          </div>

           <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Tgl Mulai</label>
              <div style="background:#fff;" class="input-group col-md-3">
                <span class="input-group-addon"><b>              <i class="fa fa-calendar"></i></b></span>
                 <input type="date" class="form-control" name="mulai" id="mulai"
       value="<?php echo date('Y-m-d'); ?>"
       min="<?php echo date('Y-m-d'); ?>">
              </div>
          </div> 
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Tgl Akhir</label>
              <div style="background:#fff;" class="input-group col-md-3">
                <span class="input-group-addon"><b>              <i class="fa fa-calendar"></i></b></span>
                  <input type="date" class="form-control" name="akhir" id="akhir"
       value="<?php echo date('Y-m-d', strtotime('+1 month')); ?>"
       min="<?php echo date('Y-m-d'); ?>">
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
case "addulasan_produk":
      if (hakakses($userid,'ulasan_produk','edit')) {
          $id = encrypt_decrypt('decrypt',$_GET['id']);
          $ed=$db->prepare("SELECT * FROM ulasan_produk WHERE id_ulasan_produk='$id'");
          $ed->execute();        
          $e=$ed->fetch();
    ?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <div class="col-xl-6 pull-left"><h3 class="box-title" style="color: #2b31e2;">Produk ulasan_produk</h3>  
        </div>
      </div>
     
        <!-- Custom Tabs -->
        <div class="box-body">
          
 
          <b>Judul ulasan_produk =       <?php echo $e['nama_ulasan_produk'];?>
                  
          </p> <b>   
          Total ulasan_produk  =  <?php echo $e['total_potongan'];?></p> <p> 
          <img src='../image/bg-images/<?php echo $e['gambar'];?>' width='300' >
                
              
          </p>


    <form autocomplete="off" class="simpanhtml" id="form_submit" action="<?php echo"$aksi?module=ulasan_produk&act=tambahebooks";?>" enctype="multipart/form-data" method="POST" class="">
            <!-- Custom Tabs -->
             <input type="hidden" class="form-control" value="<?php echo $e['id_ulasan_produk'];?>"  name="id_ulasan_produk">
              <input type="hidden" class="form-control" value="<?php echo $e['total_potongan'];?>"  name="total_potongan">
            <div class="box-body">
             <table id="best" class="display table table-bordered table-striped " width="100%">
                <thead>
                  <tr class="color_header"> 
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah Halaman</th>
                    <th>Cover</th>
                    <th>Terjual</th>
                  <th>Check</th>
                  </tr>
                </thead>
                <?php 
                  $main = $db->prepare("SELECT * FROM produk WHERE aktif = 'Y' AND ulasan_produk = 0");
                  $main->execute();
                  while($r = $main->fetch()) { 
                   

              echo '
                    <tr><td>'.$r['id_produk'].'</td>
                    <td>'.$r['nama_produk'].'</td>
                   <td>'.$r['harga_satuan'].'</td>
                    <td>'.$r['jumlah_halaman'].'</td>
                    <td>   <img src="../image/'.$r['image_cover'].'" width="50" ></td>
                   <td>'.$r['terjual'].'</td>';
                echo "   <td ><input type='checkbox' name='id_produk[]' value='$r[id_produk]'> </td>

              

                   </tr>
              ";
                  } ?>
                
                <tbody>
                </tbody>
                </table>
         
          
        <div class="box-footer">
          <button type="reset" class="btn btn-default" onclick="self.history.back()">Batal</button>
          <button  type="submit" class="btn btn-info pull-right" id=""><i class="fa fa-fw fa-save"></i> Simpan</button>
         </div>
                </form>
                <script type="text/javascript">
                $(document).ready(function() { 

              $('#best').DataTable( {
                
                    "scrollX": true,

                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                  } );
              }); 
            </script>
        
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
    $('#tbl_ulasan_produk').DataTable( {
        "drawCallback": function( settings ) {
        $('[data-tt="tooltip"]').tooltip();
        },
        "order": [[ 0, "desc" ]],

        "deferRender": true,
        "processing": true,
        "serverSide": true,
        "responsive":true,
        // "scrollX": true,
        "ajax": "modul/ulasan_produk/load_data.php?act=list_index",
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
      } );

   
	}); 
 </script>
<script>
$(function() {
$(document).on('change', ':file', function() {
	var input = $(this),
		numFiles = input.get(0).files ? input.get(0).files.length : 1,
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [numFiles, label]);
});
});
</script>
<style>
  .wrap-custom-file {
  position: relative;
  display: inline-block;
  width: 150px;
  height: 150px;
  margin: 0 0.5rem 1rem;
  /* border: 1px solid #9fa121; */
  text-align: center;
}
.wrap-custom-file input[type="file"] {
  position: absolute;
  top: 0;
  left: 0;
  width: 2px;
  height: 2px;
  overflow: hidden;
  opacity: 0;
}
.wrap-custom-file label {
  z-index: 1;
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  overflow: hidden;
  padding: 0 0.5rem;
  cursor: pointer;
  background-color: #d7d4d4;
  border-radius: 4px;
  -webkit-transition: -webkit-transform 0.4s;
  transition: -webkit-transform 0.4s;
  transition: transform 0.4s;
  transition: transform 0.4s, -webkit-transform 0.4s;
}
.wrap-custom-file label span {
  display: block;
  margin-top: 2rem;
  font-size: 1.4rem;
  color: #777;
  -webkit-transition: color 0.4s;
  transition: color 0.4s;
}
.wrap-custom-file label:hover {
  -webkit-transform: translateY(-1rem);
  transform: translateY(-1rem);
}
.wrap-custom-file label:hover span { color: #333; }
.wrap-custom-file label.file-ok {
  background-size: cover;
  background-position: center;
}
.wrap-custom-file label.file-ok span {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 0.3rem;
  font-size: 1.1rem;
  color: #000;
  background-color: rgba(255, 255, 255, 0.7);
}
  </style>
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous">
</script> -->
  <script type="text/javascript"> 
          $('input[type="file"]').each(function(){
var $file = $(this),
    $label = $file.next('label'),
    $labelText = $label.find('span'),
    labelDefault = $labelText.text();
$file.on('change', function(event){
  var fileName = $file.val().split( '\\' ).pop(),
      tmppath = URL.createObjectURL(event.target.files[0]);
  if( fileName ){
    $label
      .addClass('file-ok')
      .css('background-image', 'url(' + tmppath + ')');
    $labelText.text(fileName);
  }else{
    $label.removeClass('file-ok');
    $labelText.text(labelDefault);
  }
});
});
</script>

   <script>
document.addEventListener("DOMContentLoaded", function () {
    const mulai  = document.getElementById("mulai");
    const akhir  = document.getElementById("akhir");

    const today = new Date().toISOString().split('T')[0];

    function updateAkhir() {
        let tglMulai = new Date(mulai.value);

        if (!isNaN(tglMulai)) {
            // Tambah 1 bulan dari tanggal mulai
            tglMulai.setMonth(tglMulai.getMonth() + 1);

            let hasil = tglMulai.toISOString().split('T')[0];

            // Pastikan minimal hari ini
            if (hasil < today) {
                hasil = today;
            }

            akhir.value = hasil;
            akhir.min = today;
        }
    }

    mulai.min = today;
    updateAkhir();

    mulai.addEventListener("change", updateAkhir);
});


$(document).on('click', '#getUser5', function(e){
     e.preventDefault();
  
     var uid = $(this).data('id'); // get id of clicked row
     //alert(uid);
     //$('#dynamic-content').html(''); // leave this div blank
     //$('#modal-loader').show();      // load ajax loader on button click
 
     $.ajax({
          url: 'modul/ulasan_produk/aksi_ulasan_produk.php?module=ulasan_produk&act=showdata',
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
</script>
<!-- <script type="text/javascript" src="bootstrap/js/bootstrap-filestyle.min.js"> </script> -->


<!-- modal untuk show data detail  -->
            <div class='modal fade' id='view-modal5'   aria-labelledby='myModalLabel'>
              <div class='modal-dialog modal-lg' role='document'>
              <div class='modal-content'>
              <div class='modal-header'>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <h4 class='modal-title'>Detail Order</h4>
               
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
<script>
  $(document).on('click', '.hapus-btn', function() {
				let id = $(this).data('id');
				let row = $(this).closest('tr');

				if (confirm("Yakin ingin menghapus data ini?")) {

					// Hapus row dari DataTable
					var table = $('#example21').DataTable();
					table.row(row).remove().draw(false);

					// Jalankan PHP
					$.post("modul/ulasan_produk/aksi_ulasan_produk.php?module=ulasan_produk&act=hapus1", { id: id });
				}
			});

			
</script>