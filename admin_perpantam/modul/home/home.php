<!-- HEADER =========================================================== -->
<section class="content">
    <?php
       $sub = $db->prepare("SELECT count(*) jml from `news` WHERE l_aktif='Y'");
                  $sub->execute();
                  $r = $sub->fetch();

          $sub1 = $db->prepare("SELECT COUNT(*) jml from customer WHERE is_verified=1");
                  $sub1->execute();
                  $r1 = $sub1->fetch();

          $sub2 = $db->prepare("SELECT sum(views) jml from page_views");
                  $sub2->execute();
                  $r2 = $sub2->fetch();

           $sub3 = $db->prepare("SELECT count(*) jml from `event` WHERE l_aktif='Y'");
                  $sub3->execute();
                  $r3 = $sub3->fetch();

           $sub4 = $db->prepare("SELECT COUNT(*) jml from produk WHERE aktif='Y'");
                  $sub4->execute();
                  $r4 = $sub4->fetch();
            ?>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $r3['jml']; ?></h3>
                    <p>Jumlah Kegiatan Aktif</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="?module=absen" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $r['jml']; ?></h3>
                    <p>Jumlah Berita & Informasi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="?module=user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= $r1['jml']; ?></h3>
                    <p>Jumlah Anggota</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="?module=user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?= $r2['jml']; ?></h3>
                    <p>Kunjungan Website</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="?module=lap_absen" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Jadwal Kegiatan</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Mulai</th>
                                  <th>Selesai </th>
                                  <th> Judul </th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php 
               $query = $db->prepare("SELECT * from `event` WHERE l_aktif='Y' ORDER BY mulai DESC LIMIT 10");
               $query->execute();
                while($r = $query->fetch()) { 
                 
                  echo "<tr>
                  <td>$r[id_auto]</td>
                        <td>$r[mulai]</td>
                        <td>$r[akhir]</td>
                       
                        <td>$r[judul]</td>
                       
                  
             
                  </tr>
                  ";
                }
         ?> 
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix" style="display: none;">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Next</a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Preview</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">News Update</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Judul</th>
                                  <th>Tag </th>
              
                                    
                                </tr>
                            </thead>
                            <tbody>
                                 <?php 
               $query = $db->prepare("SELECT * from `news` WHERE l_aktif='Y' ORDER BY id_auto DESC LIMIT 10");
               $query->execute();

                while($r = $query->fetch()) { 
                
                  echo "<tr>
                  <td>$r[id_auto]</td>
                        <td>$r[judul]</td>
                        <td>$r[tag]</td>
                       
                                    
                  </tr>
                  ";
                }
         ?> 
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix" style="display: none;">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Next</a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">Preview</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>

    </div>
</section>