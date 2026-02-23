<!DOCTYPE html>
<html lang="en">


<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// <-- LETAKKAN TEPAT DI SINI:
// =============================================

// =============================================

// --- (Sisa kode Anda, koneksi.php, header(), try...catch, dll) ---
 include "config/koneksi.php";
      
       
        include "config/fungsi_indotgl.php";
  include "header.php";
        $mains = $db->prepare("SELECT * FROM profile ");
        $mains->execute();
        $m = $mains->fetch();

       
        ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <!--=====FAB ICON=======-->
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">

    <!--===== CSS LINK =======-->
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/aos.css">
    <link rel="stylesheet" href="assets/css/plugins/fontawesome.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/mobile.css">
    <link rel="stylesheet" href="assets/css/plugins/owlcarousel.min.css">
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/plugins/sidebar.css">
    <link rel="stylesheet" href="assets/css/plugins/slick-slider.css">
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/lightbox.css">
    <link rel="stylesheet" href="assets/css/main.css">

</head>

<body class="homepage1-body">

    <!--===== PRELOADER STARTS =======-->
    <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon"><img src="logo_kompres.png" alt=""></div>
        </div>
    </div>


    <!-- ===================== HEADER TOP AREA START =====================-->
    <div class="vl-header-top d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="vl-header-top-content">
                        <p><?= $m['banner_top']; ?></p>
                        <a href="#" class="top-contact">Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="vl-header-top-icon">
                        <div class="vl-header-top-icbox">
                            <div class="top-icon">
                                <span><img src="assets/img/icons/vl-top-ic-1.1.svg" alt=""></span>
                            </div>
                            <div class="top-content">
                                <a href="mailto:<?php echo $m['email']; ?>"><?php echo $m['email']; ?></a>
                            </div>
                        </div>

                        <div class="vl-header-top-icbox">
                            <div class="top-icon">
                                <span><img src="assets/img/icons/vl-top-ic-1.2.svg" alt=""></span>
                            </div>
                            <div class="top-content">
                                <a href="tel:<?php echo $m['no_telp']; ?>"><?php echo $m['no_telp']; ?></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ===================== HEADER TOP AREA END =====================-->

    <!--=====HEADER START=======-->
    <header>
        <div class="header-area homepage1 header header-sticky d-none d-xl-block mt-16" id="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-elements header-elements-1">
                            <div class="site-logo">
                                <a href="?page=home"><img src="assets/img/logo/vl-logo-1.1.png" alt=""></a>
                            </div>
                            <div class="main-menu">
                                <ul>
                                    <li><a href="?page=home">Home </a>

                                    <li><a href="#">About Me <i class="fa-solid fa-angle-down"></i></a>
                                        <ul class="dropdown-padding">
                                            <li><a href="?page=tentang_kami">Tentang Kami</a></li>
                                            <li><a href="?page=struktur_organisasi">Struktur Organisasi</a></li>
                                            <li><a href="?page=kontak">Kontak</a></li>

                                        </ul>
                                    </li>


                                    <li><a href="?page=event">Kegiatan</a></li>
                                    <li><a href="?page=gallery">Gallery</a></li>


                                    <li><a href="#">Informasi <i class="fa-solid fa-angle-down"></i></a>
                                        <ul class="dropdown-padding">
                                            <li><a href="?page=layanan_keanggotaan">Layanan Keanggotaan</a></li>
                                            <li><a href="?page=news">Berita & Pengumuman</a></li>
                                        </ul>
                                    </li>




                                </ul>
                            </div>
                            <div class="btn-area">
                                <a href="#"  data-bs-toggle="modal"
