<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>Buat Pemilu Baru</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php echo $this->Form->create('Election'); ?>
            <fieldset>
                <legend>Form Pembuatan Pemilu</legend>
                
                <div class="form-group">
                    <?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('identifier', array('class' => 'form-control')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('description', array('class' => 'form-control')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('registration_info', array('class' => 'form-control')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('start_date', array('class' => 'form-control')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('end_date', array('class' => 'form-control')); ?>
                </div>
                <br/>
                <input type="submit" class="btn btn-primary" value="Create"/>
            </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="col-md-8">
        <p style="text-align: justify;">
            
        </p>
        <p style="text-align: justify;">
            
        </p>
    </div>
</div>
