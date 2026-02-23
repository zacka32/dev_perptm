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
                    <h2 class="heading">Our Gallery</h2>
                    <div class="vl-breadcrumb-list">
                        <span><a href="?page=home">Home</a></span>
                        <span class="dvir"><i class="fa-solid fa-angle-right"></i></span>
                        <span><a class="active" href="#">Our Gallery </a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--===== BREADCRUMB AREA ENDS =======-->

<!--===== GALLERY AREA STARTS =======-->

<section class="vl-gallery-section sp2">
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
            $ml = $db->prepare("SELECT * FROM gallery 
WHERE l_aktif = 'Y'
ORDER BY id_auto DESC 
LIMIT :limit OFFSET :offset");

$ml->bindValue(':limit', $limit, PDO::PARAM_INT);
$ml->bindValue(':offset', $offset, PDO::PARAM_INT);
$ml->execute();

            while($m = $ml->fetch()) {
            ?>
            <!-- single gallery box -->
            <div class="col-lg-4 col-md-6">
                <div class="vl-single-box vl-single-box-inner-h270 mb-30">
                    <a href="assets/upload/<?php echo $m['gambar']; ?>" data-lightbox="image-1"><img class="w-100"
                            src="assets/upload/<?php echo $m['gambar']; ?>" alt=""></a>
                    <a href="assets/upload/<?php echo $m['gambar']; ?>" data-lightbox="image-1" class="search-ic">
                        <span><img src="assets/img/icons/vl-gallery-search-1.1.svg" alt=""></span>
                    </a>
                </div>
            </div>
            <?php } 

$total = $db->query("SELECT COUNT(*) FROM gallery WHERE l_aktif = 'Y' ")->fetchColumn();
$totalPages = ceil($total / $limit);
?>




        </div> <!-- //row -->

        <!-- pagination -->
        <div class="row">
            <div class="col-12 m-auto">
                <div class="theme-pagination text-center mt-18">
                    <ul>

                        <div class="theme-pagination text-center mt-18">
                            <ul>

                                <?php if($hal > 1): ?>
                                <li>
                                    <a href="index.php?page=gallery&p=<?= $hal-1 ?>">
                                        <i class="fa-solid fa-angle-left"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php for($i=1;$i<=$totalPages;$i++): ?>
                                <li>
                                    <a class="<?= ($i==$hal)?'active':'' ?>" href="index.php?page=gallery&p=<?= $i ?>">
                                        <?= sprintf('%02d',$i) ?>
                                    </a>
                                </li>
                                <?php endfor; ?>

                                <?php if($hal < $totalPages): ?>
                                <li>
                                    <a href="index.php?page=gallery&p=<?= $hal+1 ?>">
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


<!--===== TEAM AREA ENDS =======-->

