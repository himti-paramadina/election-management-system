<div class="row">
    <div class="span4 offset4">
<?php if (!AuthComponent::user()) { ?>
        <h1>Halaman Login Administrator</h1>
        <form action="<?php echo Router::url(array('controller' => 'administrators', 'action' => 'login')); ?>" method="POST">
            <fieldset>
                <legend>Form Login</legend>
                
                <label>E-mail</label>
                <input type="text" name="data[Administrator][email]" placeholder="E-mail untuk Autentikasi"/>
                
                <label>Password</label>
                <input type="password" name="data[Administrator][password]" placeholder="Password Anda"/>
                
                <br/>
                <input type="submit" class="btn btn-primary"/>
            </fieldset>
            <?php echo $this->Session->flash('auth'); ?>
        </form>

<?php } else { ?>
        <h1>Halo <?php echo AuthComponent::user('name'); ?>!</h1>
        <p>Anda sudah melakukan log in sebelumnya. Silakan beralih ke halaman administrasi.</p>
        <a href="<?php echo Router::url(array('controller' => 'elections', 'action' => 'manage')) ?>" class="btn btn-primary">Halaman Administrasi</a>
<?php } ?>
    </div>
    <div class="span6">
        
    </div>
</div>