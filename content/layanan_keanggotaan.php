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
                    <h2 class="heading">Our Service</h2>
                    <div class="vl-breadcrumb-list">
                        <span><a href="index.html">Home</a></span>
                        <span class="dvir"><i class="fa-solid fa-angle-right"></i></span>
                        <span><a class="active" href="#">Layanan Keanggotaan</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--===== BREADCRUMB AREA ENDS =======-->


<!--===== SERVICE AREA STARTS =======-->
<section class="vl-services2 service-inner-page sp2">
    <div class="container">
        <div class="row">
            <!-- single service box -->
            <div class="col-xl-4 col-md-6">
                <div class="vl-single-service-box mb-30">
                    <div class="vl-service-box-flex">
                        <div class="icon">
                            <span><img src="assets/img/icons/vl-tags.svg" alt=""></span>
                        </div>
                        <div class="thumb">
                            <div class="sm-thumb">
                                <img src="assets/img/service/vl-service-sm-thumb-1.5.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="vl-service-box-content">
                        <h4 class="title"><a href="#">Aspirasi & Keluhan</a></h4>
                        <p>Sampaikan aspirasi, keluhan, atau masalah ketenagakerjaan Anda secara rahasia dan terpercaya.
                        </p>

                        <button class="btn_custom header-btn1">Sampaikan Aspirasi <span><i
                                    class="fa-solid fa-arrow-right"></i></span></button>

                        <!-- <a href="#" class="header-btn1">Read More <span><i class="fa-solid fa-arrow-right"></i></span></a> -->
                    </div>
                </div>
            </div>
            <style>
            .btn_custom {
                background-color: var(--ztc-bg-bg-2);
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                font-size: 16px;
            }

            .btn_custom:hover {
                background-color: #000000ff;

                color: white;
                z-index: 1;
                transition: 0.3s;

            }
            .btn_custom_reset {
                background-color: #f2c100ff;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                font-size: 16px;
            }
            </style>

            <!-- single service box -->
            <div class="col-xl-4 col-md-6">
                <div class="vl-single-service-box mb-30">
                    <div class="vl-service-box-flex">
                        <div class="icon">
                            <span><img src="assets/img/icons/vl-footer-2.1.svg" alt=""></span>
                        </div>
                        <div class="thumb">
                            <div class="sm-thumb">
                                <img src="assets/img/service/vl-service-sm-thumb-1.5.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="vl-service-box-content">
                        <h4 class="title"><a href="#">Konsultasi</a></h4>
                        <p>Dapatkan konsultasi langsung dengan tim ahli kami mengenai permasalahan ketenagakerjaan.</p>

                        <button class="btn_custom header-btn1">Jadwal Konsultasi <span><i
                                    class="fa-solid fa-arrow-right"></i></span></button>

                        <!-- <a href="#" class="header-btn1">Read More <span><i class="fa-solid fa-arrow-right"></i></span></a> -->
                    </div>
                </div>
            </div>

            <!-- single service box -->
            <div class="col-xl-4 col-md-6">
                <div class="vl-single-service-box mb-30">
                    <div class="vl-service-box-flex">
                        <div class="icon">
                            <span><img src="assets/img/icons/vl-footer-2.1.svg" alt=""></span>
                        </div>
                        <div class="thumb">
                            <div class="sm-thumb">
                                <img src="assets/img/service/vl-service-sm-thumb-1.5.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="vl-service-box-content">
                        <h4 class="title"><a href="#">Bantuan Informasi</a></h4>
                        <p>Akses informasi tentang hak-hak pekerja, PKB, dan kebijakan perusahaan.</p>

                        <button class="btn_custom header-btn1">Liat Informasi <span><i
                                    class="fa-solid fa-arrow-right"></i></span></button>

                        <!-- <a href="#" class="header-btn1">Read More <span><i class="fa-solid fa-arrow-right"></i></span></a> -->
                    </div>
                </div>
            </div>

            <!-- single service box -->
            <!-- <div class="col-xl-4 col-md-6">
        <div class="vl-single-service-box mb-30">
          <div class="vl-service-box-flex">
            <div class="icon">
              <span><img src="assets/img/icons/vl-team-right-1.1.svg" alt=""></span>
            </div>
            <div class="thumb">
              <div class="sm-thumb">
                <img src="assets/img/service/vl-service-sm-thumb-1.5.png" alt="">
              </div>
            </div>
          </div>
          <div class="vl-service-box-content">
            <h4 class="title"><a href="#">FAQ</a></h4>
            <p>Temukan jawaban atas pertanyaan umum seputar keanggotaan dan layanan PERPANTAM.</p>
         
                    <button class="btn_custom header-btn1">Sampaikan Aspirasi <span><i class="fa-solid fa-arrow-right"></i></span></button>
                  
           
          </div>
        </div>
      </div> -->


        </div>
    </div>
</section>
<!--===== SERVICE AREA ENDS =======-->

<!--===== SERVICE AREA STARTS 2 =======-->
<section class="vl-service-iner-bg sp2">
    <div class="container">
      <div class="row">
    <div class="col-xl-6 col-md-6 mb-3">
        <div class="form-group">
            <label>Nama Lengkap *</label>
            <input type="text" class="form-control" placeholder="Masukkan nama lengkap" required>
        </div>
    </div>

    <div class="col-xl-6 col-md-6 mb-3">
        <div class="form-group">
            <label>NIK/ID Karyawan *</label>
            <input type="text" class="form-control" placeholder="Masukkan NIK" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-md-6 mb-3">
        <div class="form-group">
            <label>Email *</label>
            <input type="email" class="form-control" placeholder="email@antam.com" required>
        </div>
    </div>

    <div class="col-xl-6 col-md-6 mb-3">
        <div class="form-group">
            <label>Nomor Telepon *</label>
            <input type="tel" class="form-control" placeholder="08xxxxxxxxxx" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-3">
        <div class="form-group">
            <label>Subjek/Perihal *</label>
            <input type="text" class="form-control" placeholder="Tuliskan subjek aspirasi Anda" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-3">
        <div class="form-group">
            <label>Isi Aspirasi *</label>
            <textarea class="form-control" rows="6" placeholder="Jelaskan aspirasi, keluhan, atau saran Anda secara detail..." required></textarea>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-xl-6 col-md-6 mb-2">
        <button type="submit" class="btn btn-submit w-100 btn_custom header-btn1">
            Kirim Aspirasi
        </button>
    </div>

    <div class="col-xl-6 col-md-6 mb-2">
        <button type="reset" class="btn btn-reset w-100 btn_custom_reset header-btn1">
            Reset Form
        </button>
    </div>
</div>


    </div>  
</section>
<!--===== SERVICE AREA ENDS 2 =======-->

