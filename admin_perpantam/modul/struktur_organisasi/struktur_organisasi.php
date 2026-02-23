<?php
session_start();
$userid=$_SESSION['userid'];	
$folder="modul/struktur_organisasi";
$moduleAkses='struktur_organisasi';
$module="struktur_organisasi";
$aksi="modul/struktur_organisasi/aksi_struktur_organisasi.php";
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
                        <h3 class="box-title">struktur Organisasi </h3>
                    </div>
                    <div class="col-xl-3 pull-right">
                        <?php 
            if (hakakses($userid,$moduleAkses,'buat')) { ?>
                        <a href="?module=struktur_organisasi&act=tambah" class="btn btn-block btn-success pull-right"
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
                    <table id="tbl_struktur_organisasi" class="display table table-bordered table-striped "
                        width="100%">
                        <thead>
                            <tr class="color_header">
                                <th>No</th>
                                <th>Nama </th>
                                <th>Jabatan </th>
                                <th>Atasan</th>
                                <th>Foto</th>
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
    max-height: 80vh;
    /* maksimal 80% tinggi layar */
    object-fit: contain;
    border-radius: 8px;
}
</style>


<script type="text/javascript">
function hapusstruktur_organisasi(no_struktur_organisasi) {
    if (confirm("Apakah Anda yakin ingin menghapus ini")) {
        var userid = <?php echo "$_SESSION[userid]"; ?>;
        var dataString = 'userid=' + userid + '&struktur_organisasi_id=' + no_struktur_organisasi;
        $.ajax({
            type: 'POST',
            data: dataString,
            url: 'modul/struktur_organisasi/aksi_struktur_organisasi.php?module=struktur_organisasi&act=hapusstruktur_organisasi',
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
  case "editstruktur_organisasi":
      if (hakakses($userid,'struktur_organisasi','edit')) {
          $id = encrypt_decrypt('decrypt',$_GET['id']);
          $ed=$db->prepare("SELECT * FROM struktur_organisasi WHERE id='$id'");
          $ed->execute();        
          $e=$ed->fetch();
    ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-xl-6 pull-left">
                        <h3 class="box-title" style="color: #2b31e2;">Form Edit</h3>
                    </div>
                </div>
                <form autocomplete="off" class="simpanhtml"
                    onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}"
                    action="<?php echo"$aksi?module=struktur_organisasi&act=update";?>" enctype="multipart/form-data"
                    method="POST" class="">
                    <!-- Custom Tabs -->
                    <div class="box-body">

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Nama</label>
                            <div style="background:#fff;" class="input-group col-md-4">
                                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                                <input type="text" class="form-control" value="<?php echo $e['nama'];?>" name="nama"
                                    id="nama" required="required">
                                <input type="hidden" class="form-control" value="<?php echo $e['id'];?>" name="id"
                                    id="id" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jabatan</label>
                            <div class="input-group col-md-3" style="background:#fff;">

                                <input type="text" class="form-control" name="jabatan" id="jabatan"
                                    value="<?php echo $e['jabatan'];?>" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Atasan</label>
                            <div class="input-group col-md-3" style="background:#fff;">

                                <select name="parent_id" id="parent_id" class="form-control">

                                    <option value=""> Pilih Atasan</option>

                                    <?php
                                        $q = $db->prepare("SELECT id,nama, jabatan FROM struktur_organisasi ORDER BY nama");
                                        $q->execute();

                                        while($r = $q->fetch(PDO::FETCH_ASSOC)){
                                            $sel = ($r['id']==$e['parent_id']) ? "selected" : "";
                                            echo "<option value='{$r['id']}' $sel>{$r['nama']} - {$r['jabatan']}</option>";
                                        }
                                        ?>

                                </select>

                            </div>
                        </div>




                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Gambar Lama</label>
                            <div style="background:#fff;" class="input-group col-md-3">
                                <!-- <span class="input-group-addon"><b> <i class="fa fa-calendar"></i></b></span> -->
                                <img src='../assets/upload/<?php echo $e['foto'];?>' width='300'>

                            </div>
                        </div>
                        <hr>
                        Jika Ingin Ganti Pilih gambar lagi, jika tidak kosongkan saja

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gambar</label>

                            <div class="col-md-6">

                                <input type="hidden" name="foto" id="gambar">

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
	case "tambah":
  if (hakakses($userid,$moduleAkses,'buat')) {
  ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-xl-6 pull-left">
                        <h3 class="box-title" style="color: #2b31e2;">Entry Data</h3>
                    </div>
                </div>
                <form autocomplete="off" class="simpanhtml"
                    onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}"
                    action="<?php echo"$aksi?module=struktur_organisasi&act=input";?>" enctype="multipart/form-data"
                    method="POST" class="">
                    <!-- Custom Tabs -->
                    <div class="box-body">


                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Nama  </label>
                            <div style="background:#fff;" class="input-group col-md-4">
                                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                                <input type="text" class="form-control" name="nama" id="nama" value="-">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jabatan</label>
                            <div class="input-group col-md-3" style="background:#fff;">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="form-control" name="jabatan" id="jabatan">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Atasan</label>
                            <div class="input-group col-md-3" style="background:#fff;">

                                <select name="parent_id" id="parent_id" class="form-control">

                                    <option value=""> Pilih Atasan</option>

                                    <?php
                                        $q = $db->prepare("SELECT id,nama, jabatan FROM struktur_organisasi ORDER BY nama");
                                        $q->execute();

                                        while($r = $q->fetch(PDO::FETCH_ASSOC)){
                                            $sel = ($r['id']==$e['parent_id']) ? "selected" : "";
                                            echo "<option value='{$r['id']}' $sel>{$r['nama']} - {$r['jabatan']}</option>";
                                        }
                                        ?>

                                </select>

                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gambar</label>

                            <div class="col-md-6">

                                <input type="hidden" name="foto" id="gambar">

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
    $('#tbl_struktur_organisasi').DataTable({
        "drawCallback": function(settings) {
            $('[data-tt="tooltip"]').tooltip();
        },
        "order": [
            [0, "desc"]
        ],

        "deferRender": true,
        "ajax": "modul/struktur_organisasi/load_data.php?act=list_index",
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "responsive": true,

    });





});
</script>
<script type="text/javascript">
$('body').addClass("sidebar-collapse");

function hapusdata(no_po) {
    if (confirm("Apakah Anda yakin ingin menghapus ini")) {

        $.ajax({
            type: 'POST',
            data: {id:no_po},
            url: 'modul/struktur_organisasi/aksi_struktur_organisasi.php?module=struktur_organisasi&act=hapusstruktur_organisasi',
            success: function(res) {

                if(res.trim() == "berhasil"){
                    alert("Data berhasil dihapus");
                    location.reload(true);
                }
                else if(res.trim() == "masih_punya_bawahan"){
                    alert("Tidak bisa dihapus — Data Ini masih punya bawahan ");
                }
                else{
                    alert("Gagal hapus data");
                }

            }
        });

    } else {
        return false;
    }
}

</script>



<script type="text/javascript" src="bootstrap/js/bootstrap-filestyle.min.js"> </script>

<script src="../admin_perpantam/bower_components/ckeditor/ckeditor.js"></script>
<script>
// Inisialisasi CKEditor tanpa plugin gambar/upload
CKEDITOR.replace('deskripsi', {
    // disable image & upload plugins (prevents file/image upload UI)
    removePlugins: 'image,uploadimage,uploadfile,resize',
    // custom toolbar hanya untuk teks / paragraf formatting
    toolbar: [{
            name: 'clipboard',
            items: ['Undo', 'Redo']
        },
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat']
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter',
                'JustifyRight'
            ]
        },
        {
            name: 'links',
            items: ['Link', 'Unlink']
        },
        {
            name: 'styles',
            items: ['Format', 'Font', 'FontSize']
        },
        {
            name: 'tools',
            items: ['Maximize']
        }
    ],
    // membatasi paste dari Word agar rapi (opsional)
    pasteFromWordPromptCleanup: true,
    // block content rules: biarkan tag paragraf, list, formatting, link, blockquote, heading
    allowedContent: 'p br ul ol li a[*]{*}(*); strong em b i; blockquote; h1 h2 h3;'
});
</script>