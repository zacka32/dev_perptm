<?php 
            $bn = $db->prepare("SELECT * FROM banner WHERE posisi='$_GET[page]' AND l_status = 'A' ORDER BY id_banner DESC ");
            $bn->execute();
$sb = $bn->fetch();
if(!$sb){
    $sb['gambar'] = "DJI_0920-HDR.jpg";
}
            ?>
<!--===== BREADCRUMB AREA STARTS =======-->
<section class="vl-breadcrumb" style="background-image: url(./assets/upload/<?php echo $sb['gambar']; ?>);">
  <div class="shape1"><img src="assets/img/breadcrumb/breadcrumb-shape-1.1.png" alt=""></div>
  <div class="shape2"><img src="assets/img/breadcrumb/breadcrumb-shape-1.2.png" alt=""></div>
  <div class="shape2"><img src="assets/img/breadcrumb/breadcrumb-shape-1.3.png" alt=""></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="vl-breadcrumb-title">
          <h2 class="heading">Kontak Kami</h2>
            <div class="vl-breadcrumb-list">
              <span><a href="?page=home">Home</a></span>
              <span class="dvir"><i class="fa-solid fa-angle-right"></i></span>
              <span><a class="active" href="#">Kontak Kami</a></span>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--===== BREADCRUMB AREA ENDS =======-->
<?php 
                                    $bn = $db->prepare("SELECT * FROM profile");
                                    $bn->execute();
                                    $b = $bn->fetch();  ?>

<!--===== CONTACT AREA STARTS =======-->
<section class="vl-contact-section-inner sp2">
  <div class="container">
    <div class="row flex-lg-row flex-column-reverse">
      <div class="col-xl-6 mb-30">
        <div class="vl-maps">
 
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2969.1177313462013!2d106.83843638885497!3d-6.301972799999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed8b6afaceab%3A0xc5b2d32096849013!2sAntam%20Office%20Building!5e1!3m2!1sid!2sid!4v1769757284127!5m2!1sid!2sid"  allowfullscreen="" class="vl-contact-maps" loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
      <div class="col-xl-6 mb-30">
        <div class="vl-section-content ml-50">
          <div class="section-title">
            <h4 class="subtitle"></h4>
            <h2 class="title">Kontak Kami</h2>
            <p class="para pb-32">Hubungi kami untuk pertanyaan dan informasi lebih lanjut<br> 
            </p>
          </div>

          <!-- form start -->
           <div class="vl-form-inner">
            <form action="#">
              <div class="row">
                
           <div class="col-lg-12 kontak-box">
    <h5 class="kontak-title">Hubungi Kami</h5>

    <div class="kontak-item">
        <i class="fa-solid fa-phone"></i>
        <span>Telephone : <?php echo $b['no_telp']; ?></span>
    </div>

    <div class="kontak-item">
        <i class="fa-brands fa-whatsapp"></i>
        <span>Whatsapp : <?php echo $b['no_wa']; ?></span>
    </div>

    <div class="kontak-item">
        <i class="fa-solid fa-envelope"></i>
        <span>Email : <?php echo $b['email']; ?></span>
    </div>

    <div class="kontak-item">
        <i class="fa-solid fa-location-dot"></i>
        <span>Lokasi Kami : <?php echo $b['alamat']; ?></span>
    </div>


     <div class="kontak-sosmed-wrapper">
    <h6 class="sosmed-title">Social Media Kami</h6>

    <div class="kontak-sosmed">
        <a href="#" class="sosmed-item facebook">
            <i class="fa-brands fa-facebook-f"></i>
            <span>Facebook</span>
        </a>

        <a href="#" class="sosmed-item instagram">
            <i class="fa-brands fa-instagram"></i>
            <span>Instagram</span>
        </a>

        <a href="#" class="sosmed-item youtube">
            <i class="fa-brands fa-youtube"></i>
            <span>YouTube</span>
        </a>
    </div>
</div>



              </div>
            </form>

            
            <div class="vl-footer-social-1">
         
    
           
            <style>
             .kontak-box {
    font-size: 14px;
    line-height: 1.7;
}

.kontak-title {
    font-weight: 600;
    margin-bottom: 15px;
}

.kontak-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 8px;
}

.kontak-item i {
    color: #555;
    margin-top: 4px;
    min-width: 18px;
}

.kontak-sosmed-wrapper {
    margin-top: 20px;
}

.sosmed-title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #222;
}

/* sosmed layout */
.kontak-sosmed {
    display: flex;
    gap: 20px;
}

/* desktop ke samping */
@media (min-width: 768px) {
    .kontak-sosmed {
        flex-direction: row;
    }
}

/* mobile ke bawah */
@media (max-width: 767px) {
    .kontak-sosmed {
        flex-direction: column;
        gap: 12px;
    }
}

.sosmed-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    text-decoration: none;
    transition: 0.3s;
}

.facebook { color: #1877f2; }
.instagram { color: #e1306c; }
.youtube { color: #ff0000; }

.sosmed-item:hover {
    opacity: 0.75;
}


            </style>
            
           </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--===== CONTACT AREA ENDS =======-->

<!--===== Icon AREA STARTS =======-->
<section class="vl-icon-box-inner pb-70">
  <div class="container">
    <div class="row">
      <!-- icon box -->
      <div class="col-xl-4 col-md-6 mb-30">
        <div class="iconbox">
          <div class="icon-box-flex">
            <div class="icon">
              <span><img src="assets/img/icons/vl-phone-icon1.1.svg" alt=""></span>
            </div>
            <div class="icon-content">
              <p class="para">24/7 Service</p>
              <h3 class="title">Call Us Today</h3>
            </div>
          </div>
          <div class="contact-number">
            <a href="tel:<?php echo $b['no_telp']; ?>" class="para"><?php echo $b['no_telp ']; ?></a> <br class="d-none d-lg-block">
            <a href="tel:<?php echo $b['no_telp']; ?>" class="para"><?php echo $b['no_telp']; ?></a>
          </div>
        </div>
      </div>
      <!-- icon box -->
      <div class="col-xl-4 col-md-6 mb-30">
        <div class="iconbox active">
          <div class="icon-box-flex">
            <div class="icon">
              <span><img src="assets/img/icons/vl-phone-icon1.2.svg" alt=""></span>
            </div>
            <div class="icon-content">
              <p class="para">Drop Line</p>
              <h3 class="title">Mail Information</h3>
            </div>
          </div>
          <div class="contact-number">
            <a href="mailto:<?php echo $b['email']; ?>" class="para"><?php echo $b['email']; ?></a> <br class="d-none d-lg-block">
            <a href="mailto:<?php echo $b['email2']; ?>" class="para"><?php echo $b['email2']; ?></a>
          </div>
        </div>
      </div>

      <!-- icon box -->
      <div class="col-xl-4 col-md-6 mb-30">
        <div class="iconbox">
          <div class="icon-box-flex">
            <div class="icon">
              <span><img src="assets/img/icons/vl-phone-icon1.3.svg" alt=""></span>
            </div>
            <div class="icon-content">
              <p class="para">Address</p>
              <h3 class="title">Our Location</h3>
            </div>
          </div>
          <div class="contact-number">
            <a href="#" class="para"><?php echo $b['alamat']; ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--===== Icon AREA ENDS =======-->

