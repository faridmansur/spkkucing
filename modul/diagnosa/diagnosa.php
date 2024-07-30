<title>Diagnosa - D'Cat Care</title>
<?php
switch ($_GET['act']) {

  default:
    if ($_POST['submit']) {

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

      //print_r($arkondisitext);
// -------- perhitungan certainty factor (CF) ---------
// --------------------- START ------------------------
      $sqlpenyakit = mysqli_query($conn, "SELECT * FROM penyakit order by kode_penyakit");
      $arpenyakit = array();
      while ($rpenyakit = mysqli_fetch_array($sqlpenyakit)) {
        $cftotal_temp = 0;
        $cf = 0;
        $sqlgejala = mysqli_query($conn, "SELECT * FROM basis_pengetahuan where kode_penyakit=$rpenyakit[kode_penyakit]");
        $cflama = 0;
        while ($rgejala = mysqli_fetch_array($sqlgejala)) {
          $arkondisi = explode("_", $_POST['kondisi'][0]);
          $gejala = $arkondisi[0];

          for ($i = 0; $i < count($_POST['kondisi']); $i++) {
            $arkondisi = explode("_", $_POST['kondisi'][$i]);
            $gejala = $arkondisi[0];
            if ($rgejala['kode_gejala'] == $gejala) {
              $cf = ($rgejala['mb'] - $rgejala['md']) * $arbobot[$arkondisi[1]];
              if (($cf >= 0) && ($cf * $cflama >= 0)) {
                $cflama = $cflama + ($cf * (1 - $cflama));
              }
              if ($cf * $cflama < 0) {
                $cflama = ($cflama + $cf) / (1 - Math . Min(Math . abs($cflama), Math . abs($cf)));
              }
              if (($cf < 0) && ($cf * $cflama >= 0)) {
                $cflama = $cflama + ($cf * (1 + $cflama));
              }
            }
          }
        }
        if ($cflama > 0) {
          $arpenyakit += array($rpenyakit['kode_penyakit'] => number_format($cflama, 4));
        }
      }

      arsort($arpenyakit);

      $inpgejala = serialize($argejala);
      $inppenyakit = serialize($arpenyakit);

      $np1 = 0;
      foreach ($arpenyakit as $key1 => $value1) {
        $np1++;
        $idpkt1[$np1] = $key1;
        $vlpkt1[$np1] = $value1;
      }

      mysqli_query($conn, "INSERT INTO hasil(
                  tanggal,
                  gejala,
                  penyakit,
                  hasil_id,
                  hasil_nilai
				  ) 
	        VALUES(
                '$inptanggal',
                '$inpgejala',
                '$inppenyakit',
                '$idpkt1[1]',
                '$vlpkt1[1]'
				)");
      // --------------------- END -------------------------

      echo "<div class='content'>
	<h2 class='text text-primary'>Hasil Diagnosis &nbsp;&nbsp;
  <button class='no-print' id='print' onClick='printPage();' data-toggle='tooltip' data-placement='right' title='Klik tombol ini untuk mencetak hasil diagnosa'>
  <i class='fa fa-print'></i> Cetak</button>
  </h2>
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
        echo '<td><span class="hasil text text-primary">' . $r4[nama_gejala] . "</span></td>";
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
      echo "</table><div class='well well-small'><img class='card-img-top img-bordered-sm' style='float:right; margin-left:15px;' src='" . $gambar . "' height=200><h2 class='text text-success'>Hasil Diagnosa</h2>";
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
    } else {
      echo "
	      <h2 class='text text-primary'>Diagnosa Penyakit</h2>  <hr>
	          <div class='alert alert-warning alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
              <h4><i class='icon fa fa-exclamation-triangle'></i>Perhatian !</h4>
              Silahkan memilih gejala sesuai dengan kondisi ayam anda, anda dapat memilih kepastian kondisi ayam dari pasti tidak sampai pasti ya, jika sudah tekan tombol proses (<i class='fa fa-search-plus'></i>)  di bawah untuk melihat hasil.
            </div>

            <div style='padding: 16px 0; float:right'>
            Filter :  <input type=text name='keyword' style='margin-left: 10px;' placeholder='Cari Diagnose.... ' class='form-control' value='' id='searchDiagnose'/>
            </div>

            <form name=text_form method=POST action='diagnosa' >
              <table class='table table-bordered table-striped konsultasi'>
              <thead>
              <tr><th>No</th><th>Kode</th><th>Gejala</th><th width='20%'>Pilih Kondisi</th></tr>
              </thead>
              <tbody class='pilihkondisi' id='listKondisi'>";

      $sql3 = mysqli_query($conn, "SELECT * FROM gejala order by kode_gejala");
      $i = 0;
      while ($r3 = mysqli_fetch_array($sql3)) {
        $i++;
        echo "<tr id='data_ke_$r3[kode_gejala]'><td class=opsi>$i</td>";
        echo "<td class=opsi>G" . str_pad($r3['kode_gejala'], 3, '0', STR_PAD_LEFT) . "</td>";
        echo "<td class=gejala>$r3[nama_gejala]</td>";
        echo '<td class="opsi"><select name="kondisi[]" id="sl' . $i . '" class="opsikondisi"/><option data-id="0" value="0">Pilih jika sesuai</option>';
        $s = "select * from kondisi order by id";

        include "config/koneksi.php";
        $q = mysqli_query($conn, $s) or die($s);
        while ($rw = mysqli_fetch_array($q)) {
          ?>
          <option data-id="<?php echo $rw['id']; ?>" value="<?php echo $r3['kode_gejala'] . '_' . $rw['id']; ?>">
            <?php echo $rw['kondisi']; ?>
          </option>
          <?php
        }
        echo '</select></td>';
        ?>
        <script type="text/javascript">


          $(document).ready(function () {

            var arcolor = new Array('#ffebee', '#b71c1c', '#c62828', '#d32f2f', '#e53935', '#f44336', '#ef5350', '#e57373', '#ef9a9a', '#ffcdd2');
            var fontColor = new Array('#000000', '#ffffff', '#ffffff', '#ffffff', '#ffffff', '#000000', '#000000', '#000000', '#000000', '#000000');
            setColor();
            $('.pilihkondisi').on('change', 'tr td select#sl<?php echo $i; ?>', function () {
              setColor();
            });
            function setColor() {
              var selectedItem = $('tr td select#sl<?php echo $i; ?> :selected');
              var color = arcolor[selectedItem.data("id")];
              $('tr td select#sl<?php echo $i; ?>.opsikondisi').css('background-color', color);
              $('tr td select#sl<?php echo $i; ?>.opsikondisi').css('color', fontColor[selectedItem.data("id")]);
            }
          });
        </script>
        <?php
        echo "</tr>";
      }
      echo "
		  <input class='float' type=submit data-toggle='tooltip' data-placement='top' title='Klik disini untuk melihat hasil diagnosa' name=submit value='&#xf00e;' style='font-family:Arial, FontAwesome'>
          </tbody></table></form>";
    }
    break;
} ?>
<script>
  document.getElementById('searchDiagnose').addEventListener('keyup', function () {
    const filterValue = this.value.toLowerCase();
    const items = document.querySelectorAll('#listKondisi tr td.gejala');

    items.forEach(function (item) {
      if (item.textContent.toLowerCase().indexOf(filterValue) > -1) {
        item.parentElement.classList.remove('hidden');
      } else {
        item.parentElement.classList.add('hidden');
      }
    });
  });

  function printPage() {
    const content = document.querySelector('.content').innerHTML;
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.open();
    printWindow.document.write(`
                <html>
                <head>
                    <link href="./css/font-awesome-4.2.0/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
  
                    <link rel="stylesheet" href="./assets/AdminLTE.css">
                    <link rel="stylesheet" href="./css/style.css">
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
    setTimeout(function () {
      printWindow.print();
    }, 400);
  }
</script>