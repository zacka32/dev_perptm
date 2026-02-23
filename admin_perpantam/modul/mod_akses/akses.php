 <?php
  $module=$_GET['module'];
 $folder="modul/mod_akses";
$aksi="modul/mod_akses/aksi_akses.php";
switch($_GET[act]){
  default:
 if (hakakses($userid,$module,'lihat','')) {

  ?>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
			<div class="box">
				<div class="box-header">
				  <div class="col-xl-6 pull-left"><h3 class="box-title">Daftar Akses Custom</h3>	
					</div>
				  <div class="col-xl-3 pull-right">
					  <a href="#ModalPen" class="btn btn-block btn-success pull-right"  data-toggle="modal"><b><i class="fa fa-fw fa-user-plus"></i>Add</b></b></a>
				  </div>
				  <div class="col-xl-3 pull-right"style="margin-right: 3px;">
				  </div>

				</div>

				
				<!-- Custom Tabs -->
				<div class="box-body">
					<!-- <table id="example" class="" cellspacing="0" width="100%"> -->
				  <table id="hrd1" class="display table" width="100%">
					<thead>
						
						<tr class="color_header">
					
							
							<th>ID</th>
							<th>userid</th>
							<th>Nama</th>
							<th>Modul</th>
							<th>Lihat</th>
							<th>Buat</th>
							<th>Edit</th>
							<!-- <th>Excel</th>
							<th>detail</th>
							<th>konfm</th>
							<th>tutup</th>
							<th>print</th>
							<th>Notif</th> -->
							<th>Hapus</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$no = 1; 
							$tampil = $db->prepare("SELECT a.*, mo.NAMA_MODUL AS nama_modul ,mo.NOTES AS notesmo,
							u.nama_lengkap from akses a 
							LEFT JOIN users u ON u.userid=a.userid LEFT JOIN modul mo on a.modul=mo.`NAMA_MODUL` 
							");
							$tampil->execute();
						while($r=$tampil->fetch()){
							
							if($r['notesmo']=='') {
								$notesmo="Notes belum diisi"; 
							}else {
								$notesmo=$r['notesmo']; 
							}

					   echo " <tr class='gradeX'>
		
						<td><center>$r[id]</center></td>
						<td>$r[userid]</td>
						<td>$r[nama_lengkap]</td>
					
						<td><span title='$notesmo' data-tt='tooltip' data-placement='top' >$r[modul]</span></td>
						<td><center>$r[lihat]</center></td>
						<td><center>$r[buat]</center></td>
						<td><center>$r[edit]</center></td>
					
						<td><center>$r[hapus]</center></td>
					
						
						<td>";
						if (hakakses($userid,$module,'edit','')) {
							echo"<a href='#modalEditPen' data-id='$r[id]' class='btn bg-blue smallbtn' data-toggle='modal' id=''><i class='fa fa-fw fa-edit'></i></a>
						"; }
							if (hakakses($userid,$module,'hapus','')) { ?>	
						<a href="#" onclick="confirm_modal('<?php echo"$aksi";?>?module=akses&act=delete&id=<?php echo  $r['id']; ?>');" class="btn bg-red smallbtn"><i class="fa fa-fw fa-close"></i></a>
							<?php }
						echo "</td>

						</tr>";
					  
						$no++; } ?>
										
					</tbody>
					
					</table>
					
					<div id="showtable"></div>
					
				</div>
				<!-- col -->

				
			</div>
			</div>
			
		</div>
		
	</section>
		<div id="modalAddSpesial" class="modal fade" tabindex="-1"  data-focus-on="input:first">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="tambahSpesial"></div>
				</div>
			</div>
		</div>
	
	
		<div id="ModalPen" class="modal fade small"   data-focus-on="input:first" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
				
				  <?php echo"<form action='$aksi?module=akses&act=input' enctype='multipart/form-data' method='POST'> ";?>
                      <!-- <input type="hidden" class="form-control" name="C_NIP" value="<?php echo "$C_akses";?>" > -->
                      
					<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myModalLabel">Tambah Aksess</h4>
					</div>

						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12">
									
									<div class="form-group">
										<label>NIP <span class="red">*</span></label>
									
										<select name="userid" id="userid" class="operation select2" style="width: 100%;" required>
										
											<?php  
											$show=$db->prepare("SELECT * FROM users WHERE blokir='N'");	
											$show->execute();
											
												echo '<option value="">Pilih NIK</option>';
												while($row = $show->fetch()){
													$userid = $row['userid'];
													$nama_lengkap = $row['nama_lengkap'];
													echo '<option value='.$userid.'>'.$userid.' - '.$nama_lengkap.'</option>';
												}
												?>
										</select>												
									</div>

									<div class="form-group">
										<label>Module <span class="red">*</span></label>
											<select required name="modul" id="modul" class="operation select2" style="width:100%">
											<?php  
											$show=$db->prepare("SELECT * FROM modul");	
											$show->execute();
											
												echo '<option value="">Pilih Modul</option>';
												while($row = $show->fetch()){
													$ID_MODUL = $row['ID_MODUL'];
													$MODUL = $row['NAMA_MODUL'];
													$NOTES = $row['NOTES'];
													echo '<option value='.$MODUL.'>'.$MODUL.' - ('.$NOTES.')</option>';;
												}
												?>
												</select>
									</div> 
									<!-- cek modul yang sudah di dapat -->
									
									<script type="text/javascript">
									$(document).ready(function() {
																					
										$('select.operation').on('change', function() {	
											var m = document.getElementById("modul");
											var modul = m.options[m.selectedIndex].value;
											
											var e = document.getElementById("userid");
											var userid = e.options[e.selectedIndex].value;
											console.log(userid, modul);
											$.ajax({
											type: 'POST',
											url: "modul/mod_akses/hasilCek.php",
											data: {userid:userid, modul:modul},
											success: function(info) {
													$("#showtable1").html(info);   }
											});
											return false;
										});
									});
									</script>
									
								</div>
								<div class="modal-body form-horizontal">
								<div class="col-md-6">
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Lihat</label>
										<div class="col-sm-8">
											<div class="radio">
												<label>
													<input type="radio" name="lihat" id="optionsRadios1" value="Y" >
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="lihat" id="optionsRadios1" value="N" checked="">
													N
												</label>
											 </div>
										</div>
									</div>

									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Buat</label>
										<div class="col-sm-8">
											<div class="radio">
												<label>
													<input type="radio" name="buat" id="optionsRadios1" value="Y" >
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="buat" id="optionsRadios1" value="N" checked="">
													N
												</label>
											 </div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Edit</label>
										<div class="col-sm-8">
											<div class="radio">
												<label>
													<input type="radio" name="edit" id="optionsRadios1" value="Y" >
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="edit" id="optionsRadios1" value="N" checked="">
													N
												</label>
											 </div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Excel</label>
										<div class="col-sm-8">
											<div class="radio">
												<label>
													<input type="radio" name="excel" id="optionsRadios1" value="Y">
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="excel" id="optionsRadios1" value="N" checked="">
													N
												</label>
											 </div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Detail</label>
										<div class="col-sm-8">
											<div class="radio">
												<label>
													<input type="radio" name="detail" id="optionsRadios1" value="Y">
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="detail" id="optionsRadios1" value="N" checked="">
													N
												</label>
											 </div>
										</div>
									</div>
									
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Konfirmasi</label>
										<div class="col-sm-8">
											<div class="radio">
												<label>
													<input type="radio" name="konfirmasi" id="optionsRadios1" value="Y">
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="konfirmasi" id="optionsRadios1" value="N" checked="">
													N
												</label>
											 </div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Tutup</label>
										<div class="col-sm-8">
											<div class="radio">
												<label>
													<input type="radio" name="tutup" id="optionsRadios1" value="Y">
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="tutup" id="optionsRadios1" value="N" checked="">
													N
												</label>
											 </div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Print</label>
										<div class="col-sm-8">
											<div class="radio">
												<label>
													<input type="radio" name="print" id="optionsRadios1" value="Y">
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="print" id="optionsRadios1" value="N" checked="">
													N
												</label>
											 </div>
										</div>
									</div>
									
									
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Notification</label>
										<div class="col-sm-8">
											<div class="radio">
												<label>
													<input type="radio" name="notification" id="optionsRadios1" value="Y">
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="notification" id="optionsRadios1" value="N" checked="">
													N
												</label>
											 </div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Hapus</label>
										<div class="col-sm-8">
											<div class="radio">
												<label>
													<input type="radio" name="hapus" id="optionsRadios1" value="Y">
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="hapus" id="optionsRadios1" value="N" checked="">
													N
												</label>
											 </div>
										</div>
									</div>

								</div> 
								</div> 
								
                            </div> 

						</div>

					<div class="modal-footer">
						
						<div id="showtable1"></div>
						
					</div>
				  </form>
				</div>
			</div>
		</div>

		<div id="modalEditPen" class="modal fade" tabindex="-1"  data-focus-on="input:first">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="editPendidikan"></div>
				</div>
			</div>
		</div>

			<!-- Modal Popup untuk delete --> 
		<div class="modal fade small" id="modalDelete">
		<div class="modal-dialog">
			<div class="modal-content" style="margin-top:100px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style="text-align:center;">Yakin anda ingin hapus data ini ? ?</h4>
			</div>
						
			<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
				<a href="#" class="btn btn-danger" id="delete_link">Hapus</a>
				<button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
			</div>
			</div>
		</div>
		</div>



<?php
 }else{
    echo "<script>alert('Anda Tidak Memiliki Akses !');
             window.location.href='?module=home'</script>";
  }
  	 break;  

}
?>

<script>
	  
 $(document).ready(function() {
    $('#hrd1').DataTable( {
        // "scrollY":        "300px",
        "scrollCollapse": true,
        "paging":         false,
        "scrollX": true,
		
		
    } );

//cek row table agak tampil checkbox
	// $('#hrd1 tr').click(function() {
	// 	$(this).find('td input:radio').prop('checked', true);
	// 	get_id();
	// });

		

} );



</script>  

<script>
$(document).ready(function() {
    var table = $('#hrd1').DataTable();
 
    $('#hrd1 tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
	
	 
    // $('#button').click( function () {
    //     table.row('.selected').remove().draw( false );
    // } );
} );

</script> 
<script type="text/javascript">
    $(document).ready(function(){
        $('#modalEditPen').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '<?php echo"$folder"; ?>/editAkses.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.editPendidikan').html(data);//menampilkan data ke dalam modal
                }
            });
         });
		 
		 
		
    });
  </script>
  
  <script type="text/javascript">
			$(document).ready(function(){
				$('#modalAddSpesial').on('show.bs.modal', function (e) {
					var rowid = $(e.relatedTarget).data('id');
					//menggunakan fungsi ajax untuk pengambilan data
					$.ajax({
						type : 'post',
						url : '<?php echo"$folder"; ?>/addSpesial.php',
						data :  'rowid='+ rowid,
						success : function(data){
							$('.tambahSpesial').html(data);//menampilkan data ke dalam modal
						}
					});
				 });
		
			});
		</script>

 <script type="text/javascript">
    function confirm_modal(delete_url)
    {
      $('#modalDelete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
 </script>
 
 <script>
	  
 $(document).ready(function() {
    $('#mutasi2').DataTable( {
        "scrollY":        "300px",
        "scrollCollapse": true,
		"scrollX": true,
        "paging":         true,
		"order": [[ 0, 'desc' ]]
		
    } );

	$('.select2').select2()
	
	
	

} );

</script>
<script>

if($('input[name="dep"]').is(':checked')){
    $('input[name="dep"]:checked').trigger('click');
}

  function get_id(){
		// var a = $("[name=dep]:checked").val();
		
  		var a = $("input:radio[name=dep]:checked").val();
  // var a = this.value;
		$.ajax({
		type: 'POST',
		url: "modul/mod_akses/show_spesial.php",
		data: "dep="+a,
		success: function(info) {
			$("#showtable").html(info);   }
		});
  	return false;
  }
</script>
<script>
            $(document).ready(function() {
                  if (Notification.permission !== "granted")
                    Notification.requestPermission();
            });
             
            function notifikasi() {
                if (!Notification) {
                    alert('Browsermu tidak mendukung Web Notification.'); 
                    return;
                }
                if (Notification.permission !== "granted")
                    Notification.requestPermission();
                else {
                    var notifikasi = new Notification('Success', {
                        icon: '<?php echo "png/success.png"; ?>',
                        body: "Data berhasil di ubah",
                    });
                    // notifikasi.onclick = function () {
                        // window.open("http://goo.gl/dIf4s1");      
                    // };
                    setTimeout(function(){
                        notifikasi.close();
                    }, 5000);
                }
            };
			
			 function sukses() {
                if (!Notification) {
                    alert('Browsermu tidak mendukung Web Notification.'); 
                    return;
                }
                if (Notification.permission !== "granted")
                    Notification.requestPermission();
                else {
                    var notifikasi = new Notification('Success', {
                        icon: '<?php echo "png/success.png"; ?>',
                        body: "Data Spesifik Berhasil di tambah",
                    });
                    // notifikasi.onclick = function () {
                        // window.open("http://goo.gl/dIf4s1");      
                    // };
                    setTimeout(function(){
                        notifikasi.close();
                    }, 5000);
                }
            };
			
			function gagal() {
                if (!Notification) {
                    alert('Browsermu tidak mendukung Web Notification.'); 
                    return;
                }
                if (Notification.permission !== "granted")
                    Notification.requestPermission();
                else {
                    var notifikasi = new Notification('Success', {
                        icon: '<?php echo "png/success.png"; ?>',
                        body: "Failed , This Access already exists!",
                    });
                    // notifikasi.onclick = function () {
                        // window.open("http://goo.gl/dIf4s1");      
                    // };
                    setTimeout(function(){
                        notifikasi.close();
                    }, 5000);
                }
            };
			
        </script>
