<?php echo view('/layout/_header') ?>
<?php echo view('/layout/_navbar') ?>
<div class="page-wrapper">
  <div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col-auto">
          <?php 
                $text = '';
                $txt_class = '';
                $indicator = '';
                if(hari_indo(date('l')) == 'Sabtu' || hari_indo(date('l')) == 'Minggu')
                  {
                    $text = 'Hari Libur';
                    $txt_class = 'text-red';
                    $indicator = 'status-red';
                  } else {
                    $text = 'Hari Kerja';
                    $txt_class = 'text-green';
                    $indicator = 'status-green';
                  }
              ?>
          <span class="status-indicator <?php echo $indicator?> status-indicator-animated">
            <span class="status-indicator-circle"></span>
            <span class="status-indicator-circle"></span>
            <span class="status-indicator-circle"></span>
          </span>
        </div>
        <div class="col">
          <h2 class="page-title">
            e-Presensi Pegawai
          </h2>
          <div class="text-muted">
            <ul class="list-inline list-inline-dots mb-0">
              <li class="list-inline-item"><span class="<?php echo $txt_class?>"><?php echo $text?></span></li>
            </ul>
          </div>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
          <div class="btn-list">
            <a href="#" class="btn btn-indigo d-none d-sm-inline-block" data-bs-toggle="modal"
              data-bs-target="#modal-report">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" /></svg>
              Buat Log Harian
            </a>
            <a href="#" class="btn btn-indigo d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report"
              aria-label="Create new report">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" /></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
        <div class="col-md-6 col-lg-12">
          <div class="card">
            <div class="row row-cards">
              <div class="col-md-6">
                <div class="card-body p-4 text-center">
                  <span class="avatar avatar-xl mb-3 avatar-rounded"
                    style="background-image: url(<?=base_url()?>/assets/static/avatars/avatar-34.png)"></span>
                  <h1 class="m-0 mb-1" id='timestamp'></h1>
                  <div class="text">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                      stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                      <line x1="16" y1="3" x2="16" y2="7"></line>
                      <line x1="8" y1="3" x2="8" y2="7"></line>
                      <line x1="4" y1="11" x2="20" y2="11"></line>
                      <line x1="11" y1="15" x2="12" y2="15"></line>
                      <line x1="12" y1="15" x2="12" y2="18"></line>
                    </svg>
                    <?php echo longdate_indo(date('Y-m-d'));?>
                  </div>
                  <?php if(isset($dataabsen->abs_datang) && $dataabsen->abs_datang == '00:00:00' && $dataabsen->abs_tgl == date('Y-m-d') && $dataabsen->abs_status != 'Hari Libur' && date('H') < 12)
                        {
                        ?>
                  <div class="mt-3">
                    <a style="outline:none" id="btn-datang" table-id='<?php ?>' href="#" class="btn btn-indigo"
                      data-bs-toggle="modal" data-bs-target="#confirm-absen-datang">
                      <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check"
                        width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="12" r="9" />
                        <path d="M9 12l2 2l4 -4" /> </svg>
                      Absen Datang
                    </a>
                  </div>
                  <?php
                        }
                        ?>
                  <?php if(isset($dataabsen->abs_pulang) && $dataabsen->abs_pulang == '00:00:00' && $dataabsen->abs_tgl == date('Y-m-d') && $dataabsen->abs_status != 'Hari Libur' && date('H') > 12)
                        {
                        ?>
                  <div class="mt-3">
                    <a style="outline:none" id="btn-pulang" href="#" class="btn btn-indigo" data-bs-toggle="modal"
                      data-bs-target="#confirm-absen-pulang">
                      <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check"
                        width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="12" r="9" />
                        <path d="M9 12l2 2l4 -4" /> </svg>
                      Absen Pulang
                    </a>
                  </div>
                  <?php
                        }
                        ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card-body p-4 text-center">
                  <div id="chart-status">

                  </div>
                </div>

              </div>
            </div>

            <div class="d-flex">
              <div class="card-btn small">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="44" height="44" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <circle cx="12" cy="12" r="9" />
                  <circle cx="12" cy="10" r="3" />
                  <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /> </svg>
                <?php if(isset($userdata)) {
                          echo $userdata->nama;
                      } ?>
              </div>
              <div class="card-btn small">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="44" height="44" viewBox="0 0 24 24"
                  stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <rect x="3" y="4" width="18" height="16" rx="3" />
                  <circle cx="9" cy="10" r="2" />
                  <line x1="15" y1="8" x2="17" y2="8" />
                  <line x1="15" y1="12" x2="17" y2="12" />
                  <line x1="7" y1="16" x2="17" y2="16" /> </svg>
                <?php if(isset($userdata)) {
                          echo $userdata->pgw_id;
                      } ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-12">
          <div class="card">
            <div class="card-header mb-3">
              <div class="card-title">Log Presensi</div>
            </div>
            <!-- <div class="container">
                    <div class="row row-cards">
                      <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col-auto">
                                <span class="text-white avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">   <path stroke="none" d="M0 0h24v24H0z" fill="none"/>   <circle cx="12" cy="12" r="9" />   <polyline points="12 7 12 12 15 15" /> </svg>
                                </span>
                              </div>
                              <div class="col">
                                <div class="subheader">
                                    Jam Datang
                                </div>
                                <div class="font-weight-medium">
                                  <strong id="jamdatang">
                                  00:00:00
                                  </strong>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col-auto">
                                <span class="avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">   <path stroke="none" d="M0 0h24v24H0z" fill="none"/>   <circle cx="12" cy="12" r="9" />   <polyline points="12 7 12 12 15 15" /> </svg>
                                </span>
                              </div>
                              <div class="col">
                                <div class="subheader">
                                    Jam Pulang
                                </div>
                                <div class="font-weight-medium">
                                  <strong id="jampulang">
                                    00:00:00
                                  </strong>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col-auto">
                                <span class="bg-green-lt text-white avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-briefcase" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">   <path stroke="none" d="M0 0h24v24H0z" fill="none"/>   <rect x="3" y="7" width="18" height="13" rx="2" />   <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />   <line x1="12" y1="12" x2="12" y2="12.01" />   <path d="M3 13a20 20 0 0 0 18 0" /> </svg>
                                </span>
                              </div>
                              <div class="col">
                                <div class="subheader">
                                      Jam Kerja
                                </div>
                                <div class="font-weight-medium">
                                  <strong id="jamkerja"></strong>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col-auto">
                                <span class="avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-briefcase" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">   <path stroke="none" d="M0 0h24v24H0z" fill="none"/>   <rect x="3" y="7" width="18" height="13" rx="2" />   <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />   <line x1="12" y1="12" x2="12" y2="12.01" />   <path d="M3 13a20 20 0 0 0 18 0" /> </svg>
                                </span>
                              </div>
                              <div class="col">
                                <div class="subheader">
                                    Status
                                </div>
                                <div class="font-weight-medium">
                                  <strong id="absenstatus"></strong>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br> -->
            <div class="card-body">
              <div class="datagrid">
                <div class="datagrid-item">
                  <div class="datagrid-title">Tanggal</div>
                  <div class="datagrid-content" id="tglabsen">

                  </div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Nama</div>
                  <div class="datagrid-content">
                    <div class="d-flex align-items-center">
                      <span class="avatar avatar-xs me-2 avatar-rounded"
                        style="background-image: url(<?=base_url()?>/assets/static/avatars/avatar-34.png)"></span>
                      <?php if(isset($userdata)) {
                                echo $userdata->nama;
                            } ?>
                    </div>
                  </div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">NIP/NIK</div>
                  <div class="datagrid-content">
                    <?php if(isset($userdata)) {
                                echo $userdata->pgw_id;
                            } ?>
                  </div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Jam Datang</div>
                  <div class="datagrid-content">
                    <strong id="jamdatang">00:00:00</strong>
                  </div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Jam Pulang</div>
                  <div class="datagrid-content">
                    <strong id="jampulang">00:00:00</strong>
                  </div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Jumlah Jam Kerja</div>
                  <div class="datagrid-content">
                    <strong id="jamkerja">00 Jam 00 Menit</strong>
                  </div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Status</div>
                  <div class="datagrid-content">
                    <span class="status" id="absenstatus">
                      Tanpa Keterangan
                    </span>
                  </div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Status Waktu Presensi</div>
                  <div class="datagrid-content">
                    <span class="status" id="terlambat">
                      Tidak Absen
                    </span>
                  </div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Kegiatan Harian</div>
                  <div class="datagrid-content">
                    <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green" width="24" height="24"
                      viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                      stroke-linejoin="round">
                      <desc>Download more icon variants from https://tabler-icons.io/i/check</desc>
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M5 12l5 5l10 -10"></path>
                    </svg>
                    Melaporkan
                  </div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Keterangan</div>
                  <div class="datagrid-content" id="ket">
                    -
                  </div>
                </div>
                <div class="datagrid-item">
                  <div class="datagrid-title">Lokasi</div>
                  <div class="datagrid-content">
                    <div class="ratio ratio-16x9">
                      <div>
                        <div id="map-absen" class="w-100 h-100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="table-responsive">
                    <table class="table card-table table-striped table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Tanggal</th>
                          <th>Datang</th>
                          <th>Pulang</th>
                          <th>Jam Kerja</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody id="tableAbsen">
                        
                      </tbody>
                    </table>
                  </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php echo view('/layout/_footer') ?>