data-bs-target="#modalLogin"
class="header-btn1">Login Anggota <span><i
                                            class="fa-solid fa-arrow-right"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--=====HEADER END =======-->

    <!--===== MOBILE HEADER STARTS =======-->
    <div class="mobile-header mobile-haeder1 d-block d-xl-none">
        <div class="container">
            <div class="col-12">
                <div class="mobile-header-elements">
                    <div class="mobile-logo">          
                        <a href="?page=home"><img src="assets/img/logo/vl-logo-1.1.png" alt=""></a>
                    </div>
                    <div class="mobile-nav-icon dots-menu">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-sidebar mobile-sidebar1">
        <div class="logosicon-area">
            <div class="logos">
                <img src="assets/img/logo/vl-logo-1.1.png" alt="">
            </div>
            <div class="menu-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="mobile-nav mobile-nav1">
            <ul class="mobile-nav-list nav-list1">
                <li><a href="?page=home">Home </a>

                </li>
                <li><a href="#">About Me</a>
                    <ul class="sub-menu">
                        <li><a href="?page=tentang_kami">Tentang Kami</a></li>
                        <li><a href="?page=struktur_organisasi">Struktur Organisasi</a></li>
                        <li><a href="?page=kontak">Kontak</a></li>
                    </ul>
                </li>
                <li><a href="?page=kegiatan">Kegiatan</a></li>
                <li><a href="?page=gallery">Gallery</a></li>

                <li><a href="#">Informasi </a>
                    <ul class="sub-menu">
                        <li><a href="?page=layanan_keanggotaan">Layanan Keanggotaan</a></li>
                        <li><a href="?page=news">Berita & Pengumuman</a></li>
                    </ul>
                </li>
            </ul>

            <div class="allmobilesection">
                <!-- btn -->
                <a href="contact.html" class="header-mobile-btn1">Get Started <span><i
                            class="fa-solid fa-arrow-right"></i></span></a>

                <div class="vl-mobile-contact1">
                    <h3 class="title">Contact Info</h3>
                    <div class="footer1-contact-info">
                        <div class="contact-info-single">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-phone-volume"></i>
                            </div>
                            <div class="contact-info-text">

                                <a href="tel:<?php echo $m['no_telp']; ?>"><?php echo $m['no_telp']; ?></a>
                            </div>
                        </div>

                        <!-- single footer -->
                        <div class="contact-info-single">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="contact-info-text">
                              <a href="mailto:<?php echo $m['email']; ?>"><?php echo $m['email']; ?></a>
                              
                            </div>
                        </div>

                        <!-- single footer -->
                        <div class="contact-info-single">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="contact-info-text">
                                <a href="#"><?php echo $m['alamat']; ?></a>
                            </div>
                        </div>


                        <!-- <div class="vl-mobile-contact1">
                            <h3 class="title">Social Links</h3>
                            <div class="social-links-mobile-menu">
                                <ul>
                                    <li><a href="<?php echo $m['link_facebook']; ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="<?php echo $m['link_ig']; ?>"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    <li><a href="<?php echo $m['link_youtube']; ?>"><i class="fa-brands fa-youtube"></i></a></li>
                                </ul>
                            </div> 
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== MOBILE HEADER STARTS =======-->



    <?php 
    include "hub.php"; 
    include "modal.php"; 
     $mains = $db->prepare("SELECT * FROM profile ");
        $mains->execute();
        $m = $mains->fetch();

