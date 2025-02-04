<title>Beranda - ExisForCat 1.1</title>
<?php

// Gejala
$stmt = $conn->prepare("SELECT count(*) as total FROM gejala");
$stmt->execute();
$result = $stmt->get_result();
$dtgejala = $result->fetch_assoc();
?>
<div class='row'>
  <div class='col-lg-3 col-xs-6'>
    <!-- small box -->
    <div class='small-box bg-aqua'>
      <div class='inner'>
        <h3> <?php echo $dtgejala["total"]; ?></h3>
        <p>Total Gejala</p>
      </div>
      <div class='icon'>
        <i class='ion ion-thermometer'></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <?php
  // Penyakit
  $stmt = $conn->prepare("SELECT count(*) as total FROM penyakit");
  $stmt->execute();
  $result = $stmt->get_result();
  $dtpenyakit = $result->fetch_assoc();
  ?>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3> <?php echo $dtpenyakit["total"]; ?></h3>

        <p>Total Penyakit</p>
      </div>
      <div class="icon">
        <i class="ion ion-bug"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <?php
  // Pengetahuan
  $stmt = $conn->prepare("SELECT count(*) as total FROM basis_pengetahuan");
  $stmt->execute();
  $result = $stmt->get_result();
  $dtpengetahuan = $result->fetch_assoc();
  ?>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php echo $dtpengetahuan["total"]; ?></h3>

        <p>Total Pengetahuan</p>
      </div>
      <div class="icon">
        <i class="ion ion-erlenmeyer-flask"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <?php

  // Admin
  $stmt = $conn->prepare("SELECT count(*) as total FROM admin");
  $stmt->execute();
  $result = $stmt->get_result();
  $dtadmin = $result->fetch_assoc();
  ?>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3> <?php echo $dtadmin["total"]; ?></h3>
        <p>Total Admin Pakar</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
</div>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
    <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
    <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
  </ol>
  <div class="carousel-inner">
    <div class="item active">
      <img src="assets/banner/banner-3.png" alt="Second slide">
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
      <img src="assets/banner/banner-4.png" alt="Second slide">
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item">
      <a href="?module=diagnosa">
        <img src="assets/banner/banner-5.png" alt="Second slide">
        <div class="carousel-caption">
        </div>
      </a>
    </div>
    <div class="item">
      <a href="?module=riwayat">
        <img src="assets/banner/banner-2.png" alt="Second slide">
        <div class="carousel-caption">
        </div>
      </a>
    </div>
    <div class="item">
      <a href="?module=keterangan">
        <img src="assets/banner/banner-1.png" alt="Second slide">
        <div class="carousel-caption">
      </a>
    </div>
  </div>
</div>
<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
  <span class="fa fa-angle-left"></span>
</a>
<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
  <span class="fa fa-angle-right"></span>
</a>
</div>
<br>

<div class="row">
  <div class="col-sm-6 text-center padding wow fadeIn animated" data-wow-duration="1000ms" data-wow-delay="300ms"
    style="visibility: visible; animation-duration: 1000ms; animation-delay: 300ms; animation-name: fadeIn;">
    <div class="single-service">

      <img class="img-thumbnail" src="assets/banner/icon1.png" alt="">

      <h2>Aplikasi Responsif</h2>
      <p>Aplikasi sistem pakar ini dapat menyesuaikan ukuran perangkat anda, jadi walupun di akses melalui perangkat
        mobile tetap nyaman juga.</p>
    </div>
  </div>
  <div class="col-sm-6 text-center padding wow fadeIn animated" data-wow-duration="1000ms" data-wow-delay="900ms"
    style="visibility: visible; animation-duration: 1000ms; animation-delay: 900ms; animation-name: fadeIn;">
    <div class="single-service">
      <img class="img-thumbnail" src="assets/banner/icon2.png" alt="">
      <h2>Admin Pakar</h2>
      <p>Terdapat fitur admin pakar, untuk mengatur pengetahuan dan CF pakar, telah di sesuaikan tampilannya sehingga
        pakar bisa lebih mengeksplore aplikasi.</p>
    </div>
  </div>
</div>
<div></div>