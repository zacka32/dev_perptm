<?php

//function tambahlog($nik, $module, $aksi, $status){

    include "koneksi.php";

    $nik = $_POST['nik'];
    $module = $_POST['module'];
    $aksi = $_POST['aksi'];
    $status = $_POST['status'];

        

    date_default_timezone_set('Asia/Jakarta');
    $tanggal=date('Y-m-d H:i:s');
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }else{
        $ip = $remote;
    }

    $cek = substr($ip,0,2);

    $refer='';
    $location     = '';
    $provider     = '';
    $city         = '';
    $state        = '';
    $country      = '';

    // if ($cek != '10' or $ip != '::1' ) {

    //   @ $details = json_decode(file_get_contents("http://ipinfo.io/json"));

    //   if (isset($details->loc)){
    //   $location     = $details->loc;
    //   }
    //   if (isset($details->org)){
    //   $provider     = $details->org;
    //   }
    //   if (isset($details->city)){
    //   $city         = $details->city;
    //   }
    //   if (isset($details->region)){
    //   $state        = $details->region;
    //   }
    //   if (isset($details->country)){
    //   $country      = $details->country;
    //   }
      

    // }


    // Get the ip address and info about client.
    
    @ $hostname=gethostbyaddr($_SERVER['REMOTE_ADDR']);

    // Get the query string from the URL.
    $QUERY_STRING = preg_replace("%[^/a-zA-Z0-9@,_=]%", '', $_SERVER['QUERY_STRING']);
    $browser      = $_SERVER['HTTP_USER_AGENT'];
    if (isset($_SERVER['HTTP_REFERER'])){
    $refer        = $_SERVER['HTTP_REFERER'];
    }
    
    
    
    $query = $db->prepare("INSERT INTO log_user (nik, 
                              modul,
                              aksi,
                              status,
                              ip,
                              hostname,
                              browser,
                              refer,
                              location,
                              provider,
                              city,
                              state,
                              country,
                              waktu) 
                      VALUES ('$nik',
                              '$module',
                              '$aksi',
                              '$status',
                              '$ip',
                              '$hostname',
                              '$browser',
                              '$refer',
                              '$location',
                              '$provider',
                              '$city',
                              '$state',
                              '$country',
                              '$tanggal')");
  //   $datalog = array(
  //   ':nik' => $nik,
  //   ':module' => $module,
  //   ':aksi' => $aksi,
  //   ':status' => $status,
  //   ':ip' => $ip,
  //   ':hostname' => $hostname,
  //   ':browser' => $browser,
  //   ':refer' => $refer,
  //   ':location' => $location,
  //   ':provider' => $provider,
  //   ':city' => $city,
  //   ':state' => $state,
  //   ':country' => $country,
  //   ':tanggal' => $tanggal,
  // );
  $query->execute();
    
    
//}
 

?>
