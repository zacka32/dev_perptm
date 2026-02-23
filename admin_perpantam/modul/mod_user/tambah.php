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
					
									echo" <img class='profile-user-img img-responsive img-circle bg-green' src='dist/img/user8-128x128.jpg' alt='User profile picture' width=128>";
						
	
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
                    
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#Profile" data-toggle="tab"><i class="fa fa-fw fa-user"></i>Profile</a>
                    </li>
                    <!-- <li><a href="#Apartement" data-toggle="tab"><i class="fa fa-fw fa-book"></i>Details</a></li> -->
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
                            <form action="#" id="uploadForm" enctype="multipart/form-data" method="POST" class="">


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
                                            <td>Email</td>
                                            <td><span class="nama_text"><input type="text" class="form-control"
                                                        name="email" id="email" required="required">
                                                </span></td>
                                        </tr>

                                      
                                        <tr>
                                            <td></td>
                                            <td>
                                                <button type="reset" class="btn btn-danger  pull-right"
                                                    onclick=self.history.back() aria-hidden="true">Batal</button>
                                                <button type="submit" id="simpanuser" class="btn btn-info pull-right">
                                                    <i class="fa fa-fw fa-save"></i> Simpan
                                                </button>
                                                <!-- <a type="submit" id="simpanuser" class="btn btn-info pull-right"><i
                                                        class="fa fa-fw fa-save"></i> Simpan</a> -->
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
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script type="text/javascript">
$(document).ready(function() {
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault(); // Stop form default

        // Konfirmasi dulu
        if (!confirm("Apa yakin ingin simpan data ini?")) {
            return false;
        }

        var formData = new FormData(this);

        var userid = $("#userid").val().trim();
        var password = $("#password").val().trim();
        var nama_lengkap = $("#nama_lengkap").val().trim();
        var no_hp = $("#no_hp").val().trim();
        var email = $("#email").val().trim();
        var tgl_lahir = $("#tgl_lahir").val();

        // Validasi
        if (userid === '' || password === '' || nama_lengkap === '' || no_hp === '' || email === '' || tgl_lahir === '') {
            alert("Masih ada field yang kosong!");
            return false;
        }

        // AJAX 1: cek username
        $.ajax({
            type: 'POST',
            url: "modul/mod_user/aksi_user.php?module=user&act=cek_user",
            data: { userid: userid },
            dataType: 'json',
            success: function(response) {

                if (response.status === "exists") {
                    alert(response.field + " sudah digunakan! Gunakan yang lain.");
                    return;
                }

                // AJAX 2: SIMPAN
                $.ajax({
                    type: 'POST',
                    url: "modul/mod_user/aksi_user.php?module=user&act=input",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        alert("Data berhasil disimpan!");
                        window.location.href = 'media.php?module=user&act=view&userid=' + userid;
                    },
                    error: function(xhr, status, err) {
                        console.error("Error save:", err);
                        alert("Gagal menyimpan data.");
                    }
                });

            },
            error: function(xhr, status, err) {
                console.error("Error cek_user:", err);
                alert("Gagal mengecek username.");
            }
        });

    });
});
</script>
