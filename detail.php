<?php include "header.php"; ?>
<?php
$id = $_GET['id_wisata'];
include_once "ambildata_id.php";
$obj = json_decode($data);
$id_wisata = "";
$nama_wisata = "";
$alamat = "";
$deskripsi = "";
$harga_tiket = "";
$status = "";
$luas = "";
$tahun = "";
$lat = "";
$long = "";
foreach ($obj->results as $item) {
  $id_wisata .= $item->id_wisata;
  $nama_wisata .= $item->nama_wisata;
  $alamat .= $item->alamat;
  $deskripsi .= $item->deskripsi;
  $harga_tiket .= $item->harga_tiket;
  $status .= $item->status;
  $luas .= $item->luas;
  $tahun .= $item->tahun;
  $lat .= $item->latitude;
  $long .= $item->longitude;
}

$title = "Detail dan Lokasi : " . $nama_wisata;
//include_once "header.php"; 

?>

<script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap"></script>

<script>
function initialize() {
    var myLatlng = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $long ?>);
    var mapOptions = {
        zoom: 13,
        center: myLatlng
    };

    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    var contentString = '<div id="content">' +
        '<div id="siteNotice">' +
        '</div>' +
        '<h1 id="firstHeading" class="firstHeading"><?php echo $nama_wisata ?></h1>' +
        '<div id="bodyContent">' +
        '<p><?php echo $alamat ?></p>' +
        '</div>' +
        '</div>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Maps Info',
        icon: 'img/markermap.png'
    });
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
    });
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<!-- start banner Area -->
<section class="about-banner relative">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Detail Informasi Geografis Pertanahan
                </h1>

            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->
<!-- Start about-info Area -->
<section class="about-info-area section-gap">
    <div class="container" style="padding-top: 120px;">
        <div class="row">
            <div class="col-md-7" data-aos="fade-up" data-aos-delay="200">
                <div class="panel panel-info panel-dashboard">
                    <div class="panel-heading centered">
                        <h2 class="panel-title"><strong>Informasi Data Pertanahan </strong></h4>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <!-- <th>Item</th> -->
                                <th>Detail</th>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>
                                    <h5><?php echo $nama_wisata ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>
                                    <h5><?php echo $alamat ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>Peruntukan</td>
                                <td>
                                    <h5><?php echo $deskripsi ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>No Sertifikat</td>
                                <td>
                                    <h5><?php echo $harga_tiket ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <h5><?php echo $status ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>Luas</td>
                                <td>
                                    <h5><?php echo $luas ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>Tahun</td>
                                <td>
                                    <h5><?php echo $tahun ?></h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-5" data-aos="zoom-in">
                <div class="panel panel-info panel-dashboard">
                    <div class="panel-heading centered">
                        <h2 class="panel-title"><strong>Lokasi</strong></h4>
                    </div>
                    <div class="card shadow mb-4 p-4">
                        <div id="map" style="width: 100%; height: 600px"></div>
                    </div>
                </div>
            </div>
</section>
<script src="peta.js"></script>
<!-- End about-info Area -->
<?php include "footer.php"; ?>