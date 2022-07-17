<?php 
echo view('/layout/_header.php');
?>
<body class="border-top-wide border-primary d-flex flex-column theme-light">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="<?=base_url();?>/assets/static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md" action="<?= route_to('login') ?>" method="post" autocomplete="off">
        <?= csrf_field() ?> 
        <div class="card-body">
            <h2 class="card-title text-center mb-4"><?=lang('Auth.loginTitle')?></h2>
            
            <?= view('Myth\Auth\Views\_message_block') ?>
            
<?php if ($config->validFields === ['email']): ?>
              <div class="form-floating mb-3">
                <input type="email" class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>" id="floating-input" autocomplete="off" name="login" placeholder="<?=lang('Auth.emailAddress')?>">
              <div class="invalid-feedback">
								<?= session('errors.login') ?>
							</div>
              <label for="floating-input"><?=lang('Auth.email')?></label>
              </div>
<?php else: ?>
						<div class="form-floating mb-3">
							<input type="text" class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>" id="floating-input" name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">
							<div class="invalid-feedback">
								<?= session('errors.login') ?>
							</div>
							<label for="floating-input"><?=lang('Auth.emailOrUsername')?></label>
						</div>
<?php endif; ?>

            <div class="form-floating mb-3">
              <input type="password" name="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" id="floating-password"  autocomplete="off">
                <div class="invalid-feedback">
                  <?= session('errors.password') ?>
                </div>
              <label for="floating-password"><?=lang('Auth.password')?></label>
            </div>

            

<?php if ($config->allowRemembering): ?>
						<div class="mb-2">
							<label class="form-check">
								<input type="checkbox" name="remember" class="form-check-input" <?php if(old('remember')) : ?> checked <?php endif ?>>
								<?=lang('Auth.rememberMe')?>
							</label>
						</div>
<?php endif; ?>

            <div class="form-footer">
              <button type="submit" class="btn btn-blue w-100"><?=lang('Auth.loginAction')?></button>
            </div>
          </div>
         
        </form>
<?php if ($config->allowRegistration) : ?>
  <div class="text-center text-muted mt-3">
  Belum memiliki akun? <a href="<?= route_to('register') ?>"><?=lang('Auth.needAnAccount')?></a>
  </div>
<?php endif; ?>
<?php if ($config->activeResetter): ?>
  <div class="text-center text-muted mt-3">
    <a href="<?= route_to('forgot') ?>"><?=lang('Auth.forgotYourPassword')?></a>
  </div>
<?php endif; ?>
      </div>
    </div>
</body>
<?php
echo view('/layout/_footer.php');
echo view('/layout/_js.php');
?>
