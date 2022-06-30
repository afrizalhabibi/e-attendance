<?php echo view('/layout/_header') ?>
<?php echo view('/layout/_navbar') ?>

<div class="page-wrapper">
  <div class="container-fluid">
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
    <div class="container-fluid">
    <div class="row row-deck row-cards">
      <div class="col-sm-6 col-lg-4">
        <div class="card">
          <div class="card-body">
          <h3 class="card-title">Status Presensi</h3>
            <div id="chart-status"></div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-8">
        <div class="card">
          <div class="card-body">
            <div id="chart-jamkerja"></div>
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