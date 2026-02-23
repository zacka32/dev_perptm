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
          <h2 class="heading">Berita & Pengumuman</h2>
            <div class="vl-breadcrumb-list">
              <span><a href="index.html">Home</a></span>
              <span class="dvir"><i class="fa-solid fa-angle-right"></i></span>
              <span><a class="active" href="#">Berita & Pengumuman</a></span>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--===== BREADCRUMB AREA ENDS =======-->

<!--===== BLOG AREA STARTS =======-->
<section class="vl-blog-inner sp2">
  <div class="container">
    <div class="row">

      <?php
          $hal = isset($_GET['p']) ? (int)$_GET['p'] : 1;
          if($hal < 1) $hal = 1;

          $limit = 9;
          $offset = ($hal - 1) * $limit;

          ?>
                      <!-- single gallery box -->

                      <?php 
                      $ml = $db->prepare("SELECT * FROM news 
          WHERE l_aktif = 'Y' 
          ORDER BY id_auto DESC 
          LIMIT :limit OFFSET :offset");

          $ml->bindValue(':limit', $limit, PDO::PARAM_INT);
          $ml->bindValue(':offset', $offset, PDO::PARAM_INT);
          $ml->execute();

            while($m = $ml->fetch()) {
              $mulai = strtotime($m['mulai']);
              $mulai   = date('d F Y', $mulai);   // 01
       

            ?>


      <!-- single blog box -->
      <div class="col-xl-4 col-md-6">
        <div class="vl-single-blg-item mb-30">
          <div class="vl-blg-thumb">
            <a href="?page=news_detail&id=<?php echo $m['id_auto']; ?>"><img class="w-100" src="assets/upload/<?php echo $m['gambar']; ?>" alt=""></a>
          </div>

          <div class="vl-meta">
            <ul>
              <li><a href="#"><span class="top-minus"> <img src="assets/img/icons/vl-calender-1.1.svg" alt=""></span> <?= $mulai ?></a></li>
              <li><a href="#"><span class="top-minus"> <img src="assets/img/icons/vl-user-1.1.svg" alt=""></span><?php echo $m['ml']; ?></a></li>
            </ul>
          </div>
          <div class="vl-blg-content">
            <h3 class="title"><a href="?page=news_detail&id=<?php echo $m['id_auto']; ?>"><?php echo $m['tag']; ?></a></h3>
            <p><?php echo $m['judul']; ?></p>
            <!-- <a href="#" class="read-more">Read More <span><i class="fa-solid fa-arrow-right"></i></span></a> -->
          </div>
        </div>
      </div>
       <?php } 

$total = $db->query("SELECT COUNT(*) FROM news WHERE l_aktif = 'Y' ")->fetchColumn();
$totalPages = ceil($total / $limit);
?>



    </div>

      <!-- pagination -->
      <div class="row">
          <div class="col-12 m-auto">
             <div class="theme-pagination thme-pagination-mt text-center mt-18">
                <ul>
                    <?php if($hal > 1): ?>
                    <li>
                        <a href="?page=event&p=<?= $hal-1 ?>">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php for($i=1;$i<=$totalPages;$i++): ?>
                    <li>
                        <a class="<?= ($i==$hal)?'active':'' ?>" href="?page=event&p=<?= $i ?>">
                            <?= sprintf('%02d',$i) ?>
                        </a>
                    </li>
                    <?php endfor; ?>

                    <?php if($hal < $totalPages): ?>
                    <li>
                        <a href="?page=event&p=<?= $hal+1 ?>">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
             </div>
         </div>
      </div>
  </div>
</section>

<!--===== BLOG AREA ENDS =======-->


