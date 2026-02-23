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
                    <h2 class="heading" style="font-size: xxx-large;">Tentang Kami</h2>
                    <div class="vl-breadcrumb-list">
                        <span><a href="index.html">Home</a></span>
                        <span class="dvir"><i class="fa-solid fa-angle-right"></i></span>
                        <span><a class="active" href="#">Tentang Kami</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--===== BREADCRUMB AREA ENDS =======-->


<!--===== ABOUT AREA STARTS =======-->
<section class="vl-about5 sp2">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="vl-about-content">
                    <div class="vl-section-title-1 mb-50">
                        <!-- <h5 class="subtitle">Sejarah Kami</h5> -->
                        <h2 class="title">Sejarah Kami</h2>
                        <p>
                            <?php echo $p['deskripsi'];  ?>

                        </p>

                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="vl-about-content2 ml-20">
                    <!-- thumbnail -->
                    <div class="large-thumb mb-30 bg-540">
                        <img class="w-100" src="assets/upload/logo_bg-CO7qTnJR.png" alt="">
                    </div>
                    <!-- content -->

                </div>
            </div>
        </div>
    </div>
</section>
<style>
.vl-section-title-1 p {
    font-size: var(--ztc-font-size-font-s14);
}
</style>

<!--===== ABOUT AREA ENDS =======-->

<!--===== MISSION AREA STARTS =======-->
<section class="vl-about-mission-bg sp2">
    <div class="container">
        <div class="row">
            <div class="row">
                <!-- Fungsi -->
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="fungsi-card">
                        <div class="fungsi-icon">
                            <img src="assets/img/icons/vl-service-icon-3.3.svg" alt="">
                        </div>
                        <h3 class="fungsi-title">Visi</h3>

                        <div class="ckeditor-content">
                            <?php echo $p['fungsi']; ?>
                        </div>
                    </div>
                </div>

                <!-- Tujuan -->
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="fungsi-card">
                        <div class="fungsi-icon">
                            <img src="assets/img/icons/vl-service-icon-3.3.svg" alt="">
                        </div>
                        <h3 class="fungsi-title">Misi</h3>

                        <div class="ckeditor-content">
                            <?php echo $p['tujuan']; ?>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</section>
<!--===== MISSION AREA ENDS =======-->

<!--===== VISSION AREA STARTS =======-->
<!-- 
<section class="vl-about-vission-bg sp2">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5">
                <div class="vission-thumb mb-30">
                    <img class="w-100" src="assets/img/about/vl-vission2.png" alt="">
                </div>
            </div>
            <div class="col-xl-7 col-lg-7">
                <div class="vl-vission-content ml-50 mb-30">
                    <div class="vl-section-title-1">
                        <h5 class="subtitle"></h5>
                        <h2 class="title">Usaha Kami </h2>
                        <p>Dalam mencapai tujuannya, Perpantam melakukan usaha-usaha berikut</p>
                    </div>

                    <div class="vl-vission-tab2" style="width: 100%;">
                        <div class="row">
                            <div class="col-xl-12">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home" aria-selected="true">Harmonis</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">Kesejahteraan </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-contact" type="button" role="tab"
                                            aria-controls="pills-contact" aria-selected="false">Kolaborasi</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-ide-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-ide" type="button" role="tab"
                                            aria-controls="pills-ide" aria-selected="false">Advokasi</button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab" tabindex="0">
                                        <p class="para"><?php echo $p['harmonis']; ?></p>
                                       
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab" tabindex="0">
                                        <p class="para"><?php echo $p['kesejahteraan']; ?></p>
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                        aria-labelledby="pills-contact-tab" tabindex="0">
                                        <p class="para"><?php echo $p['kolaborasi']; ?></p>
                                    </div>
                                    <div class="tab-pane fade" id="pills-ide" role="tabpanel"
                                        aria-labelledby="pills-ide-tab" tabindex="0">
                                        <p class="para"><?php echo $p['advokasi']; ?></p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section> -->

<!--===== VISSION AREA ENDS =======-->


<!--===== COUNTER AREA STARTS =======-->
<section class="vl-counter5 counter-iner sp2">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="vl-counter-content mb-30">
                    <div class="vl-section-title-1">
                        <h5 class="subtitle">Statistik </h5>
                        <h2 class="title">Jumlah Anggota <br class="d-none d-xl-block"> </h2>
                        <!-- <p class="para pb-32">Jumlah Anggota Perpantam dari beberapa Periode </p> -->

                        <div class="btn-area">
                            <a href="contact.html" class="header-btn1">Join Now<span><i
                                        class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 mb-10">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <p></p>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <!-- single counter box -->
                        <div class="single-counter-box counter-box-2">
                            <h3 class="title"> <span class="title counter">300</span></h3>
                            <span class="pt-20">Anggota</span>
                        </div>
                    </div>
                    
                  
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!--===== COUNTER AREA ENDS =======-->

<!--===== BRAND AREA STARTS =======-->
<!--===== BRAND AREA ENDS =======-->



<style>
.ckeditor-content ul {
    list-style: none !important;
}

.ckeditor-content li {
    position: relative;
    padding-left: 20px;
}

.ckeditor-content li::before {
    content: "•";
    position: absolute;
    left: 0;
    top: 0;
    color: #000;
    font-size: 18px;
}

.fungsi-card {
  border: 2px solid #d6a21d;   /* warna kuning */
  border-radius: 20px;
  padding: 40px 35px;
  height: 100%;
  background: #fff;
  text-align: center;
}

.fungsi-icon {
  margin-bottom: 15px;
}

.fungsi-icon img {
  width: 45px;
  height: auto;
}

.fungsi-title {
  font-size: 22px;
  font-weight: 700;
  color: #0b4d3b;  /* hijau tua */
  margin-bottom: 25px;
}

/* CKEDITOR LIST FIX */
.fungsi-card .ckeditor-content {
  text-align: left;
}

.fungsi-card .ckeditor-content ul {
  list-style-type: disc !important;
  padding-left: 25px !important;
  margin-left: 0 !important;
}

.fungsi-card .ckeditor-content li {
  margin-bottom: 10px;
  line-height: 1.6;
}

</style>