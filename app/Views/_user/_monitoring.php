<?php echo view('/layout/_header') ?>
<?php echo view('/layout/_navbar_dark') ?>

<div class="page-wrapper">
  <div class="container-xl">
    <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
          Monitoring
        </div>
        <h2 class="page-title">
          Dashboard
        </h2>
      </div>
      <!-- Page title actions -->
    </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
    <div class="row row-deck row-cards">
      <div class="col-sm-12 col-lg-4">
        <div class="card">
          <div class="card-body">
          <div class="d-flex">
            <h3 class="card-title">Status Presensi</h3>
            
            <div class="ms-auto">
              <div class="dropdown">
                <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter</a>
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item" href="#" id="btnfilterBulan">Per Bulan <?php echo bulan(date('m')); ?></a>
                  <a class="dropdown-item" href="#" id="btnfilterTahun">Per Tahun <?php echo date('Y'); ?></a>
                </div>
              </div>
            </div>
          </div>
          
            <div id="chart-status"></div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-lg-8">
        <div class="card">
          <div class="card-body">
          <h3 class="card-title">Jam Kerja</h3>
            <div id="chart-jamkerja"></div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-lg-8">
        <div class="card">
          <div class="card-body">
          <div class="d-flex">
            <h3 class="card-title">Jumlah Kegiatan</h3>
            <div class="ms-auto">
              <div class="dropdown">
                <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter</a>
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item" href="#" id="btnfilterkinerjaBulan">Per Bulan <?php echo bulan(date('m')); ?></a>
                  <a class="dropdown-item" href="#" id="btnfilterkinerjaTahun">Per Tahun</a>
                </div>
              </div>
            </div>
          </div>
          
            <div id="chart-kinerja"></div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-lg-4">
        <div class="card">
          <div class="card-body">
          <h3 class="card-title">Jam Kerja</h3>
            <div id="chart-status2"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
        <?php echo view('/layout/_footer')?>
      </div>
    </div>
    <?php 
    echo view('/layout/_js');
    echo view('/_user/_script/_smonitoring');
    ?>
  </body>
</html>