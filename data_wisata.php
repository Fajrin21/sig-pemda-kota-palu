<?php include "header.php"; ?>
<!-- start banner Area -->
<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class=" align-items-center text-center" style="margin-top: 28px;">
        <div>
          <h2 data-aos="fade-up">Data Pemetaan Tanah </h2>
          <h3 data-aos="fade-up" data-aos-delay="100">Pemda Kota Palu</h3>
        </div>
      </div>
    </div>
  </section><!-- End Hero Section -->
<!-- End banner Area -->
<!-- Start about-info Area -->
<section class="about-info-area section-gap ">
  <div class="container ">
    <div class="row align-items-center">
      <div class="col-lg-6 info-left">
        <img class="img-fluid" src="img/about/info-img.jpg" alt="">
      </div>

      <div class="col-lg-30 into-right" data-aos="fade-up" data-aos-delay="100">

        <div class="col-md-12">
          <div class="panel panel-info panel-dashboard">
            <div class="panel-heading centered">

            </div>
            <div class="panel-body">
              <table class="table table-bordered table-striped table-admin">
                <thead>
                  <tr>
                    <th width="5%">No.</th>
                    <th width="30%">Lokasi</th>
                    <th width="30%">Alamat</th>
                    <th width="20%">Peruntukan</th>
                    <th width="20%">No Sertifikat</th>
                    <th width="20%">Status</th>
                    <th width="20%">Luas</th>
                    <th width="20%">Tahun</th>
                  </tr>
                </thead>
              <div class="col-lg-6 order-2 order-lg-1 d-flex flex-row justify-content-center mb-4">
                <form action="#" class="form-search flex items-center mb-3" data-aos="fade-up" data-aos-delay="200">
                    <input type="text" class="form-control mr-2" placeholder="Cari berdasarkan alamat">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
              </div>
              
              <?php
              // Include file koneksi.php untuk mendapatkan koneksi ke database
              include "koneksi.php";

              // Fungsi algoritma brute force untuk pencarian berdasarkan kolom alamat
              function bruteForce($search, $data) {
                  $matches = [];
                  foreach ($data as $row) {
                      // Menggunakan strpos untuk mencocokkan bagian dari alamat dengan pencarian (case-insensitive)
                      if (stripos($row['alamat'], $search) !== false) {
                          $matches[] = $row;
                      }
                  }
                  return $matches;
              }

              // Query data dari database
              $data = [];
              $query = "SELECT * FROM wisata";
              $result = mysqli_query($koneksi, $query);

              // Mengambil hasil query ke dalam array
              while ($row = mysqli_fetch_assoc($result)) {
                  $data[] = $row;
              }

              // Pengecekan apakah ada parameter pencarian yang diberikan
              if (isset($_GET['search'])) {
                  $search = $_GET['search'];
                  // Memanggil fungsi brute force untuk mencari data berdasarkan alamat
                  $searchResult = bruteForce($search, $data);
              } else {
                  // Jika tidak ada parameter pencarian, tampilkan semua data
                  $searchResult = $data;
              }

              // Menutup koneksi
              mysqli_close($koneksi);
              ?>
              

                <tbody> 
                  <?php
                  $data = file_get_contents('http://localhost/SIG-WISATA/ambildata.php');
                  $no = 1;
                  if (json_decode($data, true)) {
                    $obj = json_decode($data);
                    foreach ($obj->results as $item) {
                  ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $item->nama_wisata; ?></td>
                        <td><?php echo $item->alamat; ?></td>
                        <td> <?php echo $item->deskripsi; ?></td>
                        <td> <?php echo $item->harga_tiket; ?></td>
                        <td> <?php echo $item->status; ?></td>
                        <td> <?php echo $item->luas; ?></td>
                        <td> <?php echo $item->tahun; ?></td>
                        <td class="ctr">
                          <div class="btn-group">
                            <a href="detail.php?id_wisata=<?php echo $item->id_wisata; ?>" rel="tooltip" data-original-title="Lihat File" data-placement="top" class="btn btn-primary">
                              <i class="fa fa-map-marker"> </i> Detail dan Lokasi</a>&nbsp;
                          </div>
                        </td>
                      </tr>
                  <?php $no++;
                    }
                  } else {
                    echo "data tidak ada.";
                  } ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<!-- End about-info Area -->
<?php include "footer.php"; ?>