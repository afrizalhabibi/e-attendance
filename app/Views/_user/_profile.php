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
          Profil
        </div>
        <h2 class="page-title">
        Update Profil
        </h2>
      </div>
      <!-- Page title actions -->
    </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
    <div class="row row-deck row-cards">
      <div class="col-sm-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mb-3 row">
                            <label class="form-label mb-3">Foto</label>
                            <div class="col text-center">
                                <div class="mb-3">
                                    <!-- <span class="profilepic profilepic__image avatar avatar-xl avatar-rounded" style="background-image: url(/assets/static/avatars/profile.jpg)">
                                    <div class="profilepic__content">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-tabler icon-tabler-camera" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2"></path> <circle cx="12" cy="13" r="3"></circle> </svg>
                                        <span class="profilepic__text">Ubah Foto</span>
                                    </div>
                                    </span> -->
                                    <div class="container-profile">
                                    <div class="outer avatar" style="background-image: url(/assets/static/avatars/avatar-14.png)">
                                        <div class="inner">
                                        <input class="inputfile" type="file" name="pic" accept="image/*">
                                        <label>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera" width="20" height="17" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2"></path> <circle cx="12" cy="13" r="3"></circle> </svg>
                                        </label>
                                        </div>
                                    </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floating-nama" placeholder="Nama Lengkap" autocomplete="off">
                            <label for="floating-nama">Nama Lengkap</label>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label mb-3">Jenis Kelamin</label>
                            <div>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" id="rdLaki" name="radJK" type="radio" value="Laki-laki">
                                <span class="form-check-label">Laki-laki</span>
                              </label>
                              <label class="form-check form-check-inline">
                                <input class="form-check-input" id="rdPer" name="radJK" type="radio" value="Perempuan">
                                <span class="form-check-label">Perempuan</span>
                              </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                    <div class="form-group mb-3 row">
                            <label class="form-label mb-3">Alamat</label>
                            
                        </div>
                    </div>
                </div>
            </form>
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