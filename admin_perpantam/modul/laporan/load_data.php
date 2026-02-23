<?php
session_start();
require '../../config/koneksi.php';
require '../../config/fungsi_encryptdecrypt.php';
require '../../config/fungsi_hakakses.php';
$userid=$_SESSION['userid'];
$act= $_GET['act'];
if($act=='list_index') {
$table = <<<EOT
 ( SELECT * FROM banner 
  ) viewData
EOT;
$primaryKey = 'id_banner';
$columns = array(
	array( 'db' => 'id_banner', 'dt' => 0 ),
	array( 'db' => 'nama_banner', 'dt' => 1 ),
	array( 'db' => 'title', 'dt' => 2 ),
	array( 'db' => 'deskripsi', 'dt' => 3 ),
	
	array( 'db' => 'gambar', 'dt' => 4 ),
	array( 
            'db' => 'created_user', 
            'dt' => 5,
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
);
//if jika beda
} else if($act=='temp') {

} else if($act=='approvalpo') {
$table = <<<EOT
 ( SELECT a.*, b.note FROM user_header a LEFT JOIN suppslier b ON a.supplier_id=b.supplier_id WHERE a.l_status='A' ) viewData
EOT;
$primaryKey = 'user_id';
$columns = array(
	array( 'db' => 'user_id', 'dt' => 0 ),
	array( 'db' => 'tgl_permintaan_datang', 'dt' => 1 ),
	array( 'db' => 'jenis',  'dt' => 2 ),
	array( 'db' => 'l_status',  'dt' => 3 ),
	array( 'db' => 'note',  'dt' => 4 ),
	array( 
            'db' => 'entry_user', 
            'dt' => 5,
            'formatter' => function( $d, $row ) {
            				$no_user = encrypt_decrypt('encrypt',$row[0]);
            				$aksi="modul/po/aksi_po.php";
            				$buttons='
							<a href="#" data-target="#view-modal5" data-toggle="modal" data-id='.$no_user.' id="getUser5" data-whatever="@mdo" class="btn-sm btn-info" style="width: 20px;" title="Klik untuk liat detail" data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-search-plus"></i></a>';
							//IF (status bukan A)
							
	                        if($row[3]=='A'): 
								if (hakakses($_SESSION['userid'],'po','konfirmasi')):
		                    $buttons.='
	                        	<a href="'.$aksi.'?module=user&act=approvalpo&id='.$no_user.'" class="btn-sm btn-success" style="width: 20px;" title="Klik untuk Approval po" data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-check"></i></a>';
	                        	endif;
	                        endif;	
						                    
                return $buttons;
            }
        ), 
);
//if jika beda
} else if($act=='printpo') {

} else if($act=='cetakulang') {

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
