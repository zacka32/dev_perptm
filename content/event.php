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
            <div class="col-lg-5">
                <div class="vl-breadcrumb-title">
                    <h2 class="heading">Events</h2>
                    <div class="vl-breadcrumb-list">
                        <span><a href="?page=home">Home</a></span>
                        <span class="dvir"><i class="fa-solid fa-angle-right"></i></span>
                        <span><a class="active" href="#">Events</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--===== BREADCRUMB AREA ENDS =======-->

<section class="vl-singlevent-iner sp1">
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
            $ml = $db->prepare("SELECT * FROM event 
            WHERE l_aktif = 'Y'  
            ORDER BY id_auto DESC 
            LIMIT :limit OFFSET :offset");

            $ml->bindValue(':limit', $limit, PDO::PARAM_INT);
            $ml->bindValue(':offset', $offset, PDO::PARAM_INT);
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
            <?php } 

$total = $db->query("SELECT COUNT(*) FROM event WHERE l_aktif = 'Y' ")->fetchColumn();
$totalPages = ceil($total / $limit);
?>


        </div> <!-- //row -->
        <!-- pagination -->
        <div class="row">
            <div class="col-12 m-auto">
                <div class="theme-pagination thme-pagination-mt text-center mt-18">
                    <ul>
                        <div class="theme-pagination text-center mt-18">
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
                    </ul>
                </div>
            </div>
        </div>
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