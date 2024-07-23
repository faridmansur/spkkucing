<?php
switch ($module) {
	case "":
		include "modul/welcome.php";
		break;
	case "tentang":
		include "modul/tentang.php";
		break;
	case "bantuan":
		include "modul/bantuan.php";
		break;
	case "harga":
		include "modul/harga.php";
		break;
	case "diagnosa":
		include "modul/diagnosa/diagnosa.php";
		break;
	case "penyakit":
		include "modul/penyakit/penyakit.php";
		break;
	case "post":
		include "modul/post/post.php";
		break;
	case "admin":
		include "modul/admin/admin.php";
		break;
	case "gejala":
		include "modul/gejala/gejala.php";
		break;
	case "pengetahuan":
		include "modul/pengetahuan/pengetahuan.php";
		break;
	case "password":
		include "modul/password/password.php";
		break;
	case "keterangan":
		include "modul/keterangan.php";
		break;
	case "riwayat":
		include "modul/riwayat/riwayat.php";
		break;
	case "riwayat-detail":
		include "modul/riwayat/detail.php";
		break;
	case "formlogin":
		include "modul/formlogin.php";
		break;
}