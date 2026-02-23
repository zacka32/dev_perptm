<?php
session_start();
$userid=$_SESSION['userid'];	
$folder="modul/banner";
$moduleAkses='banner';
$module="banner";
$aksi="modul/banner/aksi_banner.php";
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
                        <h3 class="box-title">Banner </h3>
                    </div>
                    <div class="col-xl-3 pull-right">
                        <?php 
            if (hakakses($userid,$moduleAkses,'buat')) { ?>
                        <a href="?module=banner&act=tambah" class="btn btn-block btn-success pull-right"
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
                    <table id="tbl_banner" class="display table table-bordered table-striped " width="100%">
                        <thead>
                            <tr class="color_header">
                                <th>No</th>
                                <th>Posisi </th>
                                <th>Judul 1</th>
                                <th>Judul 2</th>
                                <th>Judul 3</th>

                                <th>gambar </th>
                                <th width='5%'>Aksi</th>
                            </tr>

                            <!-- BARIS FILTER -->


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
function hapusbanner(no_banner) {
    if (confirm("Apakah Anda yakin ingin menghapus ini")) {
        var userid = <?php echo "$_SESSION[userid]"; ?>;
        var dataString = 'userid=' + userid + '&banner_id=' + no_banner;
        $.ajax({
            type: 'POST',
            data: dataString,
            url: 'modul/banner/aksi_banner.php?module=banner&act=hapusbanner',
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
  case "editbanner":
      if (hakakses($userid,'banner','edit')) {
          $id = encrypt_decrypt('decrypt',$_GET['id']);
          $ed=$db->prepare("SELECT * FROM banner WHERE id_banner='$id'");
          $ed->execute();        
          $e=$ed->fetch();
    ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-xl-6 pull-left">
                        <h3 class="box-title" style="color: #2b31e2;">Edit banner</h3>
                    </div>
                </div>
                <form autocomplete="off" class="simpanhtml"
                    onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}"
                    action="<?php echo"$aksi?module=banner&act=update";?>" enctype="multipart/form-data" method="POST"
                    class="">
                    <!-- Custom Tabs -->
                    <div class="box-body">

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Nama banner</label>
                            <div style="background:#fff;" class="input-group col-md-4">
                                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                                <input type="text" class="form-control" value="<?php echo $e['nama_banner'];?>"
                                    name="nama_banner" id="nama_banner" required="required">
                                <input type="hidden" class="form-control" value="<?php echo $e['id_banner'];?>"
                                    name="id_banner">
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

                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Posisi</label>
                        <div style="background:#fff;" class="input-group col-md-8">
                            <span class="input-group-addon"><b> <i class="fa fa-edit"></i></b></span>
                            <select name="posisi" id="posisi" class="form-control" required>
                                <?php  echo '<option value="" >Pilih Posisi</option>';
                    $sh=$db->prepare("SELECT * FROM master_posisi_banner  ORDER BY urutan ASC");
                    $sh->execute();        
                    while($ro=$sh->fetch()){
                       if ($ro['nama'] == $e['posisi']) {
                                $selected = 'selected="selected"';
                            } else {
                                    $selected = ''; 
                            }
                        echo "<option $selected value='" . $ro['nama'] . "'>" . $ro['nama_tampil'] . "</option>";   
                                           
                    } 
                      
                    ?>
                            </select>

                        </div>
                    </div>




                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Font Atas</label>
                        <div style="background:#fff;" class="input-group col-md-8">
                            <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                            <input type="text" class="form-control" value="<?php echo $e['teks1'];?>" name="font_atas"
                                id="font_atas">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Font Tengah</label>
                        <div style="background:#fff;" class="input-group col-md-8">
                            <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                            <input type="text" class="form-control" value="<?php echo $e['teks2'];?>" name="font_tengah"
                                id="font_tengah">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Font Bawah</label>
                        <div style="background:#fff;" class="input-group col-md-8">
                            <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                            <input type="text" class="form-control" value="<?php echo $e['teks3'];?>" name="font_bawah"
                                id="font_bawah">
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

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mediaModal">
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
                        <h3 class="box-title" style="color: #2b31e2;">Entry banner</h3>
                    </div>
                </div>
                <form autocomplete="off" class="simpanhtml"
                    onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}"
                    action="<?php echo"$aksi?module=banner&act=input";?>" enctype="multipart/form-data" method="POST"
                    class="">
                    <!-- Custom Tabs -->
                    <div class="box-body">

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Nama banner</label>
                            <div style="background:#fff;" class="input-group col-md-4">
                                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                                <input type="text" class="form-control" name="nama_banner" id="nama_banner"
                                    required="required">
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Posisi</label>
                            <div style="background:#fff;" class="input-group col-md-8">
                                <span class="input-group-addon"><b> <i class="fa fa-edit"></i></b></span>
                                <select name="posisi" id="posisi" class="form-control" required>
                                    <?php  echo '<option value="" >Pilih Posisi</option>';
                    $sh=$db->prepare("SELECT * FROM master_posisi_banner  ORDER BY urutan ASC");
                    $sh->execute();        
                    while($ro=$sh->fetch()){
                     
                        echo "<option value='" . $ro['nama'] . "'>" . $ro['nama_tampil'] . "</option>";   
                                           
                    } 
                    ?>
                                </select>

                            </div>
                        </div>

                        <script>
                        $(document).ready(function() {

                            $('#posisi').on('change', function() {
                                var val = $(this).val();

                                if (val.indexOf('Baris Utama Atas Slider') !== -1) {

                                    setTimeout(function() {
                                        $('#font_atas, #font_tengah, #font_bawah')
                                            .prop('readonly', false)
                                            .removeAttr('readonly')
                                            .css({
                                                'background-color': '#fff',
                                                'pointer-events': 'auto'
                                            });
                                    }, 50);

                                } else {

                                    setTimeout(function() {
                                        $('#font_atas, #font_tengah, #font_bawah')
                                            .prop('readonly', true)
                                            .attr('readonly', true)
                                            .css({
                                                'background-color': '#eee',
                                                'pointer-events': 'none'
                                            })
                                            .val('');
                                    }, 50);

                                }
                            });

                        });
                        </script>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Font Atas</label>
                            <div style="background:#fff;" class="input-group col-md-8">
                                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                                <input type="text" class="form-control" value="" readonly name="font_atas"
                                    id="font_atas">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Font Tengah</label>
                            <div style="background:#fff;" class="input-group col-md-8">
                                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                                <input type="text" class="form-control" value="" readonly name="font_tengah"
                                    id="font_tengah">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Font Bawah</label>
                            <div style="background:#fff;" class="input-group col-md-8">
                                <span class="input-group-addon"><b><i class="fa fa-edit"></i></b></span>
                                <input type="text" class="form-control" value="" readonly name="font_bawah"
                                    id="font_bawah">
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
});

</script>
<script>
$(document).ready(function(){
  $('#tbl_banner').DataTable({
    processing: true,
    serverSide: true,
    ajax: "modul/banner/load_data.php?act=list_index",
    order: [[0, "desc"]],
    responsive: true,
    rowCallback: function(row, data){
      if (data[7] == 'D') {
        $(row).css('background-color', '#ba000fff');
      }
    }
  });
});
</script>
<style>

  tr:has(.row-danger) {
  background-color: #ee2132ff !important;
  color: #b90617ff;
}


</style>
