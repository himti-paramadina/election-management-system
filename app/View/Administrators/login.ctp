<div class="row">
    <div class="col-md-12">
        <?php echo $this->Session->flash('auth'); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
<?php if (!AuthComponent::user()) { ?>
        <div class="page-header">
            <h1>Halaman Login Administrator</h1>
        </div>

        <form action="<?php echo Router::url(array('controller' => 'administrators', 'action' => 'login')); ?>" method="POST">
            <div class="form-group">
                <input class="form-control" type="text" name="data[Administrator][email]" placeholder="E-mail"/>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="data[Administrator][password]" placeholder="Password"/>
            </div>

            <input type="submit" class="btn btn-primary"/>
        </form>

<?php } else { ?>
        <h1 align="center">Halo <?php echo AuthComponent::user('name'); ?>!</h1>
        <p>Anda sudah melakukan log in sebelumnya. Silakan beralih ke halaman administrasi.</p>
        <a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'manage')) ?>" class="btn btn-primary">Halaman Administrasi</a>
<?php } ?>
    </div>
</div>