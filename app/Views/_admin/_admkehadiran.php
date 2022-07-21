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
          Record
        </div>
        <h2 class="page-title">
          Data Presensi
        </h2>
      </div>
      <!-- Page title actions -->
    </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                <div class="w-100">
              <div class="row">
                <div class="col">
                <!-- <h3 class="card-title">Record Kehadiran</h3> -->
                </div>
                <div class="col">
                  <div class="row">
                    <div class="col mb-2">
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
                    <div class="col-md-6">
                    <div class="input-icon mb-3">
                      <input type="text" value="" class="form-control" id="newSearch" placeholder="Cari…">
                      <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><desc>Download more icon variants from https://tabler-icons.io/i/search</desc><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                      </span>
                    </div>
                  </div>
                  </div>
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
                <input class="form-control" placeholder="Pilih tanggal"  id="date-val" value="" autocomplete="off"/>
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                </span>
              </div>
            </div>
            <div class="col-md-3">
              <select type="text" class="form-select mb-3"  placeholder="Pilih Homebase" id="filterHomebase" value="">
                <option value>Semua Homebase</option>
                <?php foreach($homebase as $hmb) :?>
                <option value="<?php echo $hmb['hmb_id']?>"><?php echo $hmb['hmb_name']?></option>
                <?php endforeach ?>
              </select>
              <!-- <select class="form-select mb-3" id="filterStatus">
                <option value>Semua Homebase</option>

              </select> -->
            </div>

            <div class="col-md-3">
              <select class="form-select mb-3" id="filterStatus">
                <option value>Semua Status</option>
                <?php foreach($status as $st) :?>
                <option value="<?php echo $st['abs_status']?>"><?php echo $st['abs_status']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="col-md-3">
            <div class="w-100">
              <div class="row">
                <div class="col">
                <a class="btn btn-outline-blue w-100" id="btnfilter">
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
                      <th>Nama</th>
                      <th>Homebase</th>
                      <th>Jabatan</th>
                      <th>Status Pegawai</th>
                      <th>Jam Datang</th>
                      <th>Jam Pulang</th>
                      <th>Total Jam Kerja</th>
                      <th>Status</th>
                      <th>Laporan Kegiatan</th>
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
    echo view('/_admin/_script/_sadmin_presensi');
    ?>
    
    <div class="modal modal-blur fade" id="modal-absdetails" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail Presensi</h5>
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
                  <span class="avatar avatar-xs me-2 avatar-rounded" style="background-image: url(<?=base_url()?>/assets/static/avatars/avatar-14.png)"></span>
                  <div id="absdetailsname">-</div>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="subheader mb-2">NIP/NIK</div>
              <div id="idpeg">-</div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="subheader mb-2">Jam Datang</div>
              <strong id="jamdatang">00:00:00</strong>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="subheader mb-2">Jam Pulang</div>
              <strong id="jampulang">00:00:00</strong>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="subheader mb-2">Jumlah Jam Kerja</div>
              <strong id="jamkerja">00 Jam 00 Menit</strong>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="subheader mb-2">Status</div>
              <div id="absenstatus"></div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="subheader mb-2">Kegiatan Harian</div>
              <div id="kegiatan"></div>
            </div>

            <div class="col-md-4 col-sm-6">
              <div class="subheader mb-2">Keterangan</div>
                <div id="ket">-</div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="subheader mb-2">Foto</div>
              <div class="ratio ratio-4x3 object-cover" id="img-presensi"></div>
            </div>
          </div>
          </div> <!--end modal body -->
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal modal-blur fade" id="modal-absedit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Presensi Pegawai</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form role="form" class="validator-edit" method="POST" id="ajaxPresensi" accept-charset="utf-8">
            <div class="row">
            <input id="frm_abs_id" type="hidden" value="">
              <div class="col-lg-4 form-group">
                <label class="form-label">Tanggal</label>
                <div class="input-icon mb-3">
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
                  <input type="text" readonly autocomplete="off" class="form-control" placeholder="" id="frm_abs_tgl" title=" " value="" required>
                </div>
              </div>
              <div class="col-lg-8 form-group">
                <div class="mb-3">
                  <label class="form-label">Nama</label>
                  <input id="frm_abs_nama" type="text" readonly title=" " class="form-control" required>
                </div>
              </div>
              <div class="col-lg-4 form-group">
                <div class="mb-3">
                  <label class="form-label">NIP/NIK</label>
                  <input type="text" readonly id="frm_abs_pgwid" name="frm_abs_pgwid" class="form-control" required>
                </div>
              </div>
              <div class="col-lg-4 form-group">
                <div class="mb-3">
                  <label class="form-label">Jam Datang</label>
                  <input type="time" step="1" id="frm_abs_jamdatang" class="form-control" required>
                </div>
              </div>
              <div class="col-lg-4 form-group">
                <div class="mb-3">
                  <label class="form-label">Jam Pulang</label>
                  <input type="time" step="1" id="frm_abs_jampulang" class="form-control" pattern="([1]?[0-9]|2[0-3]):[0-5][0-9]" required>
                </div>
              </div>
              <div class="col-lg-4 form-group">
                <div class="mb-3">
                <label class="form-label">Status Presensi</label>
                  <select id="frm_abs_status" class="form-select">
                    <option value="Cuti">Cuti</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Bekerja">Bekerja</option>
                    <option value="Dinas Luar">Dinas Luar</option>
                    <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                    <option value="Hari Libur">Hari Libur</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-8 form-group">
                <div class="mb-3">
                <label class="form-label">Keterangan</label>
                  <textarea id="frm_abs_ket" class="form-control" required></textarea>
                </div>
              </div>
              </div>
            </div>
            </form>
            <div class="modal-footer">
            <button type="submit" id="btn-absedit-send" class="btn btn-blue ms-auto w-100">
                Kirim
            </button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>