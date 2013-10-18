<div class="row">
    <div class="col-md-12">
        <h1 align="center">Halaman Pendaftaran Administrator -_-</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <?php echo $this->Form->create(null, array(
                    'url' => array('controller' => 'administrators', 'action' => 'add')
                )); ?>

            <legend>Pendaftaran</legend>

            <div class="form-group">
                <?php echo $this->Form->input('Administrator.name', array('class' => 'form-control')); ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('Administrator.email', array('class' => 'form-control')); ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('Administrator.password', array('class' => 'form-control')); ?>
            </div>
            <br/>
            <input type="submit" class="btn btn-primary"/>

            <?php echo $this->Session->flash('auth'); ?>
        <?php $this->Form->end(); ?>
    </div>
</div>