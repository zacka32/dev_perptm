<?php
session_start();
require '../../config/koneksi.php';
require '../../config/fungsi_encryptdecrypt.php';
require '../../config/fungsi_hakakses.php';
$userid=$_SESSION['userid'];
$act= $_GET['act'];
if($act=='list_index') {
$table = <<<EOT
 ( SELECT a.*, concat(b.id_produk,"-",b.nama_produk) names ,b.image_cover,  c.nama_lengkap, b.judul_asli FROM komentar a left join produk b on a.id_produk=b.id_produk
 LEFT JOIN customer c ON a.userid=c.id 
  ) viewData
EOT;
$primaryKey = 'id';
$columns = array(
	array( 'db' => 'id', 'dt' => 0 ),
	array( 'db' => 'pesan', 'dt' => 1 ),
	array( 'db' => 'rating', 'dt' => 2 ),
	array( 'db' => 'nama_lengkap', 'dt' => 3 ),
	array( 'db' => 'names', 'dt' => 4 ),
	array( 
				'db' => 'image_cover', 
				'dt' => 5,
				'formatter' => function( $d, $row ) {
								$buttons=' <img src="../image/'.$row[5].'" width="100" >';
					return $buttons;
				}
		),
	array( 'db' => 'created_at', 
		   'dt' => 6,
		   'formatter' => function( $d, $row ) {
			$tgl_indo = date("d, M-Y", strtotime($row[6]));
  				// $buttons=$tgl_indo;
                            
                return $tgl_indo;
            }
       ),
	   array( 'db' => 'l_status', 'dt' => 7 ),
	array( 
            'db' => 'judul_asli', 
            'dt' => 8,
            'formatter' => function( $d, $row ) {
            				$id = encrypt_decrypt('encrypt',$row[0]);
							$aksi="modul/ulasan_produk/aksi_ulasan_produk.php";
            				$buttons='
						';
								// if (hakakses($_SESSION['userid'],'ulasan_produk','edit')):
		                        //     $buttons.='
		                        //     <a href="?module=ulasan_produk&act=editulasan_produk&id='.$id.'" class="btn-sm btn-primary" style="width: 20px;" title="Klik untuk Edit" data-tt="tooltip" data-placement="top"><i class="fa fa-fw fa-edit"></i></a>';
	                        	// endif;
								// 							$buttons.='
								// <a href="#" data-target="#view-modal5" data-toggle="modal" data-id='.$row[0].' id="getUser5" data-whatever="@mdo" class="btn-sm btn-info" style="width: 20px;" title="Klik untuk liat detail" data-tt="tooltip" data-placement="top">Liat Ebooks</a>';

								//  $buttons.='
		                        //     <a href="?module=ulasan_produk&act=addulasan_produk&id='.$id.'" class="btn-sm btn-success" style="width: 20px;" title="Klick Untuk tambahkan ebook yang akan dapat ulasan_produk ini" data-tt="tooltip" data-placement="top">Tambah Ebooks</a>';
	                        	if($row['7']=='Y') { 
									$buttons.='<a href="'.$aksi.'?module=ulasan_produk&act=notampilkan_komentar&id='.$id.'" class="btn-sm btn-warning" style="width: 20px;" title="Klik untuk  Tidak Tampilkan Komentar Ini" data-tt="tooltip" data-placement="top">Non Aktifkan Komen</a>';
								} else {
										$buttons.='<a href="'.$aksi.'?module=ulasan_produk&act=tampilkan_komentar&id='.$id.'" class="btn-sm btn-info" style="width: 20px;" title="Klik untuk Tampilkan Komentar" data-tt="tooltip" data-placement="top">Tampilkan Komentar</a>';
								}
								
								
								
									// if (hakakses($_SESSION['userid'],'ulasan_produk','hapus')):
		                        //    	$buttons .='
								// 		<a type="button" onClick="hapusulasan_produk(\''.$row[0].'\');" class="btn-sm btn-danger" title="Klik untuk hapus" data-tt="tooltip" data-placement="top"><i class="fa fa-trash-o"></i></a>
								
								// 		';
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
