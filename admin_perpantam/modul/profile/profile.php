<?php
session_start();
$userid=$_SESSION['userid'];	
$folder="modul/profile";
$moduleAkses='profile';
$module="profile";
$aksi="modul/profile/aksi_profile.php";
switch($_GET['act']){
  // Tampil Modul
  default:
  if (hakakses($userid,$moduleAkses,'lihat')) {

    
      $ed=$db->prepare("SELECT *
FROM profile
ORDER BY id_profile DESC
LIMIT 1;
");
      $ed->execute();        
      $e=$ed->fetch();
    ?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <div class="col-xl-6 pull-left"><h3 class="box-title" style="color: #2b31e2;">Edit profile</h3>  
        </div>
      </div>
        <form autocomplete="off" class="simpanhtml" onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}" action="<?php echo"$aksi?module=profile&act=update";?>" enctype="multipart/form-data" method="POST" class="">
        <!-- Custom Tabs -->
        <div class="box-body">
          
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Tag Line/ Judul</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" value="<?php echo $e['judul'];?>"  name="judul" id="judul" required="required" >
                  <input type="hidden" class="form-control" value="<?php echo $e['id_profile'];?>"  name="id_profile">
              </div>
          </div>
          
          <!-- <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Koornidinat Google</label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="hidden" class="form-control" value="<?php echo $e['lokasi_google'];?>"  name="url" id="url" required="required" >
              </div>
          </div> -->
          <input type="hidden" class="form-control" value="<?php echo $e['lokasi_google'];?>"  name="url" id="url" required="required" >
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Deskripsi</label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  
                  <textarea name="deskripsi" id="deskripsi" rows="10" class="form-control"><?php echo $e['deskripsi'];?></textarea>
                
              </div>
          </div>

          
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Alamat</label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
               
                  <input name="alamat" id="alamat" class="form-control" value="<?php echo $e['alamat'];?>">
              </div>
          </div>

          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">email</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" value="<?php echo $e['email'];?>"  name="email" id="email" required="required" >
                  
              </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Nomor Telp</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" value="<?php echo $e['no_telp'];?>"  name="no_telp" id="no_telp" required="required" >
                  
              </div>
          </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Fungsi</label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  
                  <textarea name="fungsi" id="fungsi" rows="10" class="form-control"><?php echo $e['fungsi'];?></textarea>
                
              </div>
          </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Tujuan </label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  
                  <textarea name="tujuan" id="tujuan" rows="10" class="form-control"><?php echo $e['tujuan'];?></textarea>
                
              </div>
          </div>

          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">harmonis </label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  
                  <textarea name="harmonis" id="harmonis" rows="10" class="form-control"><?php echo $e['harmonis'];?></textarea>
                
              </div>
          </div>
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">kesejahteraan </label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  
                  <textarea name="kesejahteraan" id="kesejahteraan" rows="10" class="form-control"><?php echo $e['kesejahteraan'];?></textarea>
                
              </div>
          </div>

          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">kolaborasi  </label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  
                  <textarea name="kolaborasi" id="kolaborasi" rows="10" class="form-control"><?php echo $e['kolaborasi'];?></textarea>
                
              </div>
          </div>

          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">advokasi  </label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  
                  <textarea name="advokasi" id="advokasi" rows="10" class="form-control"><?php echo $e['advokasi'];?></textarea>
                
              </div>
          </div>


          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Deskripsi Footer</label>
              <div style="background:#fff;" class="input-group col-md-9">
                <span class="input-group-addon"><b>              <i class="fa fa-edit"></i></b></span>
                  
                  <textarea name="deskripsi2" id="deskripsi2" rows="10" class="form-control"><?php echo $e['deskripsi2'];?></textarea>
                
              </div>
          </div>

          

        
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Gambar Lama</label>
              <div style="background:#fff;" class="input-group col-md-3">
                <span class="input-group-addon"><b>              <i class="fa fa-calendar"></i></b></span>
                  <img src='../assets/upload/<?php echo $e['gambar'];?>' width='300' >
                
              </div>
          </div>
          <hr>
          Jika Ingin Ganti Pilih gambar lagi, jika tidak kosongkan saja
          
          <div class="form-group">
                            <label class="col-sm-3 control-label">Gambar</label>

                            <div class="col-md-6">

                                <input type="hidden" name="gambar" id="gambar">

                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#mediaModal">
                                    Pilih Gambar
                                </button>

                                <br><br>

                                <img id="preview" style="max-width:200px;border:1px solid #ddd;padding:5px">

                            </div>
                        </div>

							
			

         
          
         
          
        <div class="box-footer">
          <button type="reset" class="btn btn-default" onclick="self.history.back()">Batal</button>
          <button  type="submit" class="btn btn-info pull-right" id=""><i class="fa fa-fw fa-save"></i> Simpan</button>
         </div>
    </form>
      </div>
      </div>
      
    </div>
   
  </section>
  <?php include "modul/gallery/modal_gallery.php"; ?>

<script src="../admin_perpantam/bower_components/ckeditor/ckeditor.js"></script>
<script>
  // Inisialisasi CKEditor tanpa plugin gambar/upload
  CKEDITOR.replace('deskripsi', {
    // disable image & upload plugins (prevents file/image upload UI)
    removePlugins: 'image,uploadimage,uploadfile,resize',
    // custom toolbar hanya untuk teks / paragraf formatting
    toolbar: [
      { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
      { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat' ] },
      { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Blockquote', '-', 'JustifyLeft','JustifyCenter','JustifyRight'] },
      { name: 'links', items: [ 'Link','Unlink' ] },
      { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
      { name: 'tools', items: [ 'Maximize' ] }
    ],
    // membatasi paste dari Word agar rapi (opsional)
    pasteFromWordPromptCleanup: true,
    // block content rules: biarkan tag paragraf, list, formatting, link, blockquote, heading
    allowedContent: 'p br ul ol li a[*]{*}(*); strong em b i; blockquote; h1 h2 h3;'
  });
</script>
<script>
  // Inisialisasi CKEditor tanpa plugin gambar/upload
  CKEDITOR.replace('fungsi', {
    // disable image & upload plugins (prevents file/image upload UI)
    removePlugins: 'image,uploadimage,uploadfile,resize',
    // custom toolbar hanya untuk teks / paragraf formatting
    toolbar: [
      { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
      { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat' ] },
      { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Blockquote', '-', 'JustifyLeft','JustifyCenter','JustifyRight'] },
      { name: 'links', items: [ 'Link','Unlink' ] },
      { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
      { name: 'tools', items: [ 'Maximize' ] }
    ],
    // membatasi paste dari Word agar rapi (opsional)
    pasteFromWordPromptCleanup: true,
    // block content rules: biarkan tag paragraf, list, formatting, link, blockquote, heading
    allowedContent: 'p br ul ol li a[*]{*}(*); strong em b i; blockquote; h1 h2 h3;'
  });
</script>
<script>
  // Inisialisasi CKEditor tanpa plugin gambar/upload
  CKEDITOR.replace('tujuan', {
    // disable image & upload plugins (prevents file/image upload UI)
    removePlugins: 'image,uploadimage,uploadfile,resize',
    // custom toolbar hanya untuk teks / paragraf formatting
    toolbar: [
      { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
      { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat' ] },
      { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Blockquote', '-', 'JustifyLeft','JustifyCenter','JustifyRight'] },
      { name: 'links', items: [ 'Link','Unlink' ] },
      { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
      { name: 'tools', items: [ 'Maximize' ] }
    ],
    // membatasi paste dari Word agar rapi (opsional)
    pasteFromWordPromptCleanup: true,
    // block content rules: biarkan tag paragraf, list, formatting, link, blockquote, heading
    allowedContent: 'p br ul ol li a[*]{*}(*); strong em b i; blockquote; h1 h2 h3;'
  });
</script>
<!-- <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('deskripsi') 
    //bootstrap WYSIHTML5 - text editor
   
  })
</script> -->
<!-- CK Editor -->
  
<?php
}else{
    echo "<script>alert('Anda Tidak Memiliki Akses !');
            window.location.href='?module=home'</script>";
  }
  break;  
	case "edit_sosmed":
  if (hakakses($userid,$moduleAkses,'buat')) {
  
  $ed=$db->prepare("SELECT *
FROM profile
ORDER BY id_profile DESC
LIMIT 1;
");
      $ed->execute();        
      $e=$ed->fetch();
    ?>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <div class="col-xl-6 pull-left"><h3 class="box-title" style="color: #2b31e2;">Edit profile</h3>  
        </div>
      </div>
        <form autocomplete="off" class="simpanhtml" onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}" action="<?php echo"$aksi?module=profile&act=update_sosmed";?>" enctype="multipart/form-data" method="POST" class="">
        <!-- Custom Tabs -->
        <div class="box-body">
          
          <input type="hidden" class="form-control" value="<?php echo $e['id_profile'];?>"  name="id_profile">
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-5 control-label">Nomor WA (harus pakai 62)</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="number" class="form-control" value="<?php echo $e['no_wa'];?>"  name="no_wa" id="no_wa" required="required" >
                  
              </div>
          </div>

          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Link Youtube</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" value="<?php echo $e['link_youtube'];?>"  name="link_youtube" >
                  
              </div>
          </div>

          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Link Facebook</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" value="<?php echo $e['link_facebook'];?>"  name="link_facebook" >
                  
              </div>
          </div>

          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Link IG</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" value="<?php echo $e['link_ig'];?>"  name="link_ig" >
                  
              </div>
          </div>

          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Link Tiktok</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" value="<?php echo $e['link_tiktok'];?>"  name="link_tiktok" >
                  
              </div>
          </div>

          <div class="form-group">
              <label for="inputPassword3" class="col-sm-3 control-label">Link Twitter</label>
              <div style="background:#fff;" class="input-group col-md-4">
                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                  <input type="text" class="form-control" value="<?php echo $e['link_twitter'];?>"  name="link_twitter" >
                  
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
    $('#tbl_profile').DataTable( {
        "drawCallback": function( settings ) {
        $('[data-tt="tooltip"]').tooltip();
        },
        "order": [[ 0, "desc" ]],

        "deferRender": true,
        "processing": true,
        "serverSide": true,
        "responsive":true,
        // "scrollX": true,
        "ajax": "modul/profile/load_data.php?act=list_index",
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
<!-- <script type="text/javascript" src="bootstrap/js/bootstrap-filestyle.min.js"> </script> -->
