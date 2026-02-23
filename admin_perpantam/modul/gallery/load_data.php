<?php
session_start();
require '../../config/koneksi.php';
require '../../config/fungsi_encryptdecrypt.php';
require '../../config/fungsi_hakakses.php';
$userid=$_SESSION['userid'];
$act= $_GET['act'];
if($act=='list_index') {
$table = <<<EOT
 ( SELECT * FROM gallery 
  ) viewData
EOT;
$primaryKey = 'id_auto';
$columns = array(
	array( 'db' => 'id_auto', 'dt' => 0 ),
	
	array( 
			'db' => 'gambar', 
			'dt' => 1,
			'formatter' => function( $d, $row ) {

				$img = htmlspecialchars($row[1]);

				$buttons = '
				<a href="javascript:void(0)" 
					class="img-preview" 
					data-img="../assets/upload/'.$img.'"
					title="Klik untuk memperbesar">
					<img src="../assets/upload/'.$img.'" width="100" style="cursor:pointer">
				</a>';

				return $buttons;
			}
			),

	array( 
            'db' => 'created_user', 
            'dt' => 2,
            'formatter' => function( $d, $row ) {
            				$id = encrypt_decrypt('encrypt',$row[0]);
            				$buttons='
						';
								
		                           
	                        	
		                           	$buttons .='
										<a type="button" onClick="hapusdata(\''.$row[0].'\');" class="btn-sm btn-danger" title="Klik untuk hapus" data-tt="tooltip" data-placement="top"><i class="fa fa-trash-o"></i></a>
										<input type="hidden" name="no_user" value="'.$id.'">
										';
	                        	
                            
                return $buttons;
            }
       ), 
);
//if jika beda
} else if($act=='temp') {
$table = <<<EOT
 ( SELECT a.*,b.bahan_name FROM user_temp a left join bahanbk b on a.bahan_id=b.bahan_id
) viewData
EOT;
$primaryKey = 'id_auto';
$columns = array(
	array( 'db' => 'bahan_id',  'dt' => 0 ),
	array( 'db' => 'bahan_name',  'dt' => 1 ),
	array( 'db' => 'qty',  'dt' => 2 ),
		array( 
            'db' => 'id_auto', 
            'dt' => 3,
            'formatter' => function( $d, $row ) {
            				$id_auto = $row[3];
							$buttons='
							<button type="button" onClick="hapusdata(\''.$id_auto.'\');" class="btn-xs btn-danger" title="Klik untuk hapus" data-tt="tooltip" data-placement="top"><i class="fa fa-trash-o"></i></button>
							<input type="hidden" name="id_auto" value="'.$id_auto.'">
							';
                                
                return $buttons;
            }
       ), 	
);

//if jika beda
}  //if terakhir
// SQL server connection information
$sql_details = array(
	'user' => $dbuser,
	'pass' => $dbpass,
	'db'   => $dbname,
	'host' => $dbhost
);
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
require( '../../config/ssp.class.php' );
// require '../../config/ssp.class.php';
echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
?>
