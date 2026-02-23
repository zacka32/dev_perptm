<?php
session_start();
require '../../config/koneksi.php';
require '../../config/fungsi_encryptdecrypt.php';
require '../../config/fungsi_hakakses.php';
$userid=$_SESSION['userid'];
$act= $_GET['act'];
if($act=='list_index') {
$table = <<<EOT
 ( SELECT a.*, b.nama_tampil FROM banner a LEFT JOIN master_posisi_banner b ON a.posisi=b.nama 
  ) viewData
EOT;
$primaryKey = 'id_banner';
$columns = array(
	array( 'db' => 'id_banner', 'dt' => 0 ),
	array( 'db' => 'nama_tampil', 'dt' => 1 ),
	array( 'db' => 'teks1', 'dt' => 2 ),
	array( 'db' => 'teks2', 'dt' => 3 ),
	array( 'db' => 'teks3', 'dt' => 4 ),
	
	array( 'db' => 'gambar', 'dt' => 5 ),
	array( 
            'db' => 'created_user', 
            'dt' => 6,
            'formatter' => function( $d, $row ) {
            				$id = encrypt_decrypt('encrypt',$row[0]);
            				$buttons='
						';
								if (hakakses($_SESSION['userid'],'banner','edit')):
		                            $buttons.='
		                            <a href="?module=banner&act=editbanner&id='.$id.'" class="btn-sm btn-primary" style="width: 20px;" title="Klik untuk Edit" data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-edit"></i></a>';
	                        	endif;
	                        	// if (hakakses($_SESSION['userid'],'user','hapus')):
		                        //    	$buttons .='
								// 		<a type="button" onClick="hapususer(\''.$row[0].'\');" class="btn-sm btn-danger" title="Klik untuk hapus" data-tt="tooltip" data-placement="top"><i class="fa fa-trash-o"></i></a>
								// 		<input type="hidden" name="no_user" value="'.$no_user.'">
								// 		';
	                        	// endif;
                            
                return $buttons;
            }
       ), 
	array( 'db' => 'l_status', 'dt' => 7 )
	
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
