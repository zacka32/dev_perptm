<?php
session_start();
$userid=$_SESSION['userid'];	
$folder="modul/news";
$moduleAkses='news';
$module="news";
$aksi="modul/news/aksi_news.php";
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
                        <h3 class="box-title">Berita Dan Informasi </h3>
                    </div>
                    <div class="col-xl-3 pull-right">
                        <?php 
            if (hakakses($userid,$moduleAkses,'buat')) { ?>
                        <a href="?module=news&act=tambah" class="btn btn-block btn-success pull-right"
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
                    <table id="tbl_news" class="display table table-bordered table-striped " width="100%">
                        <thead>
                            <tr class="color_header">
                                <th>No</th>
                                <th>Judul </th>
                                <th>Deskripsi </th>
                                <th>Tanggal</th>
                                <th>Tag</th>
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
    max-height: 80vh;
    /* maksimal 80% tinggi layar */
    object-fit: contain;
    border-radius: 8px;
}
</style>


<script type="text/javascript">
function hapusnews(no_news) {
    if (confirm("Apakah Anda yakin ingin menghapus ini")) {
        var userid = <?php echo "$_SESSION[userid]"; ?>;
        var dataString = 'userid=' + userid + '&news_id=' + no_news;
        $.ajax({
            type: 'POST',
            data: dataString,
            url: 'modul/news/aksi_news.php?module=news&act=hapusnews',
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
  case "editnews":
      if (hakakses($userid,'news','edit')) {
          $id = encrypt_decrypt('decrypt',$_GET['id']);
          $ed=$db->prepare("SELECT * FROM news WHERE id_auto='$id'");
          $ed->execute();        
          $e=$ed->fetch();
    ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-xl-6 pull-left">
                        <h3 class="box-title" style="color: #2b31e2;">Edit Berita Dan Informasi</h3>
                    </div>
                </div>
                <form autocomplete="off" class="simpanhtml"
                    onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}"
                    action="<?php echo"$aksi?module=news&act=update";?>" enctype="multipart/form-data" method="POST"
                    class="">
                    <!-- Custom Tabs -->
                    <div class="box-body">

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Judul Berita Dan
                                Informasi</label>
                            <div style="background:#fff;" class="input-group col-md-4">
                                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                                <input type="text" class="form-control" value="<?php echo $e['judul'];?>" name="judul"
                                    id="judul" required="required">
                                <input type="hidden" class="form-control" value="<?php echo $e['id_auto'];?>"
                                    name="id_auto" id="id_auto" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tgl Mulai</label>
                            <div class="input-group col-md-3" style="background:#fff;">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="datetime-local" class="form-control"
                                    value="<?= date('Y-m-d\TH:i', strtotime($e['mulai'])) ?>" name="mulai" id="mulai">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tag</label>
                            <?php $tag = $e['tag'] ?? ''; ?>
                            <div class="col-md-9">
                                <label class="radio-inline">
                                    <input type="radio" name="tag" value="Informasi"
                                        <?= ($tag=='Informasi'?'checked':'') ?>>
                                    Informasi
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="tag" value="Berita" <?= ($tag=='Berita'?'checked':'') ?>>
                                    Berita
                                </label>
                            </div>
                        </div>



                         <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Deskripsi</label>
                            <div style="background:#fff;" class="input-group col-md-9">
                                <textarea name="deskripsi" id="deskripsi" rows="100" cols="100%" style="height:400px;">
                                             <?php echo "$e[deskripsi]"; ?>
                                        </textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Gambar Lama</label>
                            <div style="background:#fff;" class="input-group col-md-3">
                                <span class="input-group-addon"><b> <i class="fa fa-calendar"></i></b></span>
                                <img src='../assets/upload/<?php echo $e['gambar'];?>' width='300'>

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
                        <h3 class="box-title" style="color: #2b31e2;">Entry news</h3>
                    </div>
                </div>
                <form autocomplete="off" class="simpanhtml"
                    onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}"
                    action="<?php echo"$aksi?module=news&act=input";?>" enctype="multipart/form-data" method="POST"
                    class="">
                    <!-- Custom Tabs -->
                    <div class="box-body">


                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Judul </label>
                            <div style="background:#fff;" class="input-group col-md-4">
                                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                                <input type="text" class="form-control" name="title" id="title" value="-">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tgl Mulai</label>
                            <div class="input-group col-md-3" style="background:#fff;">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="date" class="form-control" name="mulai" id="mulai">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tag</label>
                            <div class="col-md-9">

                                <label class="radio-inline">
                                    <input type="radio" name="tag" value="Informasi" required>
                                    Informasi
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="tag" value="Berita">
                                    Berita
                                </label>

                            </div>
                        </div>
                        <br>
                        <br>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Deskripsi</label>
                            <div style="background:#fff;" class="input-group col-md-9">
                                <textarea name="deskripsi" id="deskripsi" rows="100" cols="100%" style="height:400px;">
                                             <?php echo "$r[deskripsi]"; ?>
                                        </textarea>
                            </div>
                        </div>





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
    $('#tbl_news').DataTable({
        "drawCallback": function(settings) {
            $('[data-tt="tooltip"]').tooltip();
        },
        "order": [
            [0, "desc"]
        ],

        "deferRender": true,
        "ajax": "modul/news/load_data.php?act=list_index",
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

        var dataString = 'id_auto=' + no_po;
        $.ajax({
            type: 'POST',
            data: dataString,
            url: 'modul/news/aksi_news.php?module=news&act=hapusnews',
            success: function(data) {
                location.reload(true);
            }
        });

    } else { // if dialog
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

