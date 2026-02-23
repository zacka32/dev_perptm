
<?php
session_start();
require '../../config/koneksi.php';
require '../../config/fungsi_encryptdecrypt.php';
require '../../config/fungsi_hakakses.php';
$userid=$_SESSION['userid'];
$id_merchant=$_SESSION['id_merchant'];
$act= $_GET['act'];
if($act=='listhistory') {

$table = <<<EOT
		( SELECT no_resi,nama_penerima, FORMAT(total_produk,0) total_produk,l_status, FORMAT(dibayarkan,0)dibayarkan
		,FORMAT((total_produk-dibayarkan),0) pending FROM transaksi WHERE kode_layanan='COD' AND DATE_FORMAT(tanggal_kirim_kurir, '%Y-%m-%d')=CURRENT_DATE() AND pengirim='$id_merchant'
) viewData
EOT;
$primaryKey = 'no_resi';
$columns = array(
	   
		   array( 'db' => 'no_resi',  'dt' => 0 ),
		   array( 'db' => 'nama_penerima',  'dt' => 1 ),
		   array( 'db' => 'total_produk',  'dt' => 2 ),
		   array( 'db' => 'dibayarkan',  'dt' => 3 ),
		   array( 'db' => 'pending',  'dt' => 4 ),
		   array( 
			'db' => 'l_status', 
			'dt' => 5,
			'formatter' => function( $d, $row ) {
			 $no_resi = $row[0];
			 $no_resi1 = encrypt_decrypt('encrypt',$row[0]);
			 $buttons='';
			 $buttons.='
					 <a href="#" data-target="#view-modal5" data-toggle="modal" data-id='.$no_resi.' id="getUser5" data-whatever="@mdo" class="btn-sm btn-info" style="width: 20px;" title="Klik untuk lihat detail" data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-search-plus"></i>Detail</a>
				
					 ';
			 return $buttons;
			}
	   ), 
	
			  
	   );

}  //if terakhir
else if($act=='tbl_noncod') {

	$table = <<<EOT
	( SELECT no_resi,nama_penerima, FORMAT(total_ongkos_kirim,0) total_ongkos_kirim,l_status, FORMAT(dibayarkan,0) dibayarkan
		,FORMAT((total_ongkos_kirim-dibayarkan),0) pending FROM transaksi WHERE kode_layanan <> 'COD' 
		AND DATE_FORMAT(tanggal_kirim_kurir, '%Y-%m-%d')=CURRENT_DATE() AND pengirim='$id_merchant'
) viewData
EOT;
$primaryKey = 'no_resi';
$columns = array(
   
	   array( 'db' => 'no_resi',  'dt' => 0 ),
	   array( 'db' => 'nama_penerima',  'dt' => 1 ),
	   array( 'db' => 'total_ongkos_kirim',  'dt' => 2 ),
	   array( 'db' => 'dibayarkan',  'dt' => 3 ),
	   array( 'db' => 'pending',  'dt' => 4 ),
	   array( 
		'db' => 'l_status', 
		'dt' => 5,
		'formatter' => function( $d, $row ) {
		 $no_resi = $row[0];
		 $no_resi1 = encrypt_decrypt('encrypt',$row[0]);
		 $buttons='';
		 $buttons.='
				 <a href="#" data-target="#view-modal6" data-toggle="modal" data-id='.$no_resi.' id="getUser6" data-whatever="@mdo" class="btn-sm btn-info" style="width: 20px;" title="Klik untuk lihat detail" data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-search-plus"></i>Detail</a>
			
				 ';
		 return $buttons;
		}
   ), 

		  
   );

}  //non cod
else if($act=='all_transaksi') {

$table = <<<EOT
		( SELECT CASE 
		WHEN a.kode_layanan='COD' THEN a.total_produk
		ELSE 0
		END AS nominal,
		a.no_resi, a.nama_penerima, a.no_hp,
		b.nama namprov, c.nama namkab, d.nama namkec, e.nama namkel, a.total_berat, a.l_status, a.total_bayar, f.status_name FROM transaksi a 
		LEFT JOIN provinsi b ON a.provinsi=b.id_prov
		LEFT JOIN kabupaten c ON a.kabupaten=c.id_kab
		LEFT JOIN kecamatan d ON a.kecamatan=d.id_kec
		LEFT JOIN kelurahan e ON a.kelurahan=e.id_kel
		LEFT JOIN  master_status f ON a.l_status=f.l_status 
		WHERE a.l_status <> 'Z'
		
) viewData
EOT;
	$primaryKey = 'no_resi';
	$columns = array(
		   
			   array( 'db' => 'no_resi',  'dt' => 0 ),
			   array( 'db' => 'nama_penerima',  'dt' => 1 ),
			   array( 'db' => 'namprov',  'dt' => 2 ),
			   array( 'db' => 'namkab',  'dt' => 3 ),
			   array( 'db' => 'namkec',  'dt' => 4 ),
			   array( 'db' => 'namkel',  'dt' => 5 ),
			   array( 'db' => 'nominal',  'dt' => 6 ),
				  
		   );
	
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
  



