<!-- sidebar area start -->
<style>
.header-area {
    background-color: #004d3f;
}
</style>
<div class="vl-sidebar-area sp2" style="
    margin-top: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="vl-widget-area">
                    <!-- single widget -->
                    <!-- <div class="vl-search-widget mb-30">
              <h3 class="title">Search</h3>
              <div class="search p-relative">
                <input type="text" placeholder="Search...">
                  <span>
                    <img src="assets/img/icons/vl-search-icon.svg" alt="">
                  </span>
              </div>
           </div> -->

                    <!-- single widget -->
                    <div class="vl-search-widget mb-30">
                        <h3 class="title">Recent News</h3>

                        <?php 
                      $ml = $db->prepare("SELECT * FROM news 
          WHERE l_aktif = 'Y' 
          ORDER BY id_auto DESC 
          LIMIT 6");

          $ml->execute();

            while($m = $ml->fetch()) {
              $mulai = strtotime($m['mulai']);
              $mulai   = date('d F Y', $mulai);   // 01
            ?>

                        <!-- rec blog -->
                        <div class="vl-rec-blog-flex">
                            <div class="vl-rec-blog-thumb">
                                <img src="assets/upload/<?php echo $m['gambar']; ?>" alt="">
                            </div>
                            <div class="vl-rec-blog-content">
                                <div class="vl-rec-blog-date">
                                    <span><img src="assets/img/icons/vl-calender-1.1.svg" alt=""></span>
                                    <p class="dta-blg"><?php echo $mulai; ?></p>
                                </div>
                                <div class="vl-rec-blog-content-heading">
                                    <h3 class="tittle"><a href=""><?php echo $m['judul']; ?></a></h3>
                                </div>
                            </div>
                        </div>
                        <?php }  ?>

                    </div>


                    <!-- single widget -->


                </div>
            </div>

            <!-- single news -->
            <?php 
                      $sl = $db->prepare("SELECT * FROM news 
          WHERE id_auto = :id ");

          $sl->execute([':id' => $_GET['id']]);

           $s = $sl->fetch();
              $mulai_tanggal = strtotime($s['mulai']);
              $mulai_tanggal   = date('d F Y', $mulai_tanggal);   // 01
            ?>

            <div class="col-xl-8 col-lg-7">
                <div class="vl-event-content-area ml-50">
                    <div class="vl-large-thumb">
                        <img class="w-100" src="assets/upload/<?php echo $s['gambar']; ?>" alt="">
                    </div>

                    <div class="vl-blog-meta-box mt-32">
                        <ul>

                            <li><a href="#"> <span class="icon"><img class="mt-4-"
                                            src="assets/img/icons/vl-calender-1.1.svg" alt=""></span>
                                    <?php echo $mulai_tanggal; ?></a></li>
                            <li><a href="#"> <span class="icon"><img class="mt-4-" src="assets/img/icons/vl-tags.svg"
                                            alt=""></span> <?php echo $s['tag']; ?></a></li>
                            <li><a href="#"> <span class="icon"><img class="mt-4-"
                                            src="assets/img/icons/vl-chatting-icon.svg" alt=""></span>2 comments</a>
                            </li>
                        </ul>
                    </div>
                    <div class="vl-event-content vl-blg-content">
                        <h2 class="title"><?php echo $s['judul']; ?></h2>
                        <p><?php echo $s['deskripsi']; ?></p>

                    </div>

                    <br><br>
    <!-- awal komen -->
                    <form action="content/komentar.php" method="POST">
                    <h5 class="title" style="    padding: 10px 7px;
    background: #004d3f;
    margin-top: 50px;
    color: white;
    border-radius: 5px;">ADD A REVIEW</h5>

                    <div class="rating-row pt-2">
                        <p class="d-block">Your Rating</p>
                        <span class="rating-widget-block">
                            <?php for($i=5;$i>=1;$i--): ?>
                            <input type="radio" name="rating" id="star<?php echo $i ?>" value="<?php echo $i ?>"
                                required>
                            <label for="star<?php echo $i ?>"></label>
                            <?php endfor; ?>
                        </span>
                        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id_auto">

                        <div class="row">
                            <div class="col-12 mt--15 site-form ">
                                <div class="form-group">
                                    <label for="message">Comment</label>
                                    <textarea name="komentar" id="komentar" cols="30" rows="10" class="form-control"
                                        style="
                                                                border: 1px solid #c5a2a2;
                                                            "></textarea>
                                </div>
                            </div>
                            <div class="g-recaptcha my-3" data-sitekey="6Ldv3BMsAAAAACSmifaKgn577RtMTdHAkR6Sg6Dn"></div>
                            <div class="col-lg-4">
                                <div class="btn-area">
                                    <button type="submit" class="header-btn1">Post Comment &nbsp;</button>
                                </div>
                            </div>
                        </div>
                        </div>
                </form>

                <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- akhir komen -->


                </div>

                


            </div>
        </div>
    </div>
</div>
<!-- sidebar area end -->

<!-- ///komentar ini hanya untuk yang sudah beli buku ini  -->
<section class="vl-singlevent-iner pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                
    </div>
    </div>
    </div>
</section>

<!--===== TESTIMONIAL AREA STARTS =======-->
<section class="vl-testimonial vl-testimonial-bg sp1">
    <div class="container">
        <div class="vl-section-title-1 white mb-60 text-center">
            <!-- <h5 class="subtitle" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">Komentar</h5> -->
            <h2 class="title text-anime-style-3">Komentar</h2>
            <!-- <p data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">Long-term recovery requires sustainable livelihoods.<br class="d-none d-xl-block"> We support individuals & families in rebuilding.</p> -->
        </div>
        <div class="row">

            <div class="vl-testimonial-arow p-relative">
                <div id="testimoni1" class="owl-carousel owl-theme">


                    <!-- single testimonial box -->
                    <?php
              $rt = $db->prepare("SELECT * FROM komentar WHERE l_status='Y' AND id_news = ? ORDER BY id DESC");
              $rt->execute([$_GET['id']]);
              while ($row = $rt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="vl-testimonial-box p-relative">
                        <div class="vl-testimonial-box-icon">
                            <?php
                      $rating = $row['rating']; // nilai 1-5 dari database
                      $rating = intval($row['rating']); // pastikan jadi integer
                      for ($i = 1; $i <= 5; $i++) {
                          if ($i <= $rating) {
                              echo '  <span><i class="fa-solid fa-star"></i></span>';
                          } else {
                              echo '<span class="fa-solid fa-star-half-stroke"></span>';
                          }
                      }
                      ?>
                        </div>
                        <div class="vl-testimonial-box-content">
                            <p><?php echo $row['pesan']; ?></p>
                        </div>
                        <div class="vl-testimonial-box-auth">
                            <div class="vl-auth-desc">
                                <div class="auth-img">
                                    <img src="assets/img/testimonial/vl-testimonial-auth-1.1.png" alt="">
                                </div>
                                <div class="auth-title">
                                    <h4 class="title"><a href="#">Anonim</a></h4>
                                    <span>Volunteer</span>
                                </div>
                            </div>
                            <div class="vl-auth-quote">
                                <span><img src="assets/img/icons/vl-qut-1.1.svg" alt=""></span>
                            </div>
                        </div>
                    </div>
                    <?php  } ?>



                </div>
            </div>
        </div>
    </div>
</section>
<!--===== TESTIMONIAL AREA ENDS =======-->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">



<style>
/* container per item */
.vl-rec-blog-flex {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 16px;
}

/* thumbnail */
.vl-rec-blog-thumb img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 6px;
}

/* konten */
.vl-rec-blog-content {
    flex: 1;
}

/* tanggal */
.vl-rec-blog-date {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #777;
    margin-bottom: 4px;
}

.vl-rec-blog-date img {
    width: 14px;
}

/* judul */
.vl-rec-blog-content-heading .tittle {
    font-size: 14px;
    line-height: 1.4;
    margin: 0;
}

/* batasi judul max 2 baris */
.vl-rec-blog-content-heading .tittle a {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-decoration: none;
}


/* //rating   */
.rating-widget-block {
    display: inline-flex;
    flex-direction: row-reverse;
    gap: 6px;
}

/* sembunyikan radio tapi tetap bisa klik */
.rating-widget-block input {
    display: none;
}

/* label WAJIB punya area klik */
.rating-widget-block label {
    display: inline-block;
    cursor: pointer;
}

/* bintang kosong */
.rating-widget-block label::before {
    content: "\f005";
    font-family: "Font Awesome 6 Free";
    font-weight: 400;
    font-size: 22px;
    color: #ccc;
}

/* hover */
.rating-widget-block label:hover::before,
.rating-widget-block label:hover ~ label::before {
    color: #ffc107;
    font-weight: 900;
}

/* selected */
.rating-widget-block input:checked ~ label::before {
    color: #ffc107;
    font-weight: 900;
}


</style>