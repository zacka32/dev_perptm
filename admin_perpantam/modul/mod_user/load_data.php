
<?php
session_start();
require '../../config/koneksi.php';
require '../../config/fungsi_encryptdecrypt.php';
require '../../config/fungsi_hakakses.php';
$userid=$_SESSION['userid'];
$act= $_GET['act'];
if($act=='listpo') {
$table = <<<EOT
 ( SELECT  FROM users WHERE 1=1
 		
  ) viewData
EOT;
$primaryKey = 'userid';
$columns = array(

	array( 'db' => 'userid', 'dt' => 0 ),
	array( 'db' => 'nama_lengkap', 'dt' => 1 ),
	array( 'db' => 'no_hp', 'dt' => 2 ),
	array( 'db' => 'email', 'dt' => 3 ),
	array( 'db' => 'kategori',  'dt' => 4 ),
	array( 
            'db' => 'entry_user', 
            'dt' => 5,
            'formatter' => function( $d, $row ) {
            				$no_user = encrypt_decrypt('encrypt',$row[0]);
            				$aksi="modul/mod_po/aksi_po.php";
            				$buttons='
						';
								if (hakakses($_SESSION['userid'],'user','edit')):
		                            // $buttons.='
		                            // <a href="?module=user&act=edituser&id='.$no_user.'" class="btn-sm btn-primary" style="width: 20px;" title="Klik untuk Edit" data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-edit"></i></a>';
									$buttons .='
									<a href="?module=user&act=view&userid='.$no_user.'" class="btn-sm btn-info" style="width: 20px;" title="Klik untuk liat " data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-search-plus"></i></a>';
						
								endif;

	                        	
                            
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

} else if($act=='approvalpo') {
$table = <<<EOT
 ( SELECT a.*, b.note FROM user_header a LEFT JOIN supplier b ON a.supplier_id=b.supplier_id WHERE a.l_status='A' ) viewData
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
            				$aksi="modul/mod_po/aksi_po.php";
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
$table = <<<EOT
 ( SELECT L.* , 
 	CASE WHEN L.C_JENIS='L' THEN 'Local' WHEN L.C_JENIS='i' THEN 'Import' END AS JENIS,  
 	CASE WHEN L.C_TYPE='K' THEN 'KEMAS' WHEN L.C_TYPE='B' THEN 'BAKU' END AS CTYPE,
 	CONCAT(S.C_SUPNUMB,' - ', S.C_SUPNAME) SUPNAME
   FROM potr01 L LEFT JOIN supplier S ON L.C_SUPNUMB=S.C_SUPNUMB WHERE L.C_STATUS='C' ) viewData
EOT;
$primaryKey = 'C_PONUMB';
$columns = array(
	array( 
            'db' => 'D_PRINT', 
            'dt' => 0,
            'formatter' => function( $d, $row ) {
            
	            $buttons='
                    <input type="checkbox" name="data[]" value="'.$row[1].'">';                                                          
                return $buttons;
            }
    ),
	array( 'db' => 'C_PONUMB', 'dt' => 1 ),
	array( 'db' => 'D_PODATE', 'dt' => 2 ),
	array( 'db' => 'CTYPE',  'dt' => 3 ),
	array( 'db' => 'C_STATUS',  'dt' => 4 ),
	array( 'db' => 'SUPNAME',  'dt' => 5 ),
	array( 'db' => 'JENIS',  'dt' => 6 ),
	array( 'db' => 'N_NETVA',  'dt' => 7 ),
	array( 'db' => 'C_KURS',  'dt' => 8 ),
	array( 'db' => 'N_PPN',  'dt' => 9 ),
	array( 'db' => 'N_DISCOUNT',  'dt' => 10 ),
	array( 'db' => 'C_REMARK',  'dt' => 11 ),
	array( 
            'db' => 'C_PRINT', 
            'dt' => 12,
            'formatter' => function( $d, $row ) {
            				$no_user = encrypt_decrypt('encrypt',$row[1]);
            				$aksi="modul/mod_po/aksi_po.php";
            				$buttons='
							<a href="#" data-target="#view-modal5" data-toggle="modal" data-id='.$no_user.' id="getUser5" data-whatever="@mdo" class="btn-sm btn-info" style="width: 20px;" title="Klik untuk liat detail" data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-search-plus"></i></a>'; 
							


			
						
                                                          
                return $buttons;
            }
       ), 

);

} else if($act=='cetakulang') {
$table = <<<EOT
 ( SELECT L.* , 
 	CASE WHEN L.C_JENIS='L' THEN 'Local' WHEN L.C_JENIS='i' THEN 'Import' END AS JENIS,  
 	CASE WHEN L.C_TYPE='K' THEN 'KEMAS' WHEN L.C_TYPE='B' THEN 'BAKU' END AS CTYPE,
 	CONCAT(S.C_SUPNUMB,' - ', S.C_SUPNAME) SUPNAME
   FROM potr01 L LEFT JOIN supplier S ON L.C_SUPNUMB=S.C_SUPNUMB WHERE L.C_STATUS='P' ) viewData
EOT;
$primaryKey = 'C_PONUMB';
$columns = array(

	array( 'db' => 'C_PONUMB', 'dt' => 0 ),
	array( 'db' => 'D_PODATE', 'dt' => 1 ),
	array( 'db' => 'CTYPE',  'dt' => 2 ),
	array( 'db' => 'C_STATUS',  'dt' => 3 ),
	array( 'db' => 'SUPNAME',  'dt' => 4 ),
	array( 'db' => 'JENIS',  'dt' => 5 ),
	array( 'db' => 'N_NETVA',  'dt' => 6 ),
	array( 'db' => 'C_KURS',  'dt' => 7 ),
	array( 'db' => 'N_PPN',  'dt' => 8 ),
	array( 'db' => 'N_DISCOUNT',  'dt' => 9 ),
	array( 'db' => 'C_REMARK',  'dt' => 10 ),
	array( 
            'db' => 'C_PRINT', 
            'dt' => 11,
            'formatter' => function( $d, $row ) {
            				$no_user = encrypt_decrypt('encrypt',$row[0]);
            				$aksi="modul/mod_po/aksi_po.php";
            				$buttons='
							<a href="#" data-target="#view-modal5" data-toggle="modal" data-id='.$no_user.' id="getUser5" data-whatever="@mdo" class="btn-sm btn-info" style="width: 20px;" title="Klik untuk liat detail" data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-search-plus"></i></a>'; 
							// if (hakakses($_SESSION['userid'],'po','print')):
									$buttons .='
	                  				 <a href=?module=user&act=printulang&id='.$no_user.'" class="btn-sm btn-primary" style="width: 20px;" title="Klik untuk print Ulang" data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-print"></i></a>';
							
                        	// endif;


			
						
                                                          
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


