<?php include "../../config/koneksi.php";
	  include "../../config/fungsi_get_master.php";
 ?>
	
		<?php
			$edit = mysql_query("SELECT a.*,m.C_NAMA from sit.akses a left join group.mskry m on a.userid=m.C_NIP
								WHERE `a`.`id` = $_POST[rowid]");			
			$r    = mysql_fetch_array($edit); ?>

		<form method="post" class="formPendidikan">
		<!-- <form method="post" action="modul/mod_karyawan/simpanEditPendidikan.php" class="formPendidikan"> -->
			<input type="hidden" class="form-control" name="id" value="<?php echo "$r[id]";?>" >
		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Modul Spesifik</h4>
		</div>
		
			<div class="modal-body form-horizontal">
				<div class="row">
					<div class="col-md-12">
						
						<div class="form-group">
						  <label for="inputPassword3" class="col-sm-2 control-label">userid-Nama</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" name="action" value="<?php echo"$r[userid] - $r[C_NAMA]";?>" disabled>		
								<input type="hidden" class="form-control" name="action" value="<?php echo"$r[id]";?>">									  
							</div>
						</div> 
						<div class="form-group">
						  <label for="inputPassword3" class="col-sm-2 control-label">Modul</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" name="action" value="<?php echo"$r[modul]";?>" disabled>		
											  
							</div>
						</div> 
						
						<div class="form-group">
						  <label for="inputPassword3" class="col-sm-2 control-label">Action</label>
							<div class="col-sm-8">
								<select name="action" class="operation form-control" style="width: 100%;" required>
									<?php  echo get_master_spesialAkses(); ?>
								</select>	
											  
							</div>
						</div> 
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Keterangan</label>
							<div class="col-sm-8">
								<textarea class="operations-supplierCapacity form-control" readonly></textarea>
											
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
					url: "modul/mod_akses/simpanAddSpesial.php",
					data: data
					,
					success: function(data) {
						 
							sukses();
							get_id();
							 $('#modalAddSpesial').modal('toggle'); //or  $('#IDModal').modal('hide');
							return false;
								
														
					}
				});
			});
			
		    $('select.operation').change(function() {
				var capacityValue = $('select.operation').find(':selected').data('capacity');
				$('.operations-supplierCapacity').val(capacityValue);
		    });
		});
	</script>

