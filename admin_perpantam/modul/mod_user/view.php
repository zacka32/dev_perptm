<?php 
$id =$_GET['userid'];
$edit=$db->prepare("SELECT * FROM users WHERE userid='$id'");
$edit->execute();        
$r=$edit->fetch();
	 ?>
<section class="content-header">
    <h1 class="pad">
        Rincian data User
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <?php 	
					        if(!empty($r['gambar']))  {
                                echo" <img class='profile-user-img img-responsive img-circle' src='gambar/$r[gambar]' alt='User profile picture' width=128>";
									
							}else {
								echo" <img class='profile-user-img img-responsive img-circle bg-green' src='dist/img/user8-128x128.jpg' alt='User profile picture' width=128>";
							}
                            if ($r['l_status']=='A') {
                                $l_statusColor = 'orange';
                                  $l_status = 'Belum Aktif';
                                  // $button .= '<a href=?module=polling&act=stop&id='.$id.'" class="btn-sm btn-warning" 
                                  //           style="width: 20px;" title="Klik untuk Stop Publish" data-tt="tooltip" data-placement="top">
                                  //           <i class="fa fa-pause"></i></a>';
                              }else if($r['l_status']=='C') {
                                 // $status = 'Belum Diisi';
                                 $l_statusColor = 'green';
                                 $l_status = 'Aktif';
                                  // $button .='';
                              }  else if($r['l_status']=='D') {
                                $l_statusColor = 'red';
                                // $status = 'Belum Diisi';
                                 $l_status = 'Delete';
                                 // $button .='';
                             }      
	
							?>
                    <h3 class="profile-username text-center"><?php echo "$r[nama_lengkap]"; ?></h3>
                    <p class="text-muted text-center"><?php echo "$r[kategori]"; ?></p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Username</b> <a class="pull-right"><?php echo "$r[userid]"; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Tgl. Masuk</b> <a class="pull-right"><?php echo tgl_indo($r['entry_date']); ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Status User</b> <a
                                class="pull-right badge bg-<?php echo "$l_statusColor"; ?>"><?php echo "$l_status"; ?></a>
                        </li>
                        
                        
                    </ul>
                   
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#Profile" data-toggle="tab"><i class="fa fa-fw fa-user"></i>Profile</a>
                    </li>
                    <li><a href="#Apartement" data-toggle="tab"><i class="fa fa-fw fa-book"></i>Detail</a></li>
                 
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="Profile">
                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <form action="<?php echo"$aksi?module=user&act=update";?>" enctype="multipart/form-data"
                                method="POST" class=""
                                onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}">
                                <table class="table table-striped">
                                    <tbody>
                                        <input type="hidden" value="<?php echo "$r[userid]"; ?>" name="userid"
                                            id="userid" required="required">
                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <td><span class="nama_text"><input type="text" class="form-control"
                                                        value="<?php echo "$r[nama_lengkap]"; ?>" name="nama_lengkap"
                                                        id="nama_lengkap" required="required">
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <td>Username</td>
                                            <td><span class="nama_text"><input disabled type="text" class="form-control"
                                                        value="<?php echo "$r[userid]"; ?>" required="required">
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <td>Password Baru 
                                                <p style="color:red">(Kosongkan jika tidak ingin ganti)</p>
                                            </td>
                                            <td><span class="nama_text"><input type="text" class="form-control"
                                                         name="new_password"
                                                        id="new_password">
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Panggilan</td>
                                            <td><span class="nama_text"><input type="text" class="form-control"
                                                        value="<?php echo "$r[nama_panggilan]"; ?>"
                                                        name="nama_panggilan" id="nama_panggilan">
                                                </span></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Total Point</td>
                                            <td><span class="nama_text"><input type="number" class="form-control"
                                                        value="<?php echo "$r[point]"; ?>" name="point" id="point"
                                                        required="required">
                                                </span></td>
                                        </tr> -->
                                        <tr>
                                            <td>No Telp</td>
                                            <td><span class="nama_text"><input type="text" class="form-control"
                                                        value="<?php echo "$r[no_hp]"; ?>" name="no_hp" id="no_hp"
                                                        required="required">
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><span class="nama_text"><input type="text" class="form-control"
                                                        value="<?php echo "$r[email]"; ?>" name="email" id="email"
                                                        required="required">
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Lahir</td>
                                            <td><span class="nama_text"><input type="date" class="form-control"
                                                        name="tgl_lahir" id="tgl_lahir"  value="<?php echo "$r[tgl_lahir]"; ?>"  required="required">
                                                </span></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Tgl Join</td>
                                            <td><span class="nama_text"><input type="date" class="form-control"
                                                        name="tgl_join" id="tgl_join"  value="<?php echo "$r[tgl_join]"; ?>"  required="required">
                                                </span></td>
                                        </tr> -->
                                        <!-- <tr>
                                            <td>kategori</td>
                                            <td><span class="nama_text">
                                                    <select name="kategori" class="form-control select2"
                                                        required="required" id='kategori'>
                                                        <?php  echo "<option value='$r[kategori]'>$r[kategori]</option>";   ?>
                                                        <option value="pemain">pemain</option>
                                                        <option value="pelatih">pelatih</option>
                                                    </select>
                                                </span></td>
                                        </tr> -->
                                        <tr>
                                            <td>Status User</td>
                                            <td><span class="nama_text">
                                                    <select name="l_status" class="form-control select2"
                                                        required="required" id='l_status'>
                                                        <?php  echo "<option value='$r[l_status]'>$l_status </option>";   ?>
                                                        <option value="C">Aktif</option>
                                                        <option value="D">Delete</option>
                                                    </select>
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <button type="reset" class="btn btn-danger  pull-right"
                                                    onclick=self.history.back() aria-hidden="true">Batal</button>
                                                <button type="submit" class="btn btn-info pull-right" id=""><i
                                                        class="fa fa-fw fa-save"></i> Simpan</button>
                                            </td>
                                        </tr>

                                        <!-- <div class="wrap-custom-file">
                                            <input type="file" name="image1" id="image1" accept=".gif, .jpg, .png">
                                            <label for="image1">
                                                <span>Select Image One</span>
                                                <i class="fa fa-plus-circle"></i>
                                            </label>
                                        </div> -->

                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="Apartement">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">History Pemain</h3>
                                <!-- <a href="#ModalJab" class="btn btn-block btn-primary" style="width: 150px;" data-toggle="modal"><b>Add Apartement</b></a> -->
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Tgl</th>
                                            <th>Bermain</th>
                                            <th>Cetak Gol</th>
                                            <th>Aksi</th>
                                        </tr>
                                        <?php
											$ed=$db->prepare("SELECT * FROM master_kamar a
											left join master_gedung b on a.id_gedung=b.id_gedung WHERE a.pemilik='$id'");
											$ed->execute();        
											while($e=$ed->fetch()) {
											echo "<tr>
											<td>$e[nama_gedung]</td>
											<td>$e[nama_kamar]</td>
											<td>$e[penghuni]</td>
											<td></td></tr>";
											}
										?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="ModalJab" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Apartemen</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Gedung</label>
                                <div style="background:#fff;" class="input-group col-md-8">
                                    <span class="input-group-addon"><i class="fa fa-bars fa-fw"></i></span>
                                    <select class="form-control select2" name="id_gedung" id="id_gedung" required>
                                        <?php  echo '<option value="">Pilih</option>';
                                        $sh=$db->prepare("SELECT * FROM master_gedung");
                                            $sh->execute();        
                                        while($ro=$sh->fetch()){
                                            echo "<option value='" . $ro['id_gedung'] . "'>" . $ro['nama_gedung'] . "</option>";         
                                        } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Kamar/Apartemen</label>
                                <div style="background:#fff;" class="input-group col-md-8">
                                    <span class="input-group-addon"><i class="fa fa-bars fa-fw"></i></span>
                                    <select class="form-control select2" name="kamar" id="kamar" required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a type="button" id="simpankamar" class="btn btn-primary">Save</a>
                            <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                        </div>
                    </div>
                </div>
            </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $("#reloads").click(function() {
        $("#sub_berat").val($("#total_berat").val());
        $("#sub_ongkir").val($("#total_ongkir").val());
        $("#sub_harga").val($("#total_produk").val());
        $("#sub_tambahan").val($("#biaya_penanganan").val());
        $("#sub_total").val($("#total").val());
    });
    $("#id_gedung").change(function() {
        var id_gedung = $("#id_gedung").val();
        $.ajax({
            type: 'POST',
            url: "modul/mod_user/aksi_user.php?module=user&act=kamar",
            data: {
                id_gedung: id_gedung
            },
            cache: false,
            success: function(msg) {
                $("#kamar").html(msg);
            }
        });
    });
    $("#simpankamar").click(function() {
        var id_gedung = $("#id_gedung").val();
        var kamar = $("#kamar").val();
        var userid = "<?php echo $id; ?>";
        if (id_gedung == '' || kamar == '' || userid == '') {
            alert("Masih Ada Field yang kosong");
            document.getElementById("kamar").focus();
        } else {
            $.ajax({
                type: 'POST',
                url: "modul/mod_user/aksi_user.php?module=user&act=tambahkamar",
                data: {
                    id_gedung: id_gedung,
                    kamar: kamar,
                    userid: userid
                },
                beforeSend: function() {
                    // $("#wait").css("display", "block");
                    $("#save").attr("disabled", true);
                    $(':button').prop('disabled', true);
                    return true;
                },
                success: function(data) {
                    $('#ModalJab').addClass('out');
                    $('#ModalJab').removeClass('modal-active');
                    $('#ModalJab').modal('toggle');
                    $('#tabeldetail').DataTable().draw();
                    location.reload();
                    $(':button').prop('disabled', false);
                    return true;
                },
                error: function() {
                    alert("Gagal disimpan");
                    $(':button').prop('disabled', false);
                    return true;
                }
            });
        } //if validasi     
    });
});
</script>


<!-- //upload gambar -->

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

.wrap-custom-file label:hover span {
    color: #333;
}

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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script type="text/javascript">
$('input[type="file"]').each(function() {
    var $file = $(this),
        $label = $file.next('label'),
        $labelText = $label.find('span'),
        labelDefault = $labelText.text();
    $file.on('change', function(event) {
        var fileName = $file.val().split('\\').pop(),
            tmppath = URL.createObjectURL(event.target.files[0]);
        if (fileName) {
            $label
                .addClass('file-ok')
                .css('background-image', 'url(' + tmppath + ')');
            $labelText.text(fileName);
        } else {
            $label.removeClass('file-ok');
            $labelText.text(labelDefault);
        }
    });
});
</script>
<script type="text/javascript" src="bootstrap/js/bootstrap-filestyle.min.js"> </script>