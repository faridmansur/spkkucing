<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
  header('location:index.php');
  exit();
} else {
  ?>
  <?php
  session_start();
  include "../../config/koneksi.php";

  $module = $_GET['module'];
  $act = $_GET['act'];

  // Hapus pengetahuan
  if ($module == 'pengetahuan' and $act == 'hapus') {
    mysqli_query($conn, "DELETE FROM basis_pengetahuan WHERE kode_pengetahuan='$_GET[id]'");
    header('location:../../index.php?module=' . $module);
  }

  // Input pengetahuan
  elseif ($module == 'pengetahuan' and $act == 'input') {
    $kode_penyakit = $_POST['kode_penyakit'];
    $kode_gejala = $_POST['kode_gejala'];
    $mb = $_POST['mb'];
    $md = $_POST['md'];
    mysqli_query($conn, "INSERT INTO basis_pengetahuan(
			      kode_penyakit,kode_gejala,mb,md) 
	                       VALUES(
				'$kode_penyakit','$kode_gejala','$mb','$md')");
    header('location:../../index.php?module=' . $module);
  }

  // Update pengetahuan
  elseif ($module == 'pengetahuan' and $act == 'update') {
    $kode_penyakit = $_POST['kode_penyakit'];
    $kode_gejala = $_POST['kode_gejala'];
    $mb = $_POST['mb'];
    $md = $_POST['md'];
    mysqli_query($conn, "UPDATE basis_pengetahuan SET
					kode_penyakit   = '$kode_penyakit',
					kode_gejala   = '$kode_gejala',
					mb   = '$mb',
					md   = '$md'
               WHERE kode_pengetahuan       = '$_POST[id]'");
    header('location:../../index.php?module=' . $module);
  }

?>
<?php } ?>