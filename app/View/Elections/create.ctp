<div class="row">
    <div class="span4">
        <h1>Buat Pemilu Baru</h1>
        <?php echo $this->Form->create('Election'); ?>
            <fieldset>
                <legend>Form Pembuatan Pemilu</legend>
                
                <?php echo $this->Form->input('name'); ?>
                <?php echo $this->Form->input('identifier'); ?>
                <?php echo $this->Form->input('description'); ?>
                <?php echo $this->Form->input('registration_info'); ?>
                <?php echo $this->Form->input('start_date'); ?>
                <?php echo $this->Form->input('end_date'); ?>
                
                <br/>
                <input type="submit" class="btn btn-primary" value="Create"/>
            </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="span8">
        <h1>Petunjuk</h1>
        <p style="text-align: justify;">
            
        </p>
        <p style="text-align: justify;">
            
        </p>
    </div>
</div>
