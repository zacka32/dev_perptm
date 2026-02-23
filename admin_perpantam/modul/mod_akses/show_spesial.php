                <?php 
                    include "../../config/koneksi.php";
                    include "../../config/fungsi_hakakses.php";
                    include "../../config/fungsi_log.php";         
				?>
				
                <table id="mutasi2" class="display table table-bordered table-striped" width="100%">
					<thead>
						<tr style="background-color: rgba(230, 203, 69, 0.5);">
					
							<th>ID</th>
							<th>Action</th>
							<th>Keterangan</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php 
                        
                        $id  = $_POST['dep'];
						
				
						$no = 1; 
                       
                        $tampil = mysql_query("select * from sit.detail_akses d left join sit.spesial_akses s on d.action=s.action where id_akses='$id'");

						while($r=mysql_fetch_array($tampil)){
						echo "<tr class=gradeX> 
									
								<td><center>$r[id_detail_akses]</center></td>
								<td>$r[action]</td>
								<td>$r[keterangan]</td>";
								?>
							<td><a href="#" onclick="confirm_modal('modul/mod_akses/aksi_akses.php?module=akses&act=spesialDelete&id=<?php echo  $r['id_detail_akses']; ?>');" class="btn bg-red smallbtn"><i class="fa fa-fw fa-close"></i></a></td>	
							<?php 
							echo "</tr> ";
						
							$no++; } ?>
											
						</tbody>
						
						</table>
						
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
                
<script>
function getAll(data) {
  checkboxes = document.getElementsByName('getAll');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = data.checked;
  }
}
</script>
<script>
	  
 $(document).ready(function() {
    $('#mutasi2').DataTable( {
        "scrollY":        "200px",
        "scrollCollapse": true,
        "paging":         false,
		
		
    } );

} );

</script>  

 <script type="text/javascript">
    function confirm_modal(delete_url)
    {
      $('#modalDelete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
 </script>

