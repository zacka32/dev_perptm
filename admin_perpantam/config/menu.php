<?php
include "config/koneksi.php";

$userid = $_SESSION['userid'];
$kategori = $_SESSION['kategori'];
$administrator = $_SESSION['administrator'];
    
if ($_SESSION['administrator']=='Y'){   
       
               $main = $db->prepare("SELECT * FROM mainmenu WHERE aktif = 'Y' ORDER BY urutan");
               $main->execute();
                while($r = $main->fetch()) {
                     
                    $cek = $db->prepare("SELECT id_main FROM submenu WHERE link_sub = '?module=$_GET[module]' AND css='Y'");
                    $cek->execute();
                    $c=$cek->fetch();
                    $class_main = '';

                    if($r['id_main'] == $c['id_main']) {
                        $class_main = 'active';
                    }

                    echo "<li class='treeview $class_main'>";
                    if(empty($r['link'])){
                        echo '<a>'.$r['nama_menu'].'</a>';
                    }
                    else{
                            echo "<a href='$r[link]'><img src='$r[gambar]' width='20'>&nbsp;&nbsp;&nbsp; <span>$r[nama_menu]</span></a>";
                    }
                    
                    
                    $sub = $db->prepare("SELECT * FROM submenu WHERE id_main = $r[id_main] AND aktif='Y'  ORDER BY urutan ");
                    $sub->execute();

                                $jml = $sub->rowCount();
                                // apabila sub menu ditemukan
                                if($jml > 0) {
                                    echo "<ul class='treeview-menu'>";
                                    while($w=$sub->fetch()){
                                         $class_sub = '';
                                         $s=substr($_SERVER['REQUEST_URI'],16);

                                        if($w['link_sub'] == $s) {
                                            $class_sub = 'class=active';
                                        }
                                        echo '<li>';
                            echo "<a $s $class_sub href='$w[link_sub]'><img src='$w[gambar]' width='20'>&nbsp;&nbsp;&nbsp; <span>$w[nama_sub]</span></a>";
                        echo '</li>';
                                    }           
                                    echo '</ul>';
                        echo '</li>';
                                } else {
                                    echo '</li>';
                                }
                
                }                
}

    elseif ($_SESSION['administrator']=='N'){

        $main = $db->prepare("SELECT * FROM mainmenu WHERE `status`='$kategori' ");
        $main->execute();
                
            while($r = $main->fetch()) {
                //untuk indikator menu
                $cek = $db->prepare("SELECT id_main FROM submenu WHERE link_sub like  '%$_GET[module]' AND css='Y'");
                $cek->execute();
                $c=$cek->fetch();
                $class_main = '';

                if($r['id_main'] == $c['id_main']) {
                    $class_main = 'active';
                }

            echo "<li class='treeview $class_main'>";
            
            if(empty($r['link'])){
                echo '<a>'.$r['nama_menu'].'</a>';
            }else{
                echo "<a href='$r[link]'><img src='$r[gambar]' width='20'>&nbsp;&nbsp;&nbsp; <span>$r[nama_menu]</span></a>";
            }
            
                    
          $sub = $db->prepare("SELECT * FROM submenu WHERE `status`='$kategori'  ORDER BY urutan ASC
            ");
          $sub->execute();
                    $jml = $sub->rowCount();
                    // apabila sub menu ditemukan
                    if($jml > 0) {
                        echo "<ul class='treeview-menu'>";
                        while($w=$sub->fetch()){
                             $class_sub = '';
                             $s=substr($_SERVER['REQUEST_URI'],16);

                            if($w['link_sub'] == $s) {
                                $class_sub = 'class=active';
                            }

                            echo '<li>';
                echo "<a  $class_sub href='$w[link_sub]'><img src='$w[gambar]' width='20'>&nbsp;&nbsp;&nbsp; <span>$w[nama_sub]</span></a>";
              echo '</li>';
                        }           
                        echo '</ul>';
            echo '</li>';
                    } else {
                        echo '</li>';
                    }
                }

} 



?>
