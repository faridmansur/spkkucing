<title>Detail Riwayat - D'Cat Care</title>
<?php

if ($_GET['id']) {
  $arcolor = array('#ffebee', '#b71c1c', '#c62828', '#d32f2f', '#e53935', '#f44336', '#ef5350', '#e57373', '#ef9a9a', '#ffcdd2');
  $fontColor = array('#000000', '#ffffff', '#ffffff', '#ffffff', '#ffffff', '#000000', '#000000', '#000000', '#000000', '#000000');
  date_default_timezone_set("Asia/Jakarta");
  $inptanggal = date('Y-m-d H:i:s');

  $arbobot = array('0', '1', '0.8', '0.6', '0.4', '-0.2', '-0.4', '-0.6', '-0.8', '-1');
  $argejala = array();

  for ($i = 0; $i < count($_POST['kondisi']); $i++) {
    $arkondisi = explode("_", $_POST['kondisi'][$i]);
    if (strlen($_POST['kondisi'][$i]) > 1) {
      $argejala += array($arkondisi[0] => $arkondisi[1]);
    }
  }

  $sqlkondisi = mysqli_query($conn, "SELECT * FROM kondisi order by id+0");
  while ($rkondisi = mysqli_fetch_array($sqlkondisi)) {
    $arkondisitext[$rkondisi['id']] = $rkondisi['kondisi'];
  }

  $sqlpkt = mysqli_query($conn, "SELECT * FROM penyakit order by kode_penyakit+0");
  while ($rpkt = mysqli_fetch_array($sqlpkt)) {
    $arpkt[$rpkt['kode_penyakit']] = $rpkt['nama_penyakit'];
    $ardpkt[$rpkt['kode_penyakit']] = $rpkt['det_penyakit'];
    $arspkt[$rpkt['kode_penyakit']] = $rpkt['srn_penyakit'];
    $argpkt[$rpkt['kode_penyakit']] = $rpkt['gambar'];
  }

  $sqlhasil = mysqli_query($conn, "SELECT * FROM hasil where id_hasil=" . $_GET['id']);
  while ($rhasil = mysqli_fetch_array($sqlhasil)) {
    $arpenyakit = unserialize($rhasil['penyakit']);
    $argejala = unserialize($rhasil['gejala']);
  }

  $np1 = 0;
  foreach ($arpenyakit as $key1 => $value1) {
    $np1++;
    $idpkt1[$np1] = $key1;
    $vlpkt1[$np1] = $value1;
  }


  // --------------------- END -------------------------

  echo "<div class='content'>
	<h2 class='text text-primary'>Hasil Diagnosis &nbsp;&nbsp;<button class='no-print' id='print' onClick='printPage();' data-toggle='tooltip' data-placement='right' title='Klik tombol ini untuk mencetak hasil diagnosa'><i class='fa fa-print'></i> Cetak</button> </h2>
		  <hr><table class='table table-bordered table-striped diagnosa'> 
          <th width=8%>No</th>
          <th width=10%>Kode</th>
          <th>Gejala yang dialami (keluhan)</th>
          <th width=20%>Pilihan</th>
          </tr>";
  $ig = 0;
  foreach ($argejala as $key => $value) {
    $kondisi = $value;
    $ig++;
    $gejala = $key;
    $sql4 = mysqli_query($conn, "SELECT * FROM gejala where kode_gejala = '$key'");
    $r4 = mysqli_fetch_array($sql4);
    echo '<tr><td>' . $ig . '</td>';
    echo '<td>G' . str_pad($r4['kode_gejala'], 3, '0', STR_PAD_LEFT) . '</td>';
    echo '<td><span class="hasil text text-primary">' . $r4['nama_gejala'] . "</span></td>";
    echo '<td><div class="kondisipilih" style="color:' . $fontColor[$kondisi] . '; background-color: ' . $arcolor[$kondisi] . '">' . $arkondisitext[$kondisi] . "</div></td></tr>";
  }
  $np = 0;
  foreach ($arpenyakit as $key => $value) {
    $np++;
    $idpkt[$np] = $key;
    $nmpkt[$np] = $arpkt[$key];
    $vlpkt[$np] = $value;
  }
  if ($argpkt[$idpkt[1]]) {
    $gambar = 'gambar/penyakit/' . $argpkt[$idpkt[1]];
  } else {
    $gambar = 'gambar/noimage.png';
  }
  echo "</table><div class='well well-small'><img class='card-img-top img-bordered-sm' style='float:right; margin-left:15px;' src='" . $gambar . "' height=200><h3 class='text text-success'>Hasil Diagnosa</h3>";
  echo "<div class='callout callout-default'>Jenis penyakit yang diderita adalah <b><h3 class='text text-danger'>" . $nmpkt[1] . "</b> / " . round($vlpkt[1], 2) . " % (" . $vlpkt[1] . ")<br></h3>";
  echo "</div></div><div class='box box-info box-solid'><div class='box-header with-border'><h3 class='box-title'>Detail</h3></div><div class='box-body'><h4>";
  echo $ardpkt[$idpkt[1]];
  echo "</h4></div></div>
          <div class='box box-warning box-solid'><div class='box-header with-border'><h3 class='box-title'>Saran</h3></div><div class='box-body'><h4>";
  echo $arspkt[$idpkt[1]];
  echo "</h4></div></div>
          <div class='box box-danger box-solid'><div class='box-header with-border'><h3 class='box-title'>Kemungkinan lain:</h3></div><div class='box-body'><h4>";
  for ($ipl = 2; $ipl < count($idpkt); $ipl++) {
    echo " <h4><i class='fa fa-caret-square-o-right'></i> " . $nmpkt[$ipl] . "</b> / " . round($vlpkt[$ipl], 2) . " % (" . $vlpkt[$ipl] . ")<br></h4>";
  }
  echo "</div></div>
		  </div>";
}
?>

