
<!--===== HERO AREA STARTS =======-->
<div class="vl-banner p-relative fix">
  <div class="slider-active-1">
    <!-- single slider -->
     <?php 
            $bn = $db->prepare("SELECT * FROM banner WHERE posisi='Baris Utama Atas Slider' AND l_status = 'A' ");
            $bn->execute();
            while($sb = $bn->fetch()) { 
            ?>
    <div class="vl-hero-slider vl-hero-bg" style="background-image: url(./assets/upload/<?= $sb['gambar']; ?>);">
      <div class="vl-hero-shape shape-1">
        <img src="assets/img/shape/vl-hero-shape-1.1.png" alt="">
      </div>
      <div class="vl-hero-shape shape-2">
        <img src="assets/img/shape/vl-hero-shape-1.2.png" alt="">
      </div>
<!--     
      <div class="vl-hero-social d-none d-lg-block">
        <h4 class="title">Follow Us:</h4>
        <div class="vl-hero-social-icon">
          <ul>
            <li><a href="<?= $m['link_facebook']; ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
            <li><a href="<?= $m['link_ig']; ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href="<?= $m['link_twitter']; ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
            <li><a href="<?= $m['link_youtube']; ?>" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
          </ul>
        </div>
      </div> -->
    
      <div class="container">
        <div class="row">
          <div class="col-xl-7">
            <div class="vl-hero-section-title">
                <h5 class="vl-subtitle"> <span><img src="assets/img/icons/vl-sub-title-icon.svg" alt=""></span> <?= $sb['teks1']; ?></h5>
                <h1 class="vl-title text-anime-style-3"><?= $sb['teks2']; ?></h1>
                <p><?= $sb['teks3']; ?></p>
                <div class="vl-hero-btn">
                  <a href="contact.html" class="header-btn1">Apresiasi Anggota <span><i class="fa-solid fa-arrow-right"></i></span></a>
                </div>
            </div>
          </div>
          <div class="col-lg-5"></div>
        </div>
      </div>
    </div>
  <?php } ?>
    <!-- single slider -->
    <!-- <div class="vl-hero-slider vl-hero-bg" style="background-image: url(./assets/img/banner/vl-banner-1.1.png);">
      <div class="vl-hero-shape shape-1">
        <img src="assets/img/shape/vl-hero-shape-1.1.png" alt="">
      </div>
      <div class="vl-hero-shape shape-2">
        <img src="assets/img/shape/vl-hero-shape-1.2.png" alt="">
      </div>
    
      <div class="vl-hero-social d-none d-lg-block">
        <h4 class="title">Follow Us:</h4>
        <div class="vl-hero-social-icon">
          <ul>
            <li><a href="<?= $m['link_facebook']; ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
            <li><a href="<?= $m['link_ig']; ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href="<?= $m['link_twitter']; ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
            <li><a href="<?= $m['link_youtube']; ?>" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
          </ul>
        </div>
      </div>
    
      <div class="container">
        <div class="row">
          <div class="col-xl-7">
            <div class="vl-hero-section-title">
                <h5 class="vl-subtitle"> <span><img src="assets/img/icons/vl-sub-title-icon.svg" alt=""></span> Independen, Demokratis, dan Solidaritas</h5>
                <h1 class="vl-title text-anime-style-3">Serikat Perpantam</h1>
                <p> Persatuan Pegawai Aneka Tambang  <br class="d-none d-xl-block"> Serikat yang menghimpun seluruh pekerja Antam dari berbagai sektor pekerja </p>
                <div class="vl-hero-btn">
                  <a href="contact.html" class="header-btn1">Apresiasi Anggota<span><i class="fa-solid fa-arrow-right"></i></span></a>
                </div>
            </div>
          </div>
          <div class="col-lg-5"></div>
        </div>
      </div>
    </div> -->
  </div>
  <div class="vl-arrow">
    <span class="prev-arow"><i class="fa-solid fa-angle-right"></i></span>
    <span class="next-arow"><i class="fa-solid fa-angle-left"></i></span>
  </div>
