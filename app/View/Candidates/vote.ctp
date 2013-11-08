<div class="row">
    <div class="col-md-12">
        <h1><em>Vote!</em> <small><?php echo $election['Election']['name']; ?></small></h1>
        
        <p>
            Anda akan memilih kandidat <strong><?php echo $candidate['Candidate']['name']; if (strlen($candidate['Candidate']['name2']) > 0): echo ' dan ' . $candidate['Candidate']['name2']; endif; ?></strong>. Untuk melanjutkan,
            Anda harus memiliki voting-key untuk memilih. Voting-key adalah 32 karakter pengenal yang
            diberikan kepada Anda via e-mail atau langsung dari KPU saat melakukan pemilihan di tempat.
            Ketikkan sesuai dengan format yang telah kamu dapatkan dari KPU.
        </p>
        <p>
            <span class="label label-warning">Peringatan!</span> Voting-key yang kamu miliki hanya bisa dipakai
            <span style="color: red;"><strong>1 kali</strong></span> dalam pemilihan. Pastikan Anda menggunakannya dengan
            bijaksana. :)
        </p>
        
        <p align="center">
            <?php echo $candidate['Candidate']['img_url'] == NULL ? $this->Html->image('http://placehold.it/400x200', array('class' => 'thumbnail')):$this->Html->image($candidate['Candidate']['img_url'], array('class' => 'thumbnail')); ?>
        </p>
        
        <div class="row">
            <?php echo $this->Form->create(null, array(
                'url' => array('controller' => 'candidates', 'action' => 'vote', $candidate['Candidate']['id']),
                'class' => 'form-inline'
            )); ?>
        
            <div class="col-md-8 col-md-offset-2">
                <div class="form-group" style="text-align: center;">
                    <label>Masukkan Voting-Key Anda: </label>
                    <input type="text" style="width: 400px;" name="data[VotingKey][voting_key]" placeholder="Voting Key (XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX)" id="VotingKeyVotingKey" class="form-control"/>
                </div>
                <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-heart"></span> <em>Vote</em>!</button>
            </div>
        
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>