</div>
</div>
<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buat Laporan Kinerja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6">
            <label class="form-label">Tanggal</label>
            <div class="input-icon mb-3">
              <input class="form-control" placeholder="" id="act-date" value="">
              <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <rect x="4" y="5" width="16" height="16" rx="2" />
                  <line x1="16" y1="3" x2="16" y2="7" />
                  <line x1="8" y1="3" x2="8" y2="7" />
                  <line x1="4" y1="11" x2="20" y2="11" />
                  <line x1="11" y1="15" x2="12" y2="15" />
                  <line x1="12" y1="15" x2="12" y2="18" /></svg>
              </span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="mb-3">
              <label class="form-label">Jumlah Kegiatan</label>
              <input type="number" class="form-control">
            </div>
          </div>
          <div class="col-lg-12">
            <div class="mb-3">
              <label class="form-label">Uraian Kegiatan</label>
              <textarea class="form-control" rows="5"></textarea>
            </div>
          </div>
          <div class="col-lg-12">
            <div>
              <label class="form-label">Output Kegiatan</label>
              <textarea class="form-control" data-bs-toggle="autosize" placeholder=""></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
          Cancel
        </a>
        <a href="#" class="btn btn-indigo ms-auto" data-bs-dismiss="modal">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
            stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <line x1="10" y1="14" x2="21" y2="3"></line>
            <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5"></path>
          </svg>
          Kirim
        </a>
      </div>
    </div>
  </div>
