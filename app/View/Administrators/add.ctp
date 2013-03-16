<div class="row">
    <div class="span12">
        <h1>Halaman Pendaftaran Administrator -_-</h1>
        <?php echo $this->Form->create(null, array(
                    'url' => array('controller' => 'administrators', 'action' => 'add')
                )); ?>
            <fieldset>
                <legend>Pendaftaran</legend>
                
                <?php echo $this->Form->input('Administrator.name'); ?>
                <?php echo $this->Form->input('Administrator.email'); ?>
                <?php echo $this->Form->input('Administrator.password'); ?>
                
                <br/>
                <input type="submit" class="btn btn-primary"/>
            </fieldset>
            <?php echo $this->Session->flash('auth'); ?>
        <?php $this->Form->end(); ?>
    </div>
</div>