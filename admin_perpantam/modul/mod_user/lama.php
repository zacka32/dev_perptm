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
					// if(!empty($r['C_FOTO']))  {
					// 			 if($r['C_KELAMIN'] == 'L') {
									echo" <img class='profile-user-img img-responsive img-circle bg-green' src='dist/img/user8-128x128.jpg' alt='User profile picture' width=128>";
							// 	} else {
							// 		echo" <img class='profile-user-img img-responsive img-circle' src='png/Office-Girl-icon.png' alt='User profile picture' width=128>";
							// 	}
							// }else {
							// 	echo" <img class='profile-user-img img-responsive img-circle' src='gambar/$r[C_FOTO]' alt='User profile picture' width=128>";
							// }
                            // if ($r['l_status']=='A') {
                            //     $l_statusColor = 'orange';
                            //       $l_status = 'Belum Aktif';
                            //       // $button .= '<a href=?module=polling&act=stop&id='.$id.'" class="btn-sm btn-warning" 
                            //       //           style="width: 20px;" title="Klik untuk Stop Publish" data-tt="tooltip" data-placement="top">
                            //       //           <i class="fa fa-pause"></i></a>';
                            //   }else if($r['l_status']=='C') {
                            //      // $status = 'Belum Diisi';
                            //      $l_statusColor = 'green';
                            //      $l_status = 'Aktif';
                            //       // $button .='';
                            //   }  else if($r['l_status']=='D') {
                            //     $l_statusColor = 'red';
                            //     // $status = 'Belum Diisi';
                            //      $l_status = 'Delete';
                            //      // $button .='';
                            //  }      
	
							?>
                    <h3 class="profile-username text-center"></h3>
                    <p class="text-muted text-center"></p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Username</b> <a class="pull-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Tgl. Masuk</b> <a class="pull-right"></a>
                        </li>

                        <li class="list-group-item">
                            <b>Status User</b> <a class="pull-right badge bg-orange"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b> <a class="pull-right badge bg-aqua"></a>
                        </li>
                    </ul>
                    <!-- access admin -->
                    <?php 
					    // if (hakakses($nik,$module,'edit')) {
						// echo "<a href='?module=karyawan&act=editKaryawan&ID_KARYAWAN=$r[ID_KARYAWAN]' class='btn btn-primary btn-block $ClassHidden2'><b>Edit Your Profile</b></a>"; 
						// }
						
						// if ($_SESSION['leveluser']=='admin'){
						// echo "<a href='$aksi?module=karyawan&act=approved&ID_KARYAWAN=$r[ID_KARYAWAN]' class='btn btn-success btn-block $ClassHidden' title='Klik untuk Approve Karyawan' data-tt='tooltip' data-placement='top' ><b>Approve</b></a>"; }
						// else {
							
						// }
						// echo "<a href='Resign' class='btn btn-danger btn-block ' title='Klik untuk Karyawan Resign' data-tt='tooltip' data-placement='top'><b>Resign</b></a>";
						?>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#Profile" data-toggle="tab"><i class="fa fa-fw fa-user"></i>Profile</a>
                    </li>
                    <li><a href="#Apartement" data-toggle="tab"><i class="fa fa-fw fa-book"></i>Details</a></li>
                    <!-- <li><a href="#Jabatan" data-toggle="tab"><i class="fa fa-fw fa-user-md"></i>Jabatan</a></li> 
						<li><a href="#Kontrak" data-toggle="tab"><i class="fa fa-fw fa-reorder"></i>Kontrak</a></li>
						<li><a href="#Training" data-toggle="tab"><i class="fa fa-fw fa-sticky-note-o"></i>Training</a></li>
						<li><a href="#Cuti" data-toggle="tab"><i class="fa fa-fw fa-coffee"></i>History Cuti</a></li>
						<li><a href="#Fasilitas" data-toggle="tab"><i class="fa fa-fw fa-automobile"></i> Fasilitas</a></li> -->
                    <!-- <li><a href="#All" data-toggle="tab"><i class="fa fa-fw fa-line-chart"></i>All</a></li> -->
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="Profile">
                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <form action="<?php echo"$aksi?module=user&act=input";?>" enctype="multipart/form-data"
                                method="POST" class=""
                                onSubmit="if(!confirm('Apa yakin ingin simpan data ini')){return false;}">


                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Username</td>
                                            <td><span class="nama_text"> <input type="text" class="form-control"
                                                        name="userid" id="userid" required="required">
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <td>Password</td>
                                            <td><span class="nama_text">
                                                    <input type="text" class="form-control" name="password"
                                                        id="password" required="required">
                                                </span></td>
                                        </tr>


                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <td><span class="nama_text"><input type="text" class="form-control"
                                                        name="nama_lengkap" id="nama_lengkap" required="required">
                                                </span></td>
                                        </tr>

                                        <tr>
                                            <td>Nama Panggilan</td>
                                            <td><span class="nama_text"><input type="text" class="form-control"
                                                        name="nama_panggilan" id="nama_panggilan">
                                                </span></td>
                                        </tr>

                                        <tr>
                                            <td>No Telp</td>
                                            <td><span class="nama_text"><input type="text" class="form-control"
                                                        name="no_hp" id="no_hp" required="required">
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Lahir</td>
                                            <td><span class="nama_text"><input type="date" class="form-control"
                                                        name="tgl_lahir" id="tgl_lahir" required="required">
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <td>Tgl Join</td>
                                            <td><span class="nama_text"><input type="date" class="form-control"
                                                        name="tgl_join" id="tgl_join" required="required">
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><span class="nama_text"><input type="text" class="form-control"
                                                        name="email" id="email" required="required">
                                                </span></td>
                                        </tr>


                                        <tr>
                                            <td>kategori</td>
                                            <td><span class="nama_text">
                                                    <select name="kategori" class="form-control select2"
                                                        required="required" id='kategori'>

                                                        <option value="pemain">pemain</option>
                                                        <option value="pelatih">Pelatih</option>
                                                        <!-- <option value="users">Penghuni</option> -->
                                                        <!-- 
                                                     -->
                                                    </select>
                                                </span></td>
                                        </tr>

                                        <div class="wrap-custom-file">
                                            <input type="file" name="image1" id="image1" accept=".gif, .jpg, .png" required="required"  />
                                            <label for="image1">
                                            <span>Select Image One</span>
                                            <i class="fa fa-plus-circle"></i>
                                            </label>
                                        </div>

                                        <tr>
                                            <td></td>
                                            <td>
                                                <button type="reset" class="btn btn-danger  pull-right"
                                                    onclick=self.history.back() aria-hidden="true">Batal</button>
                                                <a type="button" id="simpanuser" class="btn btn-info pull-right"><i
                                                        class="fa fa-fw fa-save"></i> Simpan</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>



                    </div>
                    <div class="tab-pane" id="Apartement">
                        <div class="box box-primary">
                            <div class="box-header with-border">

                            </div>
                            <div class="box-body">
                                Data Belum Tersimpan/ (simpan data dahulu untuk bisa tambah Profile)
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</section>

