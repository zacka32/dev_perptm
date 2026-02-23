<?php
function UploadImage($fupload_name){
  //direktori gambar
  $vdir_upload = "../../gambar/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 110 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 55;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);

  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}

function Uploadebooks($fupload_name){
  //direktori banner
  $vdir_upload = "../../../image/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["image1"]["tmp_name"], $vfile_upload);
}


function Uploadtambahan($tmp_name, $fupload_name){
    $vdir_upload = "../../../image/"; 
    $vfile_upload = $vdir_upload . $fupload_name;
    move_uploaded_file($tmp_name, $vfile_upload);
}

function UploadBanner($fupload_name){

  //direktori banner

  $vdir_upload = "../../gambar/";

  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya

  move_uploaded_file($_FILES["image1"]["tmp_name"], $vfile_upload);

}

function Uploadpromo($fupload_name){

  //direktori banner

  $vdir_upload = "../../../image/bg-images/";

  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya

  move_uploaded_file($_FILES["image1"]["tmp_name"], $vfile_upload);

}


function UploadBanner2($fupload_name1){
  //direktori banner
  $vdir_upload1 = "../../gambar/";
  $vfile_upload1 = $vdir_upload1 . $fupload_name1;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["image2"]["tmp_name"], $vfile_upload1);
}

function UploadResi($fupload_name){
  //direktori banner
  $vdir_upload = "../../../gambar/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fileupload"]["tmp_name"], $vfile_upload);
}

function UploadFile($fupload_name){
  //direktori file
  $vdir_upload = "../../../files/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

// Upload gambar untuk Uploadproofprint foto
function Uploadproofprint($fupload_name){
  //direktori gambar
  $vdir_upload = "../../gambar/";
  $vfile_upload = $vdir_upload . $fupload_name;
  $imageType = $_FILES["fupload"]["type"];

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  switch($imageType) {
    case "image/gif":
      $im_src=imagecreatefromgif($vfile_upload);
      break;
      case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
      $im_src=imagecreatefromjpeg($vfile_upload);
      break;
      case "image/png":
    case "image/x-png":
      $im_src=imagecreatefrompng($vfile_upload);
      break;
  }

  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi besar 400 pixel
  //Set ukuran gambar hasil perubahan
  if($src_width>=900){
  $dst_width = 900;
  } else {
  $dst_width = $src_width;
  }
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  switch($imageType) {
    case "image/gif":
        imagegif($im,$vdir_upload.$fupload_name);
      break;
      case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
        imagejpeg($im,$vdir_upload.$fupload_name);
      break;
      case "image/png":
    case "image/x-png":
        imagepng($im,$vdir_upload.$fupload_name);
      break;
  }

  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  // imagedestroy($im2);
}



?>
