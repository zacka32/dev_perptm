<?php 
            $bn = $db->prepare("SELECT * FROM banner WHERE posisi='$_GET[page]' AND l_status = 'A' ORDER BY id_banner DESC ");
            $bn->execute();
$sb = $bn->fetch();
if(!$sb){
    $sb['gambar'] = "DJI_0920-HDR.jpg";
}

$pr = $db->prepare("SELECT * FROM profile WHERE id_profile='1' ");
            $pr->execute();
$p = $pr->fetch();
            ?>

<!--===== BREADCRUMB AREA STARTS =======-->
<section class="vl-breadcrumb" style="background-image: url(./assets/upload/<?php echo $sb['gambar']; ?>);">

    <div class="shape1"><img src="assets/img/breadcrumb/breadcrumb-shape-1.1.png" alt=""></div>
    <div class="shape2"><img src="assets/img/breadcrumb/breadcrumb-shape-1.2.png" alt=""></div>
    <div class="shape2"><img src="assets/img/breadcrumb/breadcrumb-shape-1.3.png" alt=""></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="vl-breadcrumb-title">
                    <h2 class="heading" style="font-size: xxx-large;">Struktur Organisasi</h2>
                    <div class="vl-breadcrumb-list">
                        <span><a href="index.html">Home</a></span>
                        <span class="dvir"><i class="fa-solid fa-angle-right"></i></span>
                        <span><a class="active" href="#">Struktur Organisasi</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--===== BREADCRUMB AREA ENDS =======-->

<?php
function tree($parent = null, $level = 0){
    global $db;

    if(is_null($parent)){
        $stmt = $db->prepare("SELECT * FROM struktur_organisasi 
                               WHERE parent_id IS NULL OR parent_id=0
                               ORDER BY urutan");
        $stmt->execute();
    } else {
        $stmt = $db->prepare("SELECT * FROM struktur_organisasi 
                               WHERE parent_id = ? 
                               ORDER BY urutan");
        $stmt->execute([$parent]);
    }

    if($stmt->rowCount() > 0){

        echo "<ul>";

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            echo "<li>";

            // 🔴 kalau level pertama kasih class khusus
            $class = ($level == 0) ? "card root-card" : "card";

            echo "
            <div class='$class'>
                <img src='assets/upload/{$row['foto']}' class='foto-profil'>
                <h4>{$row['nama']}</h4>
                <span>{$row['jabatan']}</span>
            </div>
            ";

            // recursive + naik level
            tree($row['id'], $level + 1);

            echo "</li>";
        }

        echo "</ul>";
    }
}




?>
<!--===== ABOUT AREA STARTS =======-->
<section class="vl-about5 sp2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="vl-about-content">
                    
                    <div class="vl-section-title-1 mb-50">
                   
                        <h2 class="title" style="text-align: center;">Struktur Organisasi</h2>
                        <div class="org-tree">
                    <?php tree(); ?>
                    </div>

                    </div>
            
                    
                </div>
            </div>
            
        </div>
    </div>
</section>

<style>

    .root-card {
    margin-top: -17px;
}

  /* Container utama */
.org-tree {
    display: flex;
    justify-content: center;
    overflow-x: auto; /* Agar bisa scroll kalau bagan terlalu lebar */
    padding: 20px;
}

/* Base list styling */
.org-tree ul {
    padding-top: 20px;
    position: relative;
    display: flex;
    justify-content: center;
    list-style-type: none;
    transition: all 0.5s;
}

.org-tree li {
    text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;
    transition: all 0.5s;
}

/* Garis penghubung horizontal */
.org-tree li::before, .org-tree li::after {
    content: '';
    position: absolute;
    top: 0;
    right: 50%;
    border-top: 2px solid #004d3f;
    width: 50%;
    height: 20px;
}
.org-tree li::after {
    right: auto;
    left: 50%;
    border-left: 2px solid #004d3f;
}

/* Hilangkan garis ujung */
.org-tree li:first-child::before, .org-tree li:last-child::after {
    border: 0 none;
}
.org-tree li:last-child::before {
    border-right: 2px solid #004d3f;
    border-radius: 0 5px 0 0;
}
.org-tree li:first-child::after {
    border-radius: 5px 0 0 0;
}

/* Garis vertikal dari parent ke child */
.org-tree ul ul::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    border-left: 2px solid #004d3f;
    width: 0;
    height: 20px;
}
/* --- PERBAIKAN PADA NODE --- */
.node {
    padding: 15px;
    display: inline-flex; /* Ubah ke flex agar mudah mengatur posisi anak elemen */
    flex-direction: column; /* Susun ke bawah */
    align-items: center; /* SEMUA ISI JADI DI TENGAH SECARA HORIZONTAL */
    justify-content: center;
    border-radius: 10px;
    background: #fff;
    border: 1px solid #ddd;
    min-width: 160px; /* Sedikit lebih lebar agar teks tidak sesak */
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    position: relative;
    transition: all 0.3s;
}