<script type="text/javascript">
$(document).ready(function() {

    $("#simpanuser").click(function() {
        var userid = $("#userid").val();
        var password = $("#password").val();
        var nama_lengkap = $("#nama_lengkap").val();
        var nama_panggilan = $("#nama_panggilan").val();
        var tgl_join = $("#tgl_join").val();
        var tgl_lahir = $("#tgl_lahir").val();

        var no_hp = $("#no_hp").val();
        var email = $("#email").val();
        var kategori = $("#kategori").val();
        var image1 = $("#image1").val();

        if (userid == '' || password == '' || nama_lengkap == '' || no_hp == '' || email == '') {
            // if(userid=='' ) {
            alert("Masih Ada Field yang kosong");
            document.getElementById("nama_lengkap").focus();
        } else {

            $.ajax({
                type: 'POST',
                url: "modul/mod_user/aksi_user.php?module=user&act=cek_user",
                data: {
                    userid: userid,
                    no_hp: no_hp,
                    email: email
                },

            }).done(function(data) {
                a = data.length;
                // a = data;
                console.log(a);
                // if (a < 6) {
                    $.ajax({
                        type: 'POST',
                        url: "modul/mod_user/aksi_user.php?module=user&act=input",
                        data: {
                            userid: userid,
                            password: password,
                            nama_lengkap: nama_lengkap,
                            nama_panggilan: nama_panggilan,
                            no_hp: no_hp,
                            email: email,
                            kategori: kategori,
                            tgl_join: tgl_join,
                            image1: image1,
                            tgl_lahir: tgl_lahir
                        },
                        success: function(response) {
                            console.log(response);
                            // conlose.log(response);
                            // a = data.length;
                            b = response.length;

                            if (b < 14) {
                               
                                alert("Data Berhasil Disimpan");
                                window.location.href =
                                    'media.php?module=user&act=view&userid=' +
                                    userid;
                                // window.location.href='../../media.php?module=user&act=view&userid='+userid;
                            } else {
                                $.bootstrapGrowl('gagal ditambahkan.', {
                                    type: 'danger',
                                    delay: 2000,
                                    offset: {
                                        from: 'top',
                                        amount: 50
                                    },
                                    align: 'right', // ('left', 'right', or 'center')
                                    width: 250,
                                    allow_dismiss: true,
                                    ele: 'body',
                                    // stackup_spacing: 10,
                                });
                            }
                        },
                        error: function() {
                            alert("Data Error");
                            return true;
                        }
                    });
                // } else if (a < 9) {
                //     alert("Username Sudah Terdaftar");
                //     document.getElementById("userid").focus();
                //     console.log(a);
                // } else if (a < 11) {
                //     alert("No Hp Sudah Terdaftar");
                //     document.getElementById("no_hp").focus();
                // } else {
                //     alert("Email Sudah Terdaftar");
                //     document.getElementById("email").focus();
                // }
            }); // AJAX PERTAMA
        } //if validasi     
    });

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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous">
</script>
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
<script type="text/javascript" src="bootstrap/js/bootstrap-filestyle.min.js"> </script>