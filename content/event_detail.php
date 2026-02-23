 <?php 
                      $sl = $db->prepare("SELECT * FROM event 
          WHERE id_auto = :id ");

          $sl->execute([':id' => $_GET['id']]);

           $s = $sl->fetch();
             $mulai = strtotime($s['mulai']);
              $day   = date('d', $mulai);   // 01
              $month = date('M', $mulai);   // JAN
              $year  = date('Y', $mulai);   // 2025


              $start_dt = new DateTime($s['mulai']);
              $end_dt   = new DateTime($s['akhir']);

              $start_str = $start_dt->format('M j, Y @ g:i a');
              $end_str   = $end_dt->format('M j, Y @ g:i a');
            ?>
<style>
    .header-area {
        background-color: #004d3f;
    }
</style>
<!-- sidebar area start -->
 <div class="vl-sidebar-area sp2" style="
    margin-top: 50px;">
  <div class="container">
    <div class="row">
      <div class="col-xl-8 mx-auto">
        <div class="vl-event-content-area">
          <div class="vl-large-thumb">
            <img class="w-100" src="assets/upload/<?php echo $s['gambar']; ?>" alt="">
          </div>
          <div class="vl-event-content">
            <h2 class="title"><?php echo $s['judul']; ?></h2>
            <p class="para pb-16"><?php echo $s['deskripsi']; ?></p>
          
          </div>

          <div class="vl-event-box-bg">
            <div class="row">
              <!-- single icon box -->
              <div class="col-lg-6 col-md-6">
                <div class="icon-box mb-30">
                  <div class="icon">
                    <span><img src="assets/img/icons/vl-event-date1.1.svg" alt=""></span>
                  </div>
                  <div class="content">
                    <h4 class="title">Mulai Dari</h4>
                    <p class="para"><?php echo $day . " " . $month . " " . $year; ?> <br>  <?php echo date('g:i a', $mulai); ?></p>
                  </div>
                </div>
              </div>
              <!-- single icon box -->
              <div class="col-lg-6 col-md-6">
                <div class="icon-box mb-30">
                  <div class="icon">
                    <span><img src="assets/img/icons/vl-event-date1.1.svg" alt=""></span>
                  </div>
                  <div class="content">
                    <h4 class="title">Sampai Dengan</h4>
                    <p class="para"><?php echo $end_str; ?></p>
                  </div>
                </div>
              </div>

              <!-- btn -->
              <!-- <div class="btn-area pb-32">
                <a href="contact.html" class="header-btn1">Gabung Kegiatan <span><i class="fa-solid fa-arrow-right"></i></span></a>
              </div> -->

              

              
              <!-- input field -->
             
          </div>

          

        </div>
      </div>
    </div>
  </div>
 </div>
<!-- sidebar area end -->




<section class="vl-singlevent-iner pb-50">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 mx-auto">
        <div class="more-title text-center mb-60">
          <h2 class="title">Kegiatan Lainnya</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- single event item -->
      
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

            <!-- single event item -->
            <div class="col-lg-12 mb-50">
                <div class="event-bg-flex active">
                    <div class="event-date">
                        <h3 class="title"><?= $day ?></h3>
                        <p class="year"><?= $month ?> <br class="d-none d-xl-block"> <?= $year ?></p>
                    </div>
                    <div class="event-content">
                        <div class="event-meta">
                            <p class="para">
                                <?= $start_str ?> - <?= $end_str ?>
                            </p>
                        </div>
                        <a href="?page=event_detail&id=<?= $m['id_auto'] ?>" class="title">
                            <?php
                            echo substr($m['judul'], 0, 35);
                                    ?>
                                   </a>
                        <p class="para"><?php
                            echo substr($m['deskripsi'], 0, 36);
                                    ?>
                        </p>
                        <a href="?page=event_detail&id=<?= $m['id_auto'] ?>" class="details">Liat Selengkapnya <span><i
                                    class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                    <div class="event-thumb-wrap event-thumb ">
                        <img class="w-100" src="assets/upload/<?php echo $m['gambar']; ?>" alt="">
                    </div>
                </div>
            </div>
       <?php }  ?>
        </div> <!-- //row -->
    
  </div>
</section>



<style> 
.event-thumb-wrap {
    width: 370px;
    height: 200px;
    overflow: hidden;
    border-radius: 12px; /* optional, biar cakep */
    background: #f3f3f3;
}

.event-thumb-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}


</style>