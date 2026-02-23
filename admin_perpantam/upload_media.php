<?php
include "config/koneksi.php";

if(isset($_FILES['file'])){

    $allow = ['jpg','jpeg','png','gif'];

    $name = $_FILES['file']['name'];
    $tmp  = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if(!in_array($ext,$allow)){
        echo json_encode(['status'=>0,'msg'=>'Format tidak didukung']);
        exit;
    }

    if($size > 2*1024*1024){
        echo json_encode(['status'=>0,'msg'=>'Max 2MB']);
        exit;
    }

    $new = time().'_'.rand(1000,9999).'.'.$ext;

    move_uploaded_file($tmp,"../assets/upload/".$new);

    $db->prepare("INSERT INTO multimedia(gambar) VALUES(?)")->execute([$new]);

    echo json_encode([
        'status'=>1,
        'file'=>$new
    ]);

}