<script>
        function printPage() {
            const content = document.querySelector('.content').innerHTML;
            const printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.open();
            printWindow.document.write(`
                <html>
                <head>
                    <link href="../css/font-awesome-4.2.0/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
  
                    <link rel="stylesheet" href="../assets/AdminLTE.css">
                    <link rel="stylesheet" href="../css/style.css">
                    <title>Print</title>
                    <style>
                      body {
                          margin: 0;
                          padding: 0;
                      }
                      .print-container {
                          page-break-inside: avoid;
                          margin: 0;
                          padding: 0;
                      }
                      .no-print {
                          display: none;
                      }
                      .print-container .tooltip {
                          display: none !important;
                      }

                      .text-left {
                          text-align: left
                      }
                      .text-right {
                          text-align: right
                      }
                      .text-center {
                          text-align: center
                      }
                      .text-justify {
                          text-align: justify
                      }
                      .text-nowrap {
                          white-space: nowrap
                      }
                      .text-lowercase {
                          text-transform: lowercase
                      }
                      .text-uppercase {
                          text-transform: uppercase
                      }
                      .text-capitalize {
                          text-transform: capitalize
                      }
                      .text-muted {
                          color: #777
                      }
                      .text-primary {
                          color: #337ab7
                      }
                      a.text-primary:focus,
                      a.text-primary:hover {
                          color: #286090
                      }
                      .text-success {
                          color: #3c763d
                      }
                      a.text-success:focus,
                      a.text-success:hover {
                          color: #2b542c
                      }
                      .text-info {
                          color: #31708f
                      }
                      a.text-info:focus,
                      a.text-info:hover {
                          color: #245269
                      }
                      .text-warning {
                          color: #8a6d3b
                      }
                      a.text-warning:focus,
                      a.text-warning:hover {
                          color: #66512c
                      }
                      .text-danger {
                          color: #a94442
                      }
                      a.text-danger:focus,
                      a.text-danger:hover {
                          color: #843534
                      }
                      .bg-primary {
                          color: #fff;
                          background-color: #337ab7
                      }
                      a.bg-primary:focus,
                      a.bg-primary:hover {
                          background-color: #286090
                      }
                      .bg-success {
                          background-color: #dff0d8
                      }
                      a.bg-success:focus,
                      a.bg-success:hover {
                          background-color: #c1e2b3
                      }
                      .bg-info {
                          background-color: #d9edf7
                      }
                      a.bg-info:focus,
                      a.bg-info:hover {
                          background-color: #afd9ee
                      }
                      .bg-warning {
                          background-color: #fcf8e3
                      }
                      a.bg-warning:focus,
                      a.bg-warning:hover {
                          background-color: #f7ecb5
                      }
                      .bg-danger {
                          background-color: #f2dede
                      }
                      a.bg-danger:focus,
                      a.bg-danger:hover {
                          background-color: #e4b9b9
                      }
                      .page-header {
                          padding-bottom: 9px;
                          margin: 40px 0 20px;
                          border-bottom: 1px solid #eee
                      }
                    </style>
                </head>
                <body>
                    <div class="print-container">
                        ${content}
                    </div>
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.focus();
            setTimeout(function() {     
              printWindow.print();
            }, 400);
        }
    </script>