</div>
<!--===== HERO AREA ENDS =======-->


<!--===== Causes AREA STARTS =======-->
<section class="vl-causes-area sp2">
  <div class="container">
    <div class="vl-causes-section-title text-center">
      <div class="vl-section-title-1 mb-60">
        <h5 class="subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">Berita & Informasi</h5>
        <h2 class="title text-anime-style-3">News Update</h2>
        <p  data-aos="fade-right" data-aos-duration="800" data-aos-delay="300">Informasi terkini dan pengumuman resmi dari PERPANTAM</p> 
      </div>
    </div>
    <div class="row">
          <?php 
                      $ml = $db->prepare("SELECT * FROM news 
          WHERE l_aktif = 'Y' 
          ORDER BY id_auto DESC 
          LIMIT 3");
          $ml->execute();

            while($m = $ml->fetch()) {
              $mulai = strtotime($m['mulai']);
              $mulai   = date('d F Y', $mulai);   // 01
       

            ?>
      <div class="col-xl-4 col-md-6">
        <div class="vl-single-cause-box mb-30" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="300">
          <div class="vl-cause-thumb">
            <img class="w-100" src="assets/upload/<?php echo $m['gambar']; ?>" alt="">
            <div class="btn-area casue-btn text-center">
              <a href="cause-single.html" class="header-btn1"><?php echo $m['tag']; ?> <span><i class="fa-solid fa-arrow-right"></i></span></a>
            </div>
          </div>
          <div class="vl-cause-content">
            <div class="vl-progress">
              <div class="skill-progress">
                <div class="skill-box">
                    <div class="skill-bar skill-bar2">
                        <span class="skill-per html">
                            <span class="tooltipp">16%</span>
                        </span>
                      </div>
                    <div class="skill-vlue">
                      <!-- <div class="num1"><span>Raised: </span>$13,000</div>
                      <div class="num1"><span>Goal: </span>$85,000</div> -->
                    </div>
                </div>
              </div>
            </div>
            <a href="#" class="badge mt-32"><?php echo $m['tag']; ?> </a>
            <h3 class="title"><a href="cause-single.html"><?php echo $m['judul']; ?> </a></h3>
            <p><?php echo substr($m['deskripsi'], 0, 100); ?>...</p>
          </div>
        </div>
      </div>
              <?php } ?>

    </div>
  </div>
</section>
<!--===== Causes AREA ENDS =======-->


<!--===== Gallery AREA STARTS =======-->
<section class="vl-gallery sp2">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-xl-6 mb-60">
        <div class="vl-section-title-1">
          <h5 class="subtitle" data-aos="fade-right" data-aos-duration="800" data-aos-delay="300">Our Gallery</h5>
          </div>
      </div>
      <div class="col-xl-6 mb-60">
        
      </div>
    </div>

    <div class="row">
     <?php
$ml = $db->prepare("SELECT * FROM gallery WHERE l_aktif = 'Y' ORDER BY id_auto DESC LIMIT 8");
$ml->execute();

$pattern = [6,3,3,3,3,6];
$i = 0;

while($m = $ml->fetch(PDO::FETCH_ASSOC)) {

    $col = $pattern[$i % count($pattern)];
    $i++;
?>
    <!-- single gallery box -->
    <div class="col-lg-3 col-md-6 mb-30">
        <div class="vl-single-box">
            <a href="assets/upload/<?= htmlspecialchars($m['gambar']) ?>" data-lightbox="image-1">
                <img class="w-100" src="assets/upload/<?= htmlspecialchars($m['gambar']) ?>" alt="">
            </a>
            <a href="assets/upload/<?= htmlspecialchars($m['gambar']) ?>" data-lightbox="image-1" class="search-ic">
                <span>
                    <img src="assets/img/icons/vl-gallery-search-1.1.svg" alt="">
                </span>
            </a>
        </div>
    </div>
<?php } ?>

    </div>


  </div>
</section>

<!--===== Team AREA ENDS =======-->
<section class="vl-team-bg-1 sp1">
  <div class="container">
    <div class="vl-team-section-title mb-60 text-center">
      <div class="vl-section-title-1">
        <h5 class="subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">We Our Team</h5>
        <h2 class="title text-anime-style-3">struktur Organisasi</h2>
        <!-- <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">Suara Anda penting bagi kami. Bergabunglah dalam dialog <br class="d-none d-xl-block">konstruktif untuk masa depan yang lebih cerah.</p>  -->
      </div>
    </div>
    <div class="row">
      <div id="team1" class="owl-carousel owl-theme">
       
        <?php
$og = $db->prepare("SELECT * FROM struktur_organisasi 
                               ORDER BY parent_id ASC, urutan ASC");
$og->execute();

$no=1;
while($o = $og->fetch(PDO::FETCH_ASSOC)) {

  ?>
        

          <!-- single team item -->
          <div class="vl-team-parent">
            <div class="vl-team-thumb">
              <img class="w-100" src="assets/img/team/vl-team-inner-1.<?php echo $no; ?>.png" alt="">
            </div>
            <div class="vl-team-social">
              <ul>
                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-github"></i></a></li>
              </ul>
            </div>
            <div class="vl-team-content text-center">
              <a href="#" class="title"><?php echo $o['nama']; ?></a>
              <span><?php echo $o['jabatan']; ?></span>
            </div>
          </div>
<?php  $no++; } ?>

        </div>
      </div>
  </div>
</section>
<!--===== Team AREA STARTS =======-->


<!--===== Blog AREA ENDS =======-->
<section class="vl-blg sp2">
  <div class="container">
    <div class="vl-section-title-1 mb-60 text-center">
      <!-- <h5 class="subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">Our Blog</h5> -->
      <h2 class="title text-anime-style-3">Kegiatan</h2>
      <!-- <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">Ever wondered how your contributions make an impact? This blog dives into <br class="d-none d-xl-block"> the tangible ways that donations big or small help provide food.</p> -->
    </div>
    <div class="row">
      <!-- single blog box -->

            <?php 
            $ml = $db->prepare("SELECT * FROM event 
            WHERE l_aktif = 'Y'  
            ORDER BY id_auto DESC 
            LIMIT 3");
            $ml->execute();

            while($m = $ml->fetch()) {
              $mulai = strtotime($m['mulai']);
              $day   = date('d', $mulai);   // 01
              $month = date('M', $mulai);   // JAN
              $year  = date('Y', $mulai);   // 2025
              $start_dt = new DateTime($m['mulai']);
              $end_dt   = new DateTime($m['akhir']);
              $start_str = $start_dt->format('M j, Y @ g:i a');
              $end_str   = $end_dt->format('M j, Y @ g:i a');

            ?>

      <div class="col-xl-4 col-md-6">
        <div class="vl-single-blg-item mb-30" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="300">
          <div class="vl-blg-thumb">
            <a href="blog-single.html"><img class="w-100" src="assets/upload/<?php echo $m['gambar']; ?>" alt=""></a>
          </div>
          <div class="vl-meta">
            <ul>
              <li><a href="#"><span class="top-minus"> <img src="assets/img/icons/vl-calender-1.1.svg" alt=""></span> <?php echo '  ' . $start_str; ?></a></li>
          
            </ul>
          </div>
          <div class="vl-blg-content">
            <h3 class="title"><a href="blog-single.html"><?php echo $m['judul']; ?></a></h3>
            <p><?php echo substr($m['deskripsi'], 0, 100); ?></p>
            <a href="?page=event_detail&id=<?php echo $m['id_auto']; ?>" class="read-more">Read More <span><i class="fa-solid fa-arrow-right"></i></span></a>
          </div>
        </div>
      </div><!-- single blog end -->
 <?php }  ?>
      
    </div>
  </div>
</section>
<!--===== Blog AREA STARTS =======-->