/* --- PERBAIKAN FOTO --- */
.foto-profil {
   height: 200px;
    border-radius: 10%;
    object-fit: cover;
    object-position: center;
    
    /* Menghilangkan margin aneh dan memastikan posisi di tengah */
    display: block; 
    margin: 0 auto 10px auto; 
    
    border: 3px solid #fff;
    outline: 1px solid #ddd; /* Memberi kesan border tipis di luar foto putih */
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* --- PERBAIKAN TEKS --- */
.jabatan {
    font-size: 11px;
    font-weight: 600;
    color: #888;
    text-transform: uppercase;
    order: 3; /* Memastikan jabatan di bawah nama */
}

.nama {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin-top: 5px;
    order: 2; /* Nama di bawah foto */
}

/* Warna berdasarkan Level */
.level-1 { border-top: 4px solid #ff4757; } /* Ketua */
.level-2 { border-top: 4px solid #1e90ff; } /* Wakil & Sekretaris */
.level-3 { border-top: 4px solid #2ed573; } /* Staff */

/* 1. Tambahkan transition pada elemen dasar agar gerakannya mulus */
.node {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); /* Efek membal (bounce) */
    cursor: pointer;
}

.foto-profil {
    transition: all 0.3s ease-in-out;
    filter: grayscale(20%); /* Sedikit abu-abu saat normal (opsional) */
}

/* 2. Efek saat KOTAK di-hover (Mouse masuk ke area nama/jabatan) */
.node:hover {
    transform: translateY(-10px); /* Kotak naik ke atas */
    box-shadow: 0 10px 20px rgba(0,0,0,0.15); /* Bayangan jadi lebih dalam */
    border-color: #3498db; /* Warna border berubah */
}

/* 3. Efek saat FOTO di-hover secara spesifik */
.node:hover .foto-profil {
    transform: scale(1.15) rotate(3deg); /* Foto membesar & miring sedikit */
    filter: grayscale(0%); /* Warna jadi cerah kembali */
    border-color: #3498db;
    box-shadow: 0 0 15px rgba(52, 152, 219, 0.4); /* Efek glowing di sekitar foto */
}

/* 4. Efek klik (Active) */
.node:active {
    transform: scale(0.95); /* Sedikit mengecil saat diklik */
}

/* ================= MOBILE MODE ================= */
@media (max-width: 768px) {

    /* container jadi normal */
    .org-tree {
        display: block;
        padding: 10px;
    }

    /* semua UL jadi vertical */
    .org-tree ul {
        display: block;
        padding-top: 0;
    }

    .org-tree li {
        display: block;
        padding: 15px 0;
    }

    /* MATIKAN semua garis */
    .org-tree li::before,
    .org-tree li::after,
    .org-tree ul ul::before {
        display: none;
    }

    /* node full width */
    .node {
        width: 100%;
        max-width: 280px;
        margin: 0 auto;
    }

}


    </style>