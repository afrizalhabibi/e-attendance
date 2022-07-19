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
          Data Kinerja <?php echo $userdata->hmb_name ?>
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
            <div class="col-md-4">
              <div class="input-icon mb-3">
                <input type="text" value="" class="form-control" id="newSearch" placeholder="Cari…">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><desc>Download more icon variants from https://tabler-icons.io/i/search</desc><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                </span>
              </div>
            </div>
 
            <div class="col-md-4">
              <div class="input-icon mb-3">
                <input class="form-control" placeholder="Pilih tanggal"  id="date-val" value=""/>
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                </span>
              </div>
            </div>
            
            <div class="col-md-4">
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
              <table id="tb_kinerja" class="table card-table table-vcenter text-nowrap datatable" style="width: 100%;">
                <thead>
                  <tr>
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>Jumlah</th>
                      <th>Uraian</th>
                      <th>Output</th>
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
    echo view('/_pimpinan/_script/_skinerja_homebase');
    ?>
   
    
    <div class="modal modal-blur fade" id="modal-actdetails" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail Kehadiran</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="row row-cards">
            <div class="col-md-6 col-sm-6">
              <div class="subheader mb-2">Tanggal</div>
              <div id="detailsdate">-</div>
            </div>
            <div class="col-md-6">
              <div class="subheader mb-2">Jumlah Kegiatan</div>
              <div id="detailsjumlah">-</div>
            </div>
            <div class="col-md-12">
              <div class="subheader mb-2">Uraian Kegiatan</div>
                <div id="detailsket">-</div>
            </div>
            <div class="col-md-12">
              <div class="subheader mb-2">Output</div>
              <div id="detailsoutput">-</div> 
            </div>
          </div>
          </div> <!--end modal body -->
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
    <!-- edit -->
    <div class="modal modal-blur fade" id="modal-actedit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Buat Laporan Kegiatan Harian</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form role="form" class="validator-edit" method="POST" id="ajaxKinerja" accept-charset="utf-8">
            <div class="row">
            <input id="frm_act_id" type="hidden" value="">
              <div class="col-lg-6 form-group">
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
                  <input type="text" readonly autocomplete="off" class="form-control" placeholder="" id="frm_act_tgl" title=" " value="" required>
                </div>
                
              </div>
              <div class="col-lg-6 form-group">
                <div class="mb-3">
                  <label class="form-label">Jumlah Kegiatan</label>
                  <input id="frm_act_qty" type="number" title=" " onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'" pattern="[1-9]" min="1" class="form-control" required>
                </div>
              </div>
              <div class="col-lg-12 form-group">
                <div class="mb-3">
                  <label class="form-label">Uraian Kegiatan</label>
                  <textarea id="frm_act_ket" name="frm_act_ket" data-v-message="Tidak boleh kosong"  class="form-control" rows="5" required></textarea>
                </div>
              </div>
              <div class="col-lg-12 form-group">
                <div>
                  <label class="form-label">Output Kegiatan</label>
                  <!-- <textarea id="frm_act_output" data-role="tagsinput" data-v-message="Tidak boleh kosong" class="form-control" data-bs-toggle="autosize" placeholder="" value="" required></textarea> -->
                  <input type="text" data-role="tagsinput" id="frm_act_output" data-v-message="Tidak boleh kosong" class="form-control" required></input>
                </div>
              </div>
              </div>
            </div>
            </form>
            <div class="modal-footer">
            <button class="btn btn-outline" data-bs-dismiss="modal">
                Batal
            </button>
            <button type="submit" id="btn-actedit-send" class="btn btn-blue ms-auto">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <line x1="12" y1="5" x2="12" y2="19" />
              <line x1="5" y1="12" x2="19" y2="12" />
              </svg>
                Kirim
            </button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>