<?php
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$nama = $_POST['nama_wisata'];
$alamat = $_POST['alamat'];
$deskripsi = $_POST['deskripsi'];
$harga_tiket = $_POST['harga_tiket'];
$status = $_POST['status'];
$luas = $_POST['luas'];
$tahun = $_POST['tahun'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// menginput data ke database
mysqli_query($koneksi, "insert into wisata values('','$nama','$alamat','$deskripsi','$harga_tiket','$status','$luas','$tahun','$latitude','$longitude')");

// mengalihkan halaman kembali ke index.php
header("location:tampil_data.php");
