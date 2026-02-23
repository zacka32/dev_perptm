<?php
session_start();
$userid=$_SESSION['userid'];	
$folder="modul/gallery";
$moduleAkses='gallery';
$module="gallery";
$aksi="modul/gallery/aksi_gallery.php";
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
                    <div class="col-xl-6 pull-left">
                        <h3 class="box-title">Gallery </h3>
                    </div>
                    <div class="col-xl-3 pull-right">
                        <?php 
            if (hakakses($userid,$moduleAkses,'buat')) { ?>
                        <a href="?module=gallery&act=tambah" class="btn btn-block btn-success pull-right"
                            title="Klik untuk tambah data" data-tt="tooltip" data-placement="top"><b><i
                                    class="fa fa-fw fa-user-plus"></i>Add</b></b></a>
                        <?php  } ?>
                    </div>
                    <div class="col-xl-3 pull-right" style="margin-right: 3px;">

                    </div>
                </div>

                <!-- Custom Tabs -->
                <div class="box-body">
                    <!-- <table id="example" class="" cellspacing="0" width="100%"> -->
                    <table id="tbl_gallery" class="display table table-bordered table-striped " width="100%">
                        <thead>
                            <tr class="color_header">
                                <th>No</th>
                                
                               
                                <th>gambar </th>
                                <th width='5%'>Aksi</th>
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

<div class="modal fade" id="imgModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center p-2">
        <img id="modalImg" src="" class="preview-img" alt="">
      </div>
    </div>
  </div>
</div>

<script>
$(document).on('click', '.img-preview', function() {
    var src = $(this).data('img');
    $('#modalImg').attr('src', src);
    $('#imgModal').modal('show');
});
</script>
<style>
.preview-img {
    max-width: 100%;
    max-height: 80vh;   /* maksimal 80% tinggi layar */
    object-fit: contain;
    border-radius: 8px;
}
  
</style>


<script type="text/javascript">
function hapusgallery(no_gallery) {
    if (confirm("Apakah Anda yakin ingin menghapus ini")) {
        var userid = <?php echo "$_SESSION[userid]"; ?>;
        var dataString = 'userid=' + userid + '&gallery_id=' + no_gallery;
        $.ajax({
            type: 'POST',
            data: dataString,
            url: 'modul/gallery/aksi_gallery.php?module=gallery&act=hapusgallery',
            success: function(data) {
                location.reload(true);
            }
        });
    } else { // if dialog
        return false;
    }
}
</script>
<?php }else{
    echo "<script>alert('Anda Tidak Memiliki Akses !');
            window.location.href='?module=home'</script>";
  }
    break;  
  case "editgallery":
      if (hakakses($userid,'gallery','edit')) {
          $id = encrypt_decrypt('decrypt',$_GET['id']);
          $ed=$db->prepare("SELECT * FROM gallery WHERE id_gallery='$id'");
          $ed->execute();        
          $e=$ed->fetch();
    ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-xl-6 pull-left">
                        <h3 class="box-title" style="color: #2b31e2;">Edit gallery</h3>
                    </div>
                </div>
                <form autocomplete="off" class="simpanhtml"
                    onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}"
                    action="<?php echo"$aksi?module=gallery&act=update";?>" enctype="multipart/form-data" method="POST"
                    class="">
                    <!-- Custom Tabs -->
                    <div class="box-body">

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Nama gallery</label>
                            <div style="background:#fff;" class="input-group col-md-4">
                                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                                <input type="text" class="form-control" value="<?php echo $e['nama_gallery'];?>"
                                    name="nama_gallery" id="nama_gallery" required="required">
                                <input type="hidden" class="form-control" value="<?php echo $e['id_gallery'];?>"
                                    name="id_gallery">
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
                            <label for="inputPassword3" class="col-sm-3 control-label">URL</label>
                            <div style="background:#fff;" class="input-group col-md-9">
                                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                                <input type="text" class="form-control" value="<?php echo $e['url'];?>" name="url"
                                    id="url" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Deskripsi</label>
                            <div style="background:#fff;" class="input-group col-md-9">
                                <span class="input-group-addon"><b> <i class="fa fa-edit"></i></b></span>
                                <input type="text" class="form-control" value="<?php echo $e['deskripsi'];?>"
                                    name="deskripsi" id="deskripsi">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Gambar Lama</label>
                            <div style="background:#fff;" class="input-group col-md-3">
                                <span class="input-group-addon"><b> <i class="fa fa-calendar"></i></b></span>
                                <img src='gambar/<?php echo $e['gambar'];?>' width='300'>

                            </div>
                        </div>
                        <hr>
                        Jika Ingin Ganti Pilih gambar lagi, jika tidak kosongkan saja

                        <div class="wrap-custom-file">
                            <input type="file" name="image1" id="image1" accept=".gif, .jpg, .png" />
                            <label for="image1">
                                <span>Select Image One</span>
                                <i class="fa fa-plus-circle"></i>
                            </label>
                        </div>


                    </div>



                    <div class="box-footer">
                        <button type="reset" class="btn btn-default" onclick="self.history.back()">Batal</button>
                        <button type="submit" class="btn btn-info pull-right" id=""><i class="fa fa-fw fa-save"></i>
                            Simpan</button>
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
                    <div class="col-xl-6 pull-left">
                        <h3 class="box-title" style="color: #2b31e2;">Entry Gallery</h3>
                    </div>
                </div>
                <form autocomplete="off" class="simpanhtml"
                    onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}"
                    action="<?php echo"$aksi?module=gallery&act=input";?>" enctype="multipart/form-data" method="POST"
                    class="">
                    <!-- Custom Tabs -->
                    <div class="box-body">

                        

                       
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

                    </div>



                    <div class="box-footer">
                        <button type="reset" class="btn btn-default" onclick="self.history.back()">Batal</button>
                        <button type="submit" class="btn btn-info pull-right" id=""><i class="fa fa-fw fa-save"></i>
                            Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</section>
<?php include "modul/gallery/modal_gallery.php"; ?>

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
    $('.form-horizontal').on('submit', function() {

        var self = $(this),
            button = self.find('input[type="submit"], button'),
            submitValue = button.data('submit-value');

        button.attr('disabled', 'disabled').val((submitValue) ? submitValue : 'Please wait ..');

        // return false;
    });
  $('#tbl_gallery').DataTable({
         "drawCallback": function( settings ) {
        $('[data-tt="tooltip"]').tooltip();
        },
        "order": [[ 0, "desc" ]],

        "deferRender": true,
         "ajax": "modul/gallery/load_data.php?act=list_index",
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
         "responsive":true,
        
    });

     



});
</script>
 <script type="text/javascript">
    $('body').addClass("sidebar-collapse"); 
  function hapusdata(no_po) {
    if (confirm("Apakah Anda yakin ingin menghapus ini")) {
  
            var dataString = 'id_auto='+no_po;
        $.ajax({
            type:'POST',
            data:dataString,
            url:'modul/gallery/aksi_gallery.php?module=gallery&act=hapusgallery',
            success:function(data) {
              location.reload(true);        
            }
        });

    } else {  // if dialog
          return false;
        }
  }
  </script>