?>



    <!--===== FOOTER AREA STARTS =======-->
    <footer class="vl-footer-bg-1">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="vl-footer-widget-1 mb-30">
                        <div class="vl-footer-logo">
                            <a href="?page=home"><img src="assets/img/logo/vl-logo-1.1.png" alt=""></a>
                        </div>
                        <div class="vl-footer-content">
                            <p>Persatuan Pegawai Aneka Tambang adalah organisasi serikat pekerja yang memperjuangkan hak dan kepentingan para pegawai PT Aneka Tambang (ANTAM) untuk menciptakan lingkungan kerja yang lebih baik.</p>
                        </div>
                        <div class="vl-footer-social-1">
                          
                            <ul>
                             <li><a href="<?= $m['link_facebook']; ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="<?= $m['link_ig']; ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="<?= $m['link_twitter']; ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="<?= $m['link_youtube']; ?>" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                        
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="vl-footer-widget-2 pl-90 mb-30">
                        <h3 class="title">Quick Links</h3>
                        <div class="vl-footer-menu">
                            <ul>
                                <li><a href="?page=home">Home Page</a></li>
                                <li><a href="?page=tentang_kami">Tentang Kami</a></li>
                                <li><a href="?page=layanan_keanggotaan">Layanan</a></li>
                                <li><a href="?page=news">News & Blog</a></li>
                              
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="vl-footer-widget-2 pl-30 mb-30">
                        <h3 class="title">Our services</h3>
                        <div class="vl-footer-menu">
                            <ul>
                                <li><a href="#">Aspirasi Keluhan</a></li>
        
                                <li><a href="#">Konsultasi</a></li>
                                <li><a href="team.html">Bantuan Informasi</a></li>
                                <li><a href="#">FAQ</a></li>
                       
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="vl-footer-widget-3 mb-30">
                        <h3 class="title">Contact Us</h3>
                        <!-- single box -->
                        <div class="vl-footer-icon-list">
                            <div class="vl-footer-icon">
                                <span><img src="assets/img/icons/vl-footer-ic-1.1.svg" alt=""></span>
                            </div>
                            <div class="vl-footer-text">
                                <a href="mailto:<?php echo $m['email']; ?>">
                                    <span style="font-size: var(--ztc-font-size-font-s14);"><?php echo $m['email']; ?></span></a>
                            </div>
                        </div>

                        <!-- single box -->
                        <div class="vl-footer-icon-list">
                            <div class="vl-footer-icon">
                                <span><img src="assets/img/icons/vl-footer-ic-1.2.svg" alt=""></span>
                            </div>
                            <div class="vl-footer-text">
                                <a href="#"><span style="font-size: var(--ztc-font-size-font-s12);"><?php echo $m['alamat']; ?></span></a>
                                   </a>
                            </div>
                        </div>

                        <!-- single box -->
                        <div class="vl-footer-icon-list">
                            <div class="vl-footer-icon">
                                <span><img src="assets/img/icons/vl-footer-2.1.svg" alt=""></span>
                            </div>
                            <div class="vl-footer-text">
                                <a href="tel:<?php echo $m['no_telp']; ?>"><?php echo $m['no_telp']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="vl-copyright copyright-border-1">
                <div class="row">
                    <div class="col-md-6">
                        <p class="vl-copyright-text">© 2026 Perpantam ,Inc. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="vl-copyright-menu">
                            <ul>
                                <li><a href="#">Privacy Policy </a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--===== FOOTER AREA ENDS =======-->

    <!--===== Scroll Top =======-->
    <div class="paginacontainer">
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>
    </div>




    <!--===== JS SCRIPT LINK =======-->
    <script src="assets/js/plugins/jquery-3.7.1.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/fontawesome.js"></script>
    <script src="assets/js/plugins/aos.js"></script>
    <script src="assets/js/plugins/counter.js"></script>
    <script src="assets/js/plugins/sidebar.js"></script>
    <script src="assets/js/plugins/magnific-popup.js"></script>
    <script src="assets/js/plugins/mobilemenu.js"></script>
    <script src="assets/js/plugins/owlcarousel.min.js"></script>
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/nice-select.js"></script>
    <script src="assets/js/plugins/jquery.counterup.min.js"></script>
    <script src="assets/js/plugins/waypoints.js"></script>
    <script src="assets/js/plugins/slick-slider.js"></script>
    <script src="assets/js/plugins/circle-progress.js"></script>
    <script src="assets/js/plugins/gsap.min.js"></script>
    <script src="assets/js/plugins/ScrollTrigger.min.js"></script>
    <script src="assets/js/plugins/Splitetext.js"></script>
    <script src="assets/js/plugins/lightbox.js"></script>
    <script src="assets/js/plugins/circle-progress.min.js"></script>
    <script src="assets/js/main.js"></script>
<!-- #004d3f    -->
</body>

</html>