</div>
<div class="modal modal-blur fade" id="confirm-absen-datang" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-status bg-indigo"></div>
      <div class="modal-body text-center py-4">
        <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-indigo icon-lg" width="24" height="24"
          viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <circle cx="12" cy="12" r="9" />
          <path d="M9 12l2 2l4 -4" /></svg>
        <h3>Absen Datang</h3>
        <div class="text-muted">Jam kerja normal 7:30 AM - 16:00 PM</div>
        <form id=addAbsen>
          <div class="form-group">
            <input type="hidden" id="txt_abs_id"
              value="<?php if(isset($dataabsen->abs_id)) {echo $dataabsen->abs_id;}?>">
            <input type="hidden" id="txt_pgw_id" value="<?php echo user()->getpgwId();?>">
            <input type="hidden" id="txt_abs_datang" value="">
            <input type="hidden" id="txt_long" value="">
            <input type="hidden" id="txt_lat" value="">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                Batal
              </a></div>
            <div class="col"><a href="#" id="btn-absen-datang" class="btn btn-indigo w-100">
                Konfirmasi
              </a></div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<div class="modal modal-blur fade" id="confirm-absen-pulang" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-status bg-indigo"></div>
      <div class="modal-body text-center py-4">
        <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-indigo icon-lg" width="24" height="24"
          viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <circle cx="12" cy="12" r="9" />
          <path d="M9 12l2 2l4 -4" /></svg>
        <h3>Absen Pulang</h3>
        <div class="text-muted">Jam kerja normal 7:30 AM - 16:00 PM</div>
        <form id=addAbsen>
          <div class="form-group">
            <input type="hidden" id="txt_abs_id"
              value="<?php if(isset($dataabsen->abs_id)) {echo $dataabsen->abs_id;}?>">
            <input type="hidden" id="txt_pgw_id" value="<?php echo user()->getpgwId();?>">
            <input type="hidden" id="txt_abs_pulang" value="">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col">
              <a href="#" class="btn w-100" data-bs-dismiss="modal">
                Batal
              </a>
            </div>
            <div class="col">
              <a href="#" id="btn-absen-pulang" class="btn btn-indigo w-100">
                Konfirmasi
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
    echo view('/_user/_script/_shome');
    echo view('/layout/_js');
    ?>
</body>

</html>