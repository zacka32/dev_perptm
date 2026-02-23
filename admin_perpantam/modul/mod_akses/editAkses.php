<?php include "../../config/koneksi.php"; ?>
	
		<?php
			$edit = $db->prepare("SELECT a.*,m.NAMA_MODUL, ms.nama_lengkap from akses a left join modul m on m.NAMA_MODUL=a.modul 
								left join users ms on a.userid=ms.userid
								WHERE id =$_POST[rowid]");			
			$edit->execute();
			$r    = $edit->fetch(); ?>

		<form method="post" class="formPendidikan">
		<!-- <form method="post" action="modul/mod_karyawan/simpanEditPendidikan.php" class="formPendidikan"> -->
			<input type="hidden" class="form-control" name="id" value="<?php echo "$r[id]";?>" >
			
		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Edit Akses</h4>
		</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12">
									
									<div class="form-group">
										<label>Userid :</label>
										<?php echo "$r[userid] - $r[nama_lengkap]";?>												
									</div>

									
									
									<div class="form-group">
										<label>Module :</label>
										
											<?php echo "$r[NAMA_MODUL]";?>
										
									</div> 
								</div>
								<div class="modal-body form-horizontal">
								<div class="col-md-6">
								
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Lihat</label>
										<div class="col-sm-8">
										<?php  if ($r['lihat']=='Y') { ?>
											<div class="radio">
												<label>
													<input type="radio" name="lihat" id="optionsRadios1" value="Y" checked >
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="lihat" id="optionsRadios1" value="N">
													N
												</label>
											 </div>
										<?php   } else { ?>
											<div class="radio">
												<label>
													<input type="radio" name="lihat" id="optionsRadios1" value="Y"  >
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="lihat" id="optionsRadios1" value="N" checked>
													N
												</label>
											 </div>
										 <?php   } ?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Buat</label>
										<div class="col-sm-8">
										<?php  if ($r['buat']=='Y') { ?>
											<div class="radio">
												<label>
													<input type="radio" name="buat" id="optionsRadios1" value="Y" checked >
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="buat" id="optionsRadios1" value="N">
													N
												</label>
											 </div>
										<?php   } else { ?>
											<div class="radio">
												<label>
													<input type="radio" name="buat" id="optionsRadios1" value="Y"  >
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="buat" id="optionsRadios1" value="N" checked>
													N
												</label>
											 </div>
										 <?php   } ?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Edit</label>
										<div class="col-sm-8">
										<?php  if ($r['edit']=='Y') { ?>
											<div class="radio">
												<label>
													<input type="radio" name="edit" id="optionsRadios1" value="Y" checked >
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="edit" id="optionsRadios1" value="N">
													N
												</label>
											 </div>
										<?php   } else { ?>
											<div class="radio">
												<label>
													<input type="radio" name="edit" id="optionsRadios1" value="Y"  >
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="edit" id="optionsRadios1" value="N" checked>
													N
												</label>
											 </div>
										 <?php   } ?>
										</div>
									</div>
									
								

									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Hapus</label>
										<div class="col-sm-8">
										<?php  if ($r['hapus']=='Y') { ?>
											<div class="radio">
												<label>
													<input type="radio" name="hapus" id="optionsRadios1" value="Y" checked >
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="hapus" id="optionsRadios1" value="N">
													N
												</label>
											 </div>
										<?php   } else { ?>
											<div class="radio">
												<label>
													<input type="radio" name="hapus" id="optionsRadios1" value="Y"  >
													Y
												</label>
												&nbsp;&nbsp;&nbsp;
												<label>
													<input type="radio" name="hapus" id="optionsRadios1" value="N" checked>
													N
												</label>
											 </div>
										 <?php   } ?>
										</div>
									</div>
									
									
									


								</div>
								</div> 
								
                            </div> 

						</div>

		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			<a type="submit" class="simpanPend btn btn-primary">Save</a>
		</div>
	</form>

<script type="text/javascript">
		$(document).ready(function(){
			$(".simpanPend").click(function(){
				var data = $('.formPendidikan').serialize();
				$.ajax({
					type: 'POST',
					url: "modul/mod_akses/simpanEditAkses.php",
					data: data
					,
					success: function() {
							// location.reload(true);
							 setTimeout(function () {  
						swal('Succes!', '( ) Berhasil Di Ubah', 'success')
						},10); 
						window.setTimeout(function(){ 
						window.location.replace('media.php?module=akses');
						} ,1500); 	
							
					}
				});
			});
		});
	</script>

