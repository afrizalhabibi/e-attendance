<?php 
echo view('/layout/_header.php');
?>
<body  class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="<?=base_url()?>/assets/static/logo.svg" height="36" alt=""></a>
        </div>
        <form  class="card card-md" action="<?= route_to('register') ?>" method="post">
        <?= csrf_field() ?>  
        <div class="card-body">
            <h2 class="card-title text-center mb-4"><?=lang('Auth.register')?></h2>
            <?= view('Myth\Auth\Views\_message_block') ?>
            <div class="mb-3">
              <label class="form-label" for="pgw_id"><?=lang('Auth.pgw_id')?></label>
              <input type="text" class="form-control <?php if(session('errors.pgw_id')) : ?>is-invalid<?php endif ?>" name="pgw_id" placeholder="<?=lang('Auth.pgw_id')?>" value="<?= old('pgw_id') ?>">
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="email"><?=lang('Auth.email')?></label>
                <input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="username"><?=lang('Auth.username')?></label>
                <input type="text" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
            </div>

            <div class="form-group mb-3">
              <label for="password" class="form-label"><?=lang('Auth.password')?></label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="<?=lang('Auth.password')?>"  autocomplete="off">
              </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="pass_confirm"><?=lang('Auth.repeatPassword')?></label>
                <input type="password" name="pass_confirm" class="form-control <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
            </div>

            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100"><?=lang('Auth.registerAction')?></button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
        <?=lang('Auth.alreadyRegistered')?> <a href="<?=base_url()?>/login" tabindex="-1"> <?=lang('Auth.signIn')?></a>
        </div>
      </div>
    </div>
  </body>
<?php
echo view('/layout/_footer.php');
echo view('/layout/_js.php');
?>