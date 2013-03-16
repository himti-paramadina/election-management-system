<div class="row"> 
    <div class="span4">
        <h1>Tambah Kandidat Baru</h1>
        <p class="lead">Anda sedang melakukan penambahan kandidat baru untuk <strong><?php echo $election['Election']['name']; ?></strong>.</p>
        <?php echo $this->Form->create(null, array(
                    'url' => array('controller' => 'candidates', 'action' => 'add', $election['Election']['id']),
                    'type' => 'file'
              )); ?>
        
        <fieldset>
            <legend>Form Kandidat</legend>
            <?php echo $this->Form->input('name', array(
                'label' => 'Nama Kandidat Ketua'
            )); ?>
            <?php echo $this->Form->input('name2', array(
                'label' => 'Nama Kandidat Wakil Ketua'
            )); ?>
            <?php echo $this->Form->input('email', array(
                'label' => 'Email Perwakilan Kandidat'
            )); ?>
            <?php echo $this->Form->input('description', array(
                'label' => 'Deskripsi'
            )); ?>
            
            <p>Tambahkan gambar kandidat. Gambar untuk sistem harus berukuran 400 x 200 px.</p>
            
            <?php echo $this->Form->input('userfile', array('type' => 'file')); ?>
            
            <br/>
            <input type="submit" class="btn btn-primary" value="Tambahkan"/>
        </fieldset>
        
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="span8">
        <h1>Petunjuk</h1>
        
    </div>
</div>