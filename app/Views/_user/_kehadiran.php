<?php echo view('/layout/_header') ?>
<?php echo view('/layout/_navbar') ?>

<div class="page-wrapper">
  <div class="container-xl">
    <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
          Record
        </div>
        <h2 class="page-title">
          Data Kehadiran
        </h2>
      </div>
      <!-- Page title actions -->
    </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
      <!-- <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
              <div class="card-title subheader">Bekerja</div>
              </div>
              <div class="d-flex align-items-baseline">
                <div class="me-3 mb-3">
                  <span class="bg-green-lt text-white avatar">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-briefcase" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path>    <rect x="3" y="7" width="18" height="13" rx="2"></rect>    <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2"></path>    <line x1="12" y1="12" x2="12" y2="12.01"></line>    <path d="M3 13a20 20 0 0 0 18 0"></path> </svg>
                  </span>
                </div>
                <div class="mb-1 me-2">
                <h1><?php echo $countbekerja + $countWFH ?></h1>
                </div>
                <div class="me-auto">
                  <span class="d-inline-flex align-items-center lh-1">
                    Hari
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
              <div class="card-title subheader">Tanpa Keterangan</div>
              </div>
              <div class="d-flex align-items-baseline">
                <div class="me-3 mb-3">
                  <span class="bg-red-lt text-white avatar">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-question-mark" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path>    <path d="M8 8a3.5 3 0 0 1 3.5 -3h1a3.5 3 0 0 1 3.5 3a3 3 0 0 1 -2 3a3 4 0 0 0 -2 4"></path><line x1="12" y1="19" x2="12" y2="19.01"></line> </svg>
                  </span>
                </div>
                <div class="mb-1 me-2">
                  <h1><?php echo $counttanpaket ?></h1>
                </div>
                <div class="me-auto">
                  <span class="d-inline-flex align-items-center lh-1">
                    Hari
                  </span>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
              <div class="card-title subheader">Cuti</div>
              </div>
              <div class="d-flex align-items-baseline">
                <div class="me-3 mb-3">
                  <span class="bg-yellow-lt text-white avatar">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path>    <path d="M19.823 19.824a2 2 0 0 1 -1.823 1.176h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 1.175 -1.823m3.825 -.177h9a2 2 0 0 1 2 2v9"></path>    <line x1="16" y1="3" x2="16" y2="7"></line>    <line x1="8" y1="3" x2="8" y2="4"></line>    <path d="M4 11h7m4 0h5"></path>    <line x1="11" y1="15" x2="12" y2="15"></line>    <line x1="12" y1="15" x2="12" y2="18"></line>    <line x1="3" y1="3" x2="21" y2="21"></line> </svg>
                  </span>
                </div>
                <div class="mb-1 me-2">
                  <h1><?php echo $countcuti ?></h1>
                </div>
                <div class="me-auto">
                  <span class="d-inline-flex align-items-center lh-1">
                    Hari
                  </span>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
              <div class="card-title subheader">Dinas Luar</div>
              </div>
              <div class="d-flex align-items-baseline">
                <div class="me-3 mb-3">
                  <span class="bg-indigo-lt text-white avatar">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-transfer-out" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">   <path stroke="none" d="M0 0h24v24H0z" fill="none"/>   <path d="M4 19v2h16v-14l-8 -4l-8 4v2" />   <path d="M13 14h-9" />   <path d="M7 11l-3 3l3 3" /> </svg>
                  </span>
                </div>
                <div class="mb-1 me-2">
                  <h1><?php echo $countDL ?></h1>
                </div>
                <div class="me-auto">
                  <span class="d-inline-flex align-items-center lh-1">
                    Hari
                  </span>
                </div>
              </div>
            </div>
          </div>
      </div> -->
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                <div class="w-100">
              <div class="row">
                <div class="col">
                <h3 class="card-title">Record Kehadiran</h3>
                </div>
                <div class="col">
                  <button class="btn float-end" id="_exportXLS">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M19 18a3.5 3.5 0 0 0 0 -7h-1a5 4.5 0 0 0 -11 -2a4.6 4.4 0 0 0 -2.1 8.4"></path>
                    <line x1="12" y1="13" x2="12" y2="22"></line>
                    <polyline points="9 19 12 22 15 19"></polyline>
                  </svg>
                      Download XLS
                  </button>
                  
                </div>
              </div>
            </div>
                </div>
                <div class="card-body border-bottom py-3">
                <div class="col-sm-12 col-lg-12">
                <div class="card">
            <div class="card-body" style="display: inline-flex;">
            <div class="row row-cards">
            <div class="col-md-3">
              <div class="input-icon mb-3">
                <input type="text" value="" class="form-control" id="newSearch" placeholder="Cari…">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><desc>Download more icon variants from https://tabler-icons.io/i/search</desc><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                </span>
              </div>
            </div>
 
            <div class="col-md-3">
              <div class="input-icon mb-3">
                <input class="form-control" placeholder="Pilih tanggal"  id="date-val" value=""/>
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                </span>
              </div>
            </div>
            <div class="col-md-3">
              <select class="form-select mb-3" id="filterStatus">
              <option value>Semua Status</option>
                <?php foreach($status as $st) { ?>
              <option value="<?php echo $st['abs_status']?>"><?php echo $st['abs_status']?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-3">
            <div class="w-100">
              <div class="row">
                <div class="col">
                <a class="btn btn-outline w-100" id="btnfilter">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M5.5 5h13a1 1 0 0 1 .5 1.5l-5 5.5l0 7l-4 -3l0 -4l-5 -5.5a1 1 0 0 1 .5 -1.5"></path>
                </svg>
                      Filter
                </a>
                </div>
                <div class="col">
                <a class="btn btn-outline w-100" id="btnreset">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <line x1="3" y1="3" x2="21" y2="21"></line>
                  <path d="M9 5h9.5a1 1 0 0 1 .5 1.5l-4.049 4.454m-.951 3.046v5l-4 -3v-4l-5 -5.5a1 1 0 0 1 .18 -1.316"></path>
                </svg>
                      Reset
                </a>
                </div>
              </div>
            </div>
            </div>

            </div>
            
                
            </div>
            </div>
            </div>
            <div class="table-responsive">
              <table id="tb_kehadiran" class="table card-table table-vcenter text-nowrap datatable" style="width: 100%;">
                <thead>
                  <tr>
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Jam Datang</th>
                      <th>Jam Pulang</th>
                      <th>Total Jam Kerja</th>
                      <th>Status</th>
                      <th>Keterangan</th>
                      <th></th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            </div>
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
    echo view('/_user/_script/_skehadiran');
    ?>
    <div class="modal modal-blur fade" id="modal-absdetails" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail Kehadiran</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="row row-cards">
            <div class="col-md-4 col-sm-6">
              <div class="subheader mb-2">Tanggal</div>
              <div id="absdetailsdate">-</div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="subheader mb-2">Nama</div>
              <div class="d-flex align-items-center">
                  <span class="avatar avatar-xs me-2 avatar-rounded" style="background-image: url(<?=base_url()?>/assets/static/avatars/profile.JPG)"></span>
                  <div id="absdetailsname">-</div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="subheader mb-2">NIP/NIK</div>
              <div id="idpeg">-</div>
            </div>
            <div class="col-md-4">
              <div class="subheader mb-2">Jam Datang</div>
              <strong id="jamdatang">00:00:00</strong>
            </div>
            <div class="col-md-4">
              <div class="subheader mb-2">Jam Pulang</div>
              <strong id="jampulang">00:00:00</strong>
            </div>
            <div class="col-md-4">
              <div class="subheader mb-2">Jumlah Jam Kerja</div>
              <strong id="jamkerja">00 Jam 00 Menit</strong>
            </div>
            <div class="col-md-4">
              <div class="subheader mb-2">Status</div>
              <span id="absenstatus" class="status ">
                -
              </span>
            </div>
            <div class="col-md-4">
              <div class="subheader mb-2">Kegiatan Harian</div>
              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><desc>Download more icon variants from https://tabler-icons.io/i/check</desc><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
              Melaporkan
            </div>
            <div class="col-md-4">
              <div class="subheader mb-2">Keterangan</div>
                <div id="ket">-</div>
            </div>
            <div class="col-md-4">
              <div class="subheader mb-2">Lokasi</div>
            </div>
          </div>
          </div> <!--end modal body -